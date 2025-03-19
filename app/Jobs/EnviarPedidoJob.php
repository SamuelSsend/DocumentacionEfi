<?php

namespace App\Jobs;

use App\Alimento;
use App\Carrito;
use App\CarritoSubproducto;
use App\Pedido;
use App\PedidoDetalle;
use App\Subproducto;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Mail\CompraExitosa;
use Illuminate\Support\Facades\Mail;

const NOMBRE = 'efipos';
const TIPO =23;
const MONEDA = 'EUR';


class EnviarPedidoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //constantes

    protected $pedido;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hora_actual = Carbon::now();
        $dia_actual = ucfirst(Carbon::now()->locale('es')->dayName);
        
        $horarios = DB::table('horario')
            ->where('dia', '=', $dia_actual)
            ->orderBy('desde')
            ->get();

        $pedidoPermitido = false;
        $proxDesde = Carbon::now();
        $proxHasta = Carbon::now();
        $proxDia = "";
        
        foreach ($horarios as $horario) {
            if ($horario->cerrado == 0) {
                $desde = Carbon::createFromFormat('H:i:s', $horario->desde);
                $hasta = Carbon::createFromFormat('H:i:s', $horario->hasta);
                
                if ($hora_actual->between($desde, $hasta)) {
                    $pedidoPermitido = true;
                    break;
                } elseif ($hora_actual->lessThan($desde)) {
                    $proxDesde = $desde;
                    $proxHasta = $hasta;
                    $proxDia = $dia_actual;
                    break;
                }
            }
        }

        if (!$pedidoPermitido && $proxDia == "") {
            for ($i = 1; $i <= 7; $i++) {
                $proxDiaCarbon = $hora_actual->copy()->addDays($i);
                $proxDiaNombre = ucfirst($proxDiaCarbon->locale('es')->dayName);

                $horariosProxDia = DB::table('horario')
                    ->where('dia', '=', $proxDiaNombre)
                    ->orderBy('desde')
                    ->get();

                foreach ($horariosProxDia as $horario) {
                    if ($horario->cerrado == 0) {
                        $proxDesde = Carbon::createFromFormat('H:i:s', $horario->desde)->setDateFrom($proxDiaCarbon);
                        $proxHasta = Carbon::createFromFormat('H:i:s', $horario->hasta)->setDateFrom($proxDiaCarbon);
                        $proxDia = $proxDiaNombre;
                        break 2;
                    }
                }
            }
        }

        $config = DB::table('config_general')->first();

        $total_pago = Carrito::query()->where('uuid', session()->get('iduser'))->sum(DB::raw('precio * cantidad'));
        $carrito = Carrito::query()->where('uuid', session()->get('iduser'))->first();
        $cupones = DB::table('carrito_cupon')
            ->select('cupon.nombre', 'carrito_cupon.descuento_aplicado', 'cupon.tipo_descuento')
            ->where('carrito_id', $carrito->id)
            ->join('cupon', 'cupon.id', '=', 'carrito_cupon.cupon_id')
            ->get();

        Log::info($cupones);

        $productos_get = Carrito::query()->where('uuid', session()->get('iduser'))->get();

        $productos = [];

        $direccion = "RECOGIDA";
        if ($carrito->type_id == 1) {
            $direccion = session()->get('direccion');
            $articuloEnvio = Alimento::find($config->gastos_de_envio_id);
            $precioEnvio = $articuloEnvio->precio;
            $precio = $articuloEnvio->precio;
            $productos_get[] = new Carrito(
                [
                'idalimento' => $config->gastos_de_envio_id,
                'producto' => $articuloEnvio->titulo,
                'cantidad' => 1,
                'precio' => $articuloEnvio->precio
                ]
            );

            $total_pago += $precio;
        }
        
        $descuentoTotal = 0;
        
        foreach ($cupones as $cupon) {
            if ($cupon->tipo_descuento == 'envio_gratis' && $carrito->type_id == 1) {
                $total_pago -= $precioEnvio;
                break;
            }
        }
        
        foreach ($cupones as $cupon) {
            if ($cupon->tipo_descuento == 'porcentaje') {
                $descuentoTotal += $cupon->descuento_aplicado;
            } elseif ($cupon->tipo_descuento == 'importe_fijo') {
                $descuentoTotal += $cupon->descuento_aplicado;
            }
        }
        
        $total_pago -= $descuentoTotal;
        
        foreach ($productos_get as $producto) {
            $idproducto = $producto->idalimento;
            $nombreproducto = $producto->producto;
            $cantidad = $producto->cantidad;
            $preciounitario = (float) $producto->precio;
            $comentarioscocina = [];
            if ($producto->comentario) {
                $comentarioscocina[] = ['descripcion' => $producto->comentario];
            }
    
            $carritoId = $producto->id;
            $subproductos = CarritoSubproducto::where('registro_id', $carritoId)->get();
            $subproductosArray = [];
    
            if ($subproductos->isNotEmpty()) {
                $i = 0;
                while ($i < count($subproductos)) {
                    $subproductoId = $subproductos[$i]->subproducto_id;
                    $subproductoInfo = Subproducto::select('nombre', 'precio')->where('id', $subproductoId)->first();
                    $subproductoData = [
                        'idmenuseccion' => 0,
                        'idproducto' => $subproductoId,
                        'nombre' => $subproductoInfo->nombre,
                        'cantidad' => 1,
                        'preciounitario' => (float) $subproductoInfo->precio,
                        'comentarioscocina' => []
                    ];
    
                    $segundoNivel = [];
                    $j = $i + 1;
                    while ($j < count($subproductos)) {
                        $subprodId = $subproductos[$j]->subproducto_id;
                        $verif = DB::table('subproducto_combinado')->where('subproducto_id', $subprodId)->where('padre_producto_id', $subproductoId)->exists();
                        if ($verif) {
                            $subprodInfo = Subproducto::select('nombre', 'precio')->where('id', $subprodId)->first();
                            $segundoNivel[] = [
                                'idproducto' => $subprodId,
                                'nombre' => $subprodInfo->nombre,
                                'idmenuseccion' => $subproductoId,
                                'cantidad' => 1,
                                'preciounitario' => (float) $subprodInfo->precio
                            ];
                            $i++;
                        } else {
                            break;
                        }
                        $j++;
                    }
    
                    if (!empty($segundoNivel)) {
                        $subproductoData['Subproductos'] = $segundoNivel;
                    }
    
                    $subproductosArray[] = $subproductoData;
                    $i++;
                }
            }
    
            $productos[] = [
                'idproducto' => $idproducto,
                'nombre' => $nombreproducto,
                'cantidad' => $cantidad,
                'preciounitario' => $preciounitario,
                'comentarioscocina' => $comentarioscocina,
                'subproductos' => $subproductosArray
            ];
        }

        if (!$pedidoPermitido) {
            Session::flash('warning', 'La próxima apertura será el ' . $proxDia . ' de ' . $proxDesde->format('H:i') . ' hasta ' . $proxHasta->format('H:i'));
            CarritoSubproducto::query()->where('registro_id', $carrito->id)->delete();
            Carrito::query()->where('uuid', session()->get('iduser'))->delete();
            return;
        }
        //
        //        $nombrecliente = $user->name;
        //        $direccion = $user->direccion;
        //        $telefono = $user->telefono;

        $nombrecliente = session()->get('name');
        
        $telefono = session()->get('telefono');
        $observaciones = session()->get('observaciones');

        $orden = $this->generarPedido($productos_get, $total_pago);

        $resultadoCorregido = $this->obtenerProductosCorregidos($productos_get);
        
        $pedido = [];
        $pedido = array(
            "id"=>"".$orden,
            "name"=>$nombrecliente,
            "total_pagado"=>$total_pago,
            "direccion"=>$direccion,
            "mail"=>session()->get('email')
        );
        $orderDetails = $resultadoCorregido;
        $pedido = (object) $pedido;
        
        Log::info("Resultado ".json_encode($productos, JSON_PRETTY_PRINT));
        
        $comentariosCliente = $observaciones . " - Teléfono:" . $telefono."\n";
        foreach($cupones as $cupon){
            if($carrito->type_id == 1 && $cupon->tipo_descuento === "envio_gratis") {
                $comentariosCliente .= "Cupón: " . $cupon->nombre . " Descuento: 2.5€\n";
            }else{
                $comentariosCliente .= "Cupón: " . $cupon->nombre . " Descuento: ".$cupon->descuento_aplicado."€\n";
            }
        }
        
        $data = array(

            "servicio" => [
                "nombre" => NOMBRE,                               //Nombre del servicio (siempre será "efipos")
                "orden" => "".$orden,                                //Numero del pedido
                "tipo" => TIPO,
                "codigopedido" => "" . $orden                             //Nº de identificación del servicio (siempre será 23)
            ],
            "fecha" => date("Y-m-d\TH:i:s.z"),                    //Fecha del pedido
            "moneda" => MONEDA,                                   //Moneda del pago (constante)
            "total" => $total_pago,                          //Total de la cuenta
            "productos" => $resultadoCorregido,                            //Productos del pedido
            "direccion" => $direccion, //Dirección de envio
            "cliente" => [
                "nombre" => $nombrecliente,                    //Productos del pedido
            ],
            "comentarioCliente" => $comentariosCliente,
            "pagos" => [
                "importe" => $total_pago                            //$importe
            ],
            "estado" => "ACEPTED"

        );


        //        dd($data);


        //Guardar archivo .json
        $orden = json_encode($data, JSON_PRETTY_PRINT);
        //            file_put_contents("order.json", $orden);
        Log::info($orden);

        $curl = curl_init();

        curl_setopt_array(
            $curl, array(
            CURLOPT_URL => $config->hosteltactil_api . '/Orden',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $orden
            ,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'IDLocal: ' . $config->hosteltactil_idlocal,
                'Authorization: Bearer ' . $config->hosteltactil_token
            ),
            )
        );

        $response = curl_exec($curl);
        
        if ($response === false) {
            $error = curl_error($curl);
            Log::error('Error al realizar la solicitud CURL: ' . $error);
        } else {
            \Log::info($response);
        }
        
        curl_close($curl);
        
        Mail::to($pedido->mail)->send(new CompraExitosa($pedido, $orderDetails, $cupones));
        Mail::to("info@thebeastburger.es")->send(new CompraExitosa($pedido, $orderDetails, $cupones));


        $r = json_decode($response);
        if ($r and is_numeric($r->codigoError)) {
            Log::error('Error en la respuesta: ' . $response);
            die($response);
        } else {
            CarritoSubproducto::query()->where('registro_id', $carrito->id)->delete();
            Carrito::query()->where('uuid', session()->get('iduser'))->delete();
        }
    }
    
    public function obtenerProductosCorregidos($productos_get)
    {
        $productos = [];
        foreach ($productos_get as $producto) {
            $idproducto = $producto->idalimento;
            $nombreproducto = $producto->producto;
            $cantidad = $producto->cantidad;
            $preciounitario = (float) $producto->precio;
            $comentarioscocina = [];
            if ($producto->comentario) {
                $comentarioscocina[] = ['descripcion' => $producto->comentario];
            }

            $subproductosArray = [];
            $subproductos = CarritoSubproducto::where('registro_id', $producto->id)->get();
            if ($subproductos->isNotEmpty()) {
                $i = 0;
                while ($i < count($subproductos)) {
                    $subproductoId = $subproductos[$i]->subproducto_id;
                    $subproductoInfo = Subproducto::select('nombre', 'precio')->where('id', $subproductoId)->first();
                    $subproductoData = [
                        'idmenuseccion' => 0,
                        'idproducto' => $subproductoId,
                        'nombre' => $subproductoInfo->nombre,
                        'cantidad' => 1,
                        'preciounitario' => (float) $subproductoInfo->precio,
                        'comentarioscocina' => []
                    ];

                    $segundoNivel = [];
                    $j = $i + 1;
                    while ($j < count($subproductos)) {
                        $subprodId = $subproductos[$j]->subproducto_id;
                        $verif = DB::table('subproducto_combinado')->where('subproducto_id', $subprodId)->where('padre_producto_id', $subproductoId)->exists();
                        if ($verif) {
                            $subprodInfo = Subproducto::select('nombre', 'precio')->where('id', $subprodId)->first();
                            $segundoNivel[] = [
                                'idproducto' => $subprodId,
                                'nombre' => $subprodInfo->nombre,
                                'idmenuseccion' => $subproductoId,
                                'cantidad' => 1,
                                'preciounitario' => (float) $subprodInfo->precio
                            ];
                            $preciounitario -= (float) $subprodInfo->precio;
                            $i++;
                        } else {
                            break;
                        }
                        $j++;
                    }

                    if (!empty($segundoNivel)) {
                        $subproductoData['Subproductos'] = $segundoNivel;
                    }

                    $subproductosArray[] = $subproductoData;
                    $preciounitario -= (float) $subproductoInfo->precio;
                    $i++;
                }
            }

            $productos[] = [
                'idproducto' => $idproducto,
                'nombre' => $nombreproducto,
                'cantidad' => $cantidad,
                'preciounitario' => $preciounitario,
                'comentarioscocina' => $comentarioscocina,
                'subproductos' => $subproductosArray
            ];
        }
        return $productos;
    }
    
    protected function generarPedido(Collection $carritoLineas, $total)
    {
        $carritoCabecera = $carritoLineas->first();

        $id = Pedido::create(
            [
            'uuid' => session()->get('iduser'),
            'iduser' => $carritoCabecera->id,
            'fecha' => $carritoCabecera->createAt,
            'direccion' => session()->get('direccion'),
            'total_pagado' => $total,
            'estado' => 'En espera',
            'mes' => now()->month,
            'year' => now()->year,
            'tiempo_estimado' => 'Calculando',
            'telefono' => session()->get('telefono'),
            'name' => session()->get('name'),
            'email' => session()->get('email'),
            ]
        )->id;

        $carritoLineas->each(
            function (Carrito $carritoLinea) use ($id) {

                PedidoDetalle::create(
                    [
                    'idpedido' => $id,
                    'producto' => $carritoLinea->producto,
                    'precio' => $carritoLinea->precio,
                    ]
                );
            }
        );

        return $id;
    }
}
