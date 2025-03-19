<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Alimento;
use App\Carrito;
use App\Resolvers\TypeOrderResolver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $typeOrderResolver;
    protected $stripeService;

    public function __construct(TypeOrderResolver $typeOrderResolver, StripeService $stripeService)
    {
        $this->typeOrderResolver = $typeOrderResolver;
        $this->stripeService = $stripeService;
    }

    public function pay(Request $request)
    {
        Log::info('Iniciando función pay');
    
        //if (auth()->check()) {
        //    Log::info('Usuario autenticado, actualizando datos del usuario.');
        //    auth()->user()->update([
        //        'telefono' => $request->telefono,
        //        'direccion' => $request->direccion
        //    ]);
        //}

        //session()->put('name', $request->nombre_1 ?? $request->nombre_2);
        //session()->put('email', $request->email_1 ?? $request->email_2);
        //session()->put('telefono', $request->telefono_1 ?? $request->telefono_2);
        //session()->put('direccion', $request->direccion ?? 'RECOGIDA');
        //session()->put('observaciones', $request->observaciones);

        $rules = [
            'value' => ['required', 'numeric'],
            'currency' => ['required', 'exists:currencies,iso'],
            //'type_order' => [/*'required',*/ 'exists:type_orders,id'],
        ];

        $request->validate($rules);
        
        $config = DB::table('config_general')->first();

        $total_pago = Carrito::query()->where('uuid', session()->get('iduser'))->sum(DB::raw('precio * cantidad'));
        $carrito = Carrito::query()->where('uuid', session()->get('iduser'))->first();
        $cupones = DB::table('carrito_cupon')
            ->select('cupon.nombre', 'carrito_cupon.descuento_aplicado', 'cupon.tipo_descuento')
            ->where('carrito_id', $carrito->id)
            ->join('cupon', 'cupon.id', '=', 'carrito_cupon.cupon_id')
            ->get();

        $productos_get = Carrito::query()->where('uuid', session()->get('iduser'))->get();

        if ($carrito && $carrito->type_id == 1) {
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
            } elseif ($cupon->tipo_descuento == 'fijo') {
                $descuentoTotal += $cupon->descuento_aplicado;
            }
        }
        
        $total_pago -= $descuentoTotal;
        
        $request->merge(['value' => $total_pago]);
        
        Log::info('Resolviendo servicio de tipo de orden.');
        $typeOrder = $this->typeOrderResolver
            ->resolveService($request->type_order);

        //session()->put('typeOrderId', $request->type_order);
        //Log::info("^^ ".json_encode($typeOrder));

        Log::info('Tipo de orden resuelto, manejando pago.');
        $response = $typeOrder->handlePayment($request);
    
        Log::info('Respuesta de handlePayment:', ['response' => $response]);
        return $response;
    }
    

    public function approval()
    {
        $typeOrder = $this->typeOrderResolver->resolveService(1);
        //if (session()->has('typeOrderId')) {
        //    $typeOrder = $this->typeOrderResolver
        //        ->resolveService(session()->get('typeOrderId'));

        //    return $typeOrder->handleApproval();
        //}
        $fakeRequest = Request::create(
            '/approval', 'POST', [
            'type_order' => 1,
            ]
        );
        return $typeOrder->handleApproval($fakeRequest);
        //return redirect()
        //    ->route('ordenar_online')
        //    ->withErrors('We cannot retrieve your payment platform. Try again, please.');
    }

    public function cancelled()
    {
        return redirect()
            ->route('home')
            ->withErrors('El pago ha sido cancelado.');
    }

    public function confirmPayment(Request $request)
    {
        try {
            // Confirmar el PaymentIntent usando el servicio de Stripe
            $paymentIntentId = $request->input('payment_intent_id');

            // Confirmar el PaymentIntent en Stripe
            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
            $paymentIntent = $paymentIntent->confirm(); // Importante: la asignación asegura que se obtenga el nuevo estado
            Log::info($paymentIntent);
            // Verificar si el PaymentIntent ha sido exitosamente confirmado
            if ($paymentIntent->status === 'succeeded') {
                Log::info("confirm payment succeeded");
                return response()->json(['success' => true]);
            } else {
                // Puede que se necesite esperar un poco más para que se actualice el estado
                return response()->json(['error' => 'El pago no fue exitoso. Estado: ' . $paymentIntent->status], 400);
            }
        } catch (\Stripe\Exception\CardException $e) {
            // Error específico de la tarjeta
            return response()->json(['error' => $e->getError()->message], 400);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Otro tipo de error de la API de Stripe
            return response()->json(['error' => 'Error en la API de Stripe: ' . $e->getMessage()], 400);
        } catch (\Exception $e) {
            // Cualquier otro error genérico
            return response()->json(['error' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 400);
        }
    }
}
