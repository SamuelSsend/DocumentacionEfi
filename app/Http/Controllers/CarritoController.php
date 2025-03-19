<?php

namespace App\Http\Controllers;

use App\Alimento;
use App\Carrito;
use App\ConfigGeneral;
use App\Pedido;
use App\Cupon;
use App\PedidoDetalle;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Illuminate\Support\Facades\Log;


class CarritoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('generar_pedido');
    }

    public function index(Request $request)
    {

        $config = DB::table('config_general')
            ->first();

        $alimento = Alimento::query()
            ->get();

    }

    public function guardarInformacionPedido(Request $request)
    {
        $productos = $request->input('productos');
        $direccion = $request->input('direccion');
        $total = $request->input('total');

        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $observaciones = $request->input('observaciones');

        session()->put('name', $nombre);
        session()->put('email', $email);
        session()->put('telefono', $telefono);
        session()->put('observaciones', $observaciones);
        session()->put('direccion', $direccion);
        return response()->json(['status' => 'success']);
    }
    
    public function enviar_Pedido(Request $request)
    {
        try {
            $productos = $request->input('productos');
            $direccion = $request->input('direccion');
            $total = $request->input('total');
            
            $nombre = $request->input('nombre');
            $email = $request->input('email');
            $telefono = $request->input('telefono');
            $observaciones = $request->input('observaciones');
            
            session()->put('name', $nombre);
            session()->put('email', $email);
            session()->put('telefono', $telefono);
            session()->put('observaciones', $observaciones);
            session()->put('direccion', $direccion);
            session()->put('source', 'true');
            
            //session()->save();
            
            //Log::info("nombre: $nombre, email: $email, telefono: $telefono");
            //$iduser = auth()->user()->id;
            
            return redirect()->route('hoy');
            
            //$pedidoGenerado = $this->generar_Pedido($productos, $iduser, $direccion, $total);

            //if ($pedidoGenerado) {
            //    return redirect()->route('hoy');
            //} else {
            //    return redirect()->route('hoy')->with('error', 'Hubo un problema al enviar el pedido.');
            //}
        } catch (\Exception $e) {
            Log::error('Error al enviar el pedido: ' . $e->getMessage());
            return redirect()->route('hoy');
        }
    }

    public function generar_Pedido($productos, $iduser, $direccion, $total)
    {
        $config = DB::table('config_general')
            ->first();

        $productos = explode("-", $productos);

        $today = getdate();
        $data_month = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $current_month = $today['mon'];
        $current_year = $today['year'];

        $pedido = new Pedido;
        $pedido->iduser = $iduser;
        $mytime = Carbon::now('Europe/Madrid');
        $pedido->fecha = $today['year'] . '-' . $today['mday'] . '-' . $today['mon'];
        $pedido->direccion = 'Calle Fuente Nueva, 41 Piso 4 D';
        $pedido->total_pagado = $total;
        $pedido->estado = 'En espera';
        $pedido->mes = $current_month;
        $pedido->year = $current_year;
        $pedido->tiempo_estimado = 'Calculando';
        $pedido->save();

        $cont = 0;

        $carrito = DB::table('carrito')
            ->where('iduser', '=', auth()->user()->id)
            ->get();
        
        $orderDetails = [];

        while ($cont < count($productos)) {

            $alimento = Alimento::findOrFail($productos[$cont]);

            $detalle = new PedidoDetalle;
            $detalle->idpedido = $pedido->id;
            $detalle->producto = $alimento->titulo;
            $detalle->precio = substr($alimento->precio, 1, 8);;
            $detalle->save();

            $carrito_del = Carrito::findOrFail($carrito[$cont]->id);
            $carrito_del->delete();

            $cont = $cont + 1;
        }
        return redirect()->route('hoy');

    }

    public function applyCoupon($coupon)
    {
        try {
            $cupon = Cupon::where('codigo', $coupon)->first();

            if (!$cupon) {
                return response()->json(['error' => 'Cupón inválido'], 400);
            }

            if (!$cupon->activo) {
                return response()->json(['error' => 'Cupón no disponible'], 400);
            }

            $fechaActual = now();
            if ($fechaActual < $cupon->fecha_inicio || $fechaActual >= $cupon->fecha_fin) {
                return response()->json(['error' => 'Cupón fuera de vigencia'], 400);
            }

            if ($cupon->num_canjeos >= $cupon->canjeos_max) {
                return response()->json(['error' => 'El cupón ha alcanzado su límite de canjeos'], 400);
            }

            $carrito = Carrito::where('uuid', session()->get('iduser'))->first();

            $totalOriginal = DB::table('carrito as c')
                ->select(DB::raw("sum(c.precio * c.cantidad) as total"))
                ->where('uuid', '=', session()->get('iduser'))
                ->value('total');

            // Obtener cupones ya aplicados y calcular el total después de sus descuentos
            $cuponesAplicados = $carrito->cupones;
            $descuentoExistente = 0;
            
            foreach ($cuponesAplicados as $cuponAplicado) {
                if ($cuponAplicado->tipo_descuento == 'porcentaje') {
                    $descuentoExistente += $totalOriginal * ($cuponAplicado->descuento / 100);
                } elseif ($cuponAplicado->tipo_descuento == 'importe_fijo') {
                    $descuentoExistente += $cuponAplicado->descuento;
                }
            }

            $totalDespuesDescuentoExistente = $totalOriginal - $descuentoExistente;

            // Verificar si el total después de los descuentos existentes permite aplicar el nuevo cupón
            if ($totalDespuesDescuentoExistente < $cupon->precio_minimo) {
                return response()->json(['error' => 'El total del carrito no cumple con el monto mínimo requerido para aplicar el cupón'], 400);
            }

            // Calcular el descuento para el nuevo cupón y aplicarlo sobre el total ya descontado
            $descuentoNuevoCupon = 0;
            if ($cupon->tipo_descuento == 'porcentaje') {
                $descuentoNuevoCupon = $totalDespuesDescuentoExistente * ($cupon->descuento / 100);
            } elseif ($cupon->tipo_descuento == 'importe_fijo') {
                $descuentoNuevoCupon = $cupon->descuento;
            }

            $totalDespuesDescuentoNuevo = $totalDespuesDescuentoExistente - $descuentoNuevoCupon;
            
            if ($totalDespuesDescuentoNuevo < 0) {
                return response()->json(['error' => 'El descuento aplicado no puede hacer que el total del carrito sea inferior a cero'], 400);
            }

            // Agregar el nuevo cupón y actualizar el contador de canjeos
            $carrito->cupones()->attach($cupon->id, ['descuento_aplicado' => $descuentoNuevoCupon]);
            $cupon->increment('num_canjeos');

            // Calcular el total final considerando envío gratis si corresponde
            $config = ConfigGeneral::findOrFail(1);
            if ($carrito->type_id == 1 && in_array('envio_gratis', array_column($cuponesAplicados->toArray(), 'tipo_descuento'))) {
                $totalAbsoluto = number_format($totalDespuesDescuentoNuevo, 2);
            } elseif ($carrito->type_id == 1) {
                $totalAbsoluto = number_format($totalDespuesDescuentoNuevo + Alimento::find($config->gastos_de_envio_id)->precio, 2);
            } else {
                $totalAbsoluto = number_format($totalDespuesDescuentoNuevo, 2);
            }

            return response()->json([
                'total' => $totalOriginal,
                'totalDespuesDescuento' => $totalDespuesDescuentoNuevo,
                'totalAbsoluto' => $totalAbsoluto,
                'cupon' => $carrito->cupones
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hubo un error al aplicar el cupón: ' . $e->getMessage()], 400);
        }
    }

    public function changeType(Request $request)
    {
        $carrito = Carrito::where('uuid', '=', session()->get('iduser'))->first();
        
        $carrito->update(
            [
            'type_id' => $request->type_id
            ]
        );

        $total = DB::table('carrito as c')
            ->select(DB::raw("sum(c.precio * c.cantidad) as total"))
            ->where('uuid', '=', session()->get('iduser'))
            ->value('total');
            
        $cupones = $carrito->cupones;

        $descuentoTotal = 0;
        $envioGratis = false;
        $cuponesAplicados = [];

        foreach ($cupones as $cupon) {
            if (in_array($cupon->id, $cuponesAplicados)) {
                continue;
            }

            if ($cupon->tipo_descuento == 'porcentaje') {
                $descuentoTotal += $total * ($cupon->descuento / 100);
            } elseif ($cupon->tipo_descuento == 'importe_fijo') {
                $descuentoTotal += $cupon->descuento;
            } elseif ($cupon->tipo_descuento == 'envio_gratis') {
                $envioGratis = true;
            }
            
            $cuponesAplicados[] = $cupon->id;
        }

        $totalDespuesDescuento = $total - $descuentoTotal;

        $config = ConfigGeneral::findOrFail(1);

        if ($carrito->type_id == 1 && $envioGratis) {
            $totalAbsoluto = number_format($totalDespuesDescuento, 2);
        } elseif($carrito->type_id == 1) {
            $totalAbsoluto = number_format($totalDespuesDescuento + Alimento::find($config->gastos_de_envio_id)->precio, 2);
        } else {
            $totalAbsoluto = number_format($totalDespuesDescuento, 2);
        }

        return compact('total', 'totalAbsoluto');
        // Carrito::where('uuid', '=', session()->get('iduser'))->update([
        //     'type_id' => $request->type_id
        // ]);

        // $total = DB::table('carrito as c')
        //     ->select(DB::raw("sum(c.precio * c.cantidad) as total"))
        //     ->where('uuid', '=', session()->get('iduser'))
        //     ->value('total');

        // $config = ConfigGeneral::findOrFail(1);

        // if ($request->type_id == 1) {
        //     $totalAbsoluto = number_format($total + Alimento::find($config->gastos_de_envio_id)->precio, 2);
        // } else {
        //     $totalAbsoluto = number_format($total , 2);
        // }

        // return compact('total', 'totalAbsoluto');
    }
    
    public function update(Request $request, Carrito $carrito)
    {
        abort_unless($carrito->uuid, session()->get('iduser'), Response::HTTP_FORBIDDEN);
        $cuponController = new CuponController();

        $carrito->update(['cantidad' => $request->cantidad]);

        $total = DB::table('carrito as c')
            ->select(DB::raw("sum(c.precio * c.cantidad) as total"))
            ->where('uuid', '=', session()->get('iduser'))
            ->value('total');
        
        $config = ConfigGeneral::findOrFail(1);
        $totalAbsoluto = number_format($total + Alimento::find($config->gastos_de_envio_id)->precio, 2);
        $num_carrito = Carrito::where('uuid', session()->get('iduser'))
            ->where('estado', 'En el carrito')
            ->sum('cantidad');

        $cupones = $carrito->cupones;
        $cuponesAplicados = [];
        $cuponesAEliminar = [];
        $descuentoTotal = 0;

        // Procesar cada cupón para ver si se debe eliminar o aplicar
        foreach ($cupones as $cupon) {
            if ($total < $cupon->precio_minimo) {
                // Eliminar cupones que no cumplen con el total mínimo requerido
                $cuponesAEliminar[] = $cupon->id;
            } else {
                // Calcular el descuento de cupones aplicables
                if ($cupon->tipo_descuento == 'porcentaje') {
                    $descuentoTotal += $total * ($cupon->descuento / 100);
                } elseif ($cupon->tipo_descuento == 'importe_fijo') {
                    $descuentoTotal += $cupon->descuento;
                }
                $cuponesAplicados[] = $cupon->id;
            }
        }

        // Aplicar el descuento total y comprobar si el total es negativo
        $totalDespuesDescuento = $total - $descuentoTotal;
        if ($totalDespuesDescuento < 0) {
            $totalDespuesDescuento = 0;
        }

        // Configurar el total final considerando gastos de envío
        if ($carrito->type_id == 1 && in_array('envio_gratis', array_column($cupones->toArray(), 'tipo_descuento'))) {
            $totalAbsoluto = number_format($totalDespuesDescuento, 2);
        } elseif ($carrito->type_id == 1) {
            $totalAbsoluto = number_format($totalDespuesDescuento + Alimento::find($config->gastos_de_envio_id)->precio, 2);
        } else {
            $totalAbsoluto = number_format($totalDespuesDescuento, 2);
        }

        // Eliminar cupones inaplicables
        foreach ($cuponesAEliminar as $cuponId) {
            $cuponController->delete($cuponId); // Usa la función delete() para manejar los canjeos
        }

        return response()->json([
            'carrito' => $carrito,
            'total' => $total,
            'totalAbsoluto' => $totalAbsoluto,
            'num_carrito' => $num_carrito,
            'cuponesEliminados' => $cuponesAEliminar,
            'mensaje' => count($cuponesAEliminar) > 0 ? 'Algunos cupones han sido eliminados porque el monto total del carrito es menor que el umbral mínimo.' : null
        ]);
    }
    
    public function horario()
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

        if (!$pedidoPermitido) {
            Session::flash('warning', 'La próxima apertura será el ' . $proxDia . ' de ' . $proxDesde->format('H:i') . ' hasta ' . $proxHasta->format('H:i'));
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
    
    public function mostrarHoy($id)
    {
        return view('hoy', compact('id'));
    }
}
