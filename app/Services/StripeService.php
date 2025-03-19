<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Exception\ApiErrorException;

use App\ConfigGeneral;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class StripeService
{
    use ConsumesExternalServices;

    protected $key;
    protected $secret;
    protected $baseUri;
    protected $stripe_account;

    public function __construct()
    {
        $config = ConfigGeneral::first();

        $this->baseUri = config('services.stripe.base_uri');
        $this->key = $config->stripe_public;
        $this->secret =  $config->stripe_private;
        Stripe::setApiKey($this->secret);
        $this->stripe_account = 'acct_1Pibg7KHlVliKnpr';
        // 'acct_1PiC3vFu6OKWgJ6C'
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return "Bearer {$this->secret}";
    }
    
    public function handlePayment(Request $request)
    {
        $request->validate(
            [
            'payment_method_id' => 'required',
            ]
        );

        try {
            $paymentIntent = \Stripe\PaymentIntent::create(
                [
                'amount' => intval($request->value * 100),
                'currency' => strtolower($request->currency),
                'application_fee_amount' => intval(($request->value * 0.015 * 100)),
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'capture_method' => 'automatic',
                'confirm' => true,
                'return_url' => route('approval'),
                ], [
                'stripe_account' => $this->stripe_account
                ]
            );

            session()->put('paymentIntentId', $paymentIntent->id);

            if ($paymentIntent->status === 'requires_action' && $paymentIntent->next_action->type === 'use_stripe_sdk') {
                return response()->json(
                    [
                    'clientSecret' => $paymentIntent->client_secret,
                    'paymentIntentId' => $paymentIntent->id,
                    'confirmError' => null
                    ]
                );
            }

            return response()->json(
                [
                'clientSecret' => $paymentIntent->client_secret,
                'paymentIntentId' => $paymentIntent->id,
                'confirmError' => null
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            Log::error(
                'Stripe Card Exception', [
                'userId' => auth()->id(),
                'status' => $e->getHttpStatus(),
                'type' => $e->getError()->type,
                'code' => $e->getError()->code,
                'param' => $e->getError()->param,
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'Card error: ' . $e->getError()->message
                ], 400
            );
        } catch (\Stripe\Exception\RateLimitException $e) {
            Log::error(
                'Stripe Rate Limit Exception', [
                'userId' => auth()->id(),
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'Rate limit error: ' . $e->getError()->message
                ], 429
            );
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error(
                'Stripe Invalid Request Exception', [
                'userId' => auth()->id(),
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'Invalid request: ' . $e->getError()->message
                ], 400
            );
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Log::error(
                'Stripe Authentication Exception', [
                'userId' => auth()->id(),
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'Authentication error: ' . $e->getError()->message
                ], 401
            );
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Log::error(
                'Stripe API Connection Exception', [
                'userId' => auth()->id(),
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'API connection error: ' . $e->getError()->message
                ], 500
            );
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error(
                'Stripe API Error Exception', [
                'userId' => auth()->id(),
                'message' => $e->getError()->message,
                ]
            );
            return response()->json(
                [
                'error' => 'API error: ' . $e->getError()->message
                ], 500
            );
        } catch (\Exception $e) {
            Log::error(
                'General Exception', [
                'userId' => auth()->id(),
                'message' => $e->getMessage(),
                ]
            );
            return response()->json(
                [
                'error' => 'General error: ' . $e->getMessage()
                ], 500
            );
        }
    }
    
    public function handleApproval(Request $request)
    {
        if (session()->has('paymentIntentId')) {
            $paymentIntentId = session()->get('paymentIntentId');
            Log::info("HandleApproval - paymentIntentId encontrado: " . $paymentIntentId);
    
            try {
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId, ['stripe_account' => $this->stripe_account]);
                Log::info($paymentIntent);
    
                if ($paymentIntent->status === 'requires_confirmation') {
                    $paymentIntent->confirm(
                        [
                        'return_url' => route('hoy')
                        ]
                    );
                    $paymentIntent = PaymentIntent::retrieve($paymentIntentId, ['stripe_account' => $this->stripe_account]);
                }
    
                if ($paymentIntent->status === 'succeeded') {
                    Log::info("HandleApproval - Pago exitoso.");
                    return redirect()->route('hoy');
                } else {
                    Log::warning("HandleApproval - Estado inesperado del PaymentIntent: " . $paymentIntent->status);
                    return response()->json(['error' => 'Estado inesperado del PaymentIntent']);
                }
            } catch (\Exception $e) {
                Log::error(
                    'Stripe Payment Confirmation Error', [
                    'paymentIntentId' => $paymentIntentId,
                    'error_message' => $e->getMessage(),
                    ]
                );
                Session::flash('warning', $e->getMessage());
                return view('hoy');
            }
        }
    
        return response()->json(['error' => 'No se encontró paymentIntentId en la sesión']);
    }

    
    public function createIntent($amount, $currency, $paymentMethod)
    {
        try {
            return PaymentIntent::create(
                [
                'payment_method_types' => ['card'],
                'amount' => $amount,
                'currency' => $currency,
                'payment_intent_data' => ['application_fee_amount' => intval(($request->value * 0.015 * 100))],
                ], ['stripe-account' => $this->stripe_account]
            );
        } catch (\ApiErrorException $e) {
            $errorData = $e->getJsonBody();
            $error = $errorData['error'];

            Log::error(
                'Stripe Payment Intent Creation Error', [
                'amount' => $amount,
                'currency' => $currency,
                'paymentMethod' => $paymentMethod,
                'error_message' => $error['message'],
                'error_code' => $error['code'],
                'error_param' => $error['param'],
                'error_trace' => $e->getTraceAsString(),
                ]
            );

            throw $e;
        }
    }
    
    public function confirmPayment(Request $request)
    {
        try {
            Log::info('Request Data:', $request->all());
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id, ['stripe_account' => $this->stripe_account]);
            $paymentIntent->confirm();

            Log::info("Payment intent ".json_encode($paymentIntent));
            
            if ($paymentIntent->status === 'succeeded') {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Payment not successful'], 500);
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $errorData = $e->getJsonBody();
            $error = $errorData['error'];

            Log::error(
                'Stripe Payment Confirmation Error', [
                'userId' => auth()->id(),
                'paymentIntentId' => $request->payment_intent_id,
                'error_message' => $error['message'],
                'error_param' => $error['param'],
                'error_trace' => $e->getTraceAsString(),
                ]
            );

            return response()->json(['error' => 'Fallo en la confirmación del pago. Por favor intenta de nuevo'], 500);
        }catch (\Exception $e) {
            Log::info("error in confirm payment");
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
