@push('styles')
<style type="text/css">
    /**
     * The CSS shown here will not be introduced in the Quickstart guide, but shows
     * how you can use CSS to style your Element's container.
     */
    .StripeElement {
      box-sizing: border-box;

      height: 40px;

      padding: 10px 12px;

      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
</style>
@endpush

<input type="hidden"  name="value" value={{$total->total}}>
<input type="hidden"  name="currency" value="eur">


<div id="telef">
    <div id="cardElement"></div>
    <small class="form-text text-muted" id="cardErros" role="alert"></small>
    <input type="hidden"  name="payment_method" id="paymentMethod">
</div>

<div id="cardErrors"></div>


@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ App\ConfigGeneral::first()->stripe_public }}', {
      stripeAccount: 'acct_1Pibg7KHlVliKnpr',
    });
    const elements = stripe.elements({locale: 'es'});
    const cardElement = elements.create('card', {
        hidePostalCode: true
    });
	
    cardElement.mount('#cardElement');

    const form = $('#form-payment');
    const payButton = document.getElementById('payButton');
    const payButtonText = document.getElementById('payButtonText');
	let precio_minimo;

    function obtenerPrecioMinimo() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/precio-min', false);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send();

        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            precio_minimo = data.precio_minimo;
        } else {
            console.error('Error al obtener el precio mínimo');
        }
    }
	document.addEventListener('DOMContentLoaded', function() {
        obtenerPrecioMinimo();
    });
	
	async function guardarInformacionPedido() {
		const productos = $('input[name="productos"]').val();
		const direccion = $('input[name="direccion"]').val() || 'RECOGIDA';
		const total = $('input[name="value"]').val();
		const nombre = $('#a_domicilio_nombre_completo:visible').val() || $('#en_local_nombre_completo:visible').val();
		const email = $('#a_domicilio_email:visible').val() || $('#en_local_email:visible').val();
		const telefono = $('#a_domicilio_telefono:visible').val() || $('#en_local_telefono:visible').val();
		const observaciones = $('#observaciones:visible').val();

		await fetch('/guardar_informacion_pedido', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			body: JSON.stringify({
				productos, direccion, total, nombre, email, telefono, observaciones
			})
		});
	}

    $(form).on('submit', async function (e) {
		e.preventDefault();
		
        const horarioResponse = await fetch('{{ route('horario_confirm') }}', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const horarioResult = await horarioResponse.json();

        if (!horarioResult.success) {
            window.location.href = `/mostrar/hoy/-1`;
            return;
        }
        if(Number($('input[name="value"]').val()) < precio_minimo) {
            e.preventDefault();
            alert(`El total debe ser mayor o igual a ${precio_minimo}€`);
            return;
        }

        $(payButton).prop('disabled', true);
        $(payButton).addClass('boton-pagar-desactivado');
        $(payButtonText).text('Procesando pago');
        const tokenInput = document.getElementById('paymentMethod');

        if (tokenInput.value) {
            return; // OK, send
        }

        e.preventDefault();
		
		await guardarInformacionPedido();
		
			let billingDetails = {
				"name": $('#a_domicilio_nombre_completo:visible').val() || $('#en_local_nombre_completo:visible').val(),
				"email": $('#a_domicilio_email:visible').val() || $('#en_local_email:visible').val(),
				"phone": $('#a_domicilio_telefono:visible').val() || $('#en_local_telefono:visible').val(),
			};

			const {paymentMethod, error} = await stripe.createPaymentMethod(
				'card', cardElement, {
					billing_details: billingDetails
				}
			);

			if (error) {
				const displayError = document.getElementById('cardErrors');
				displayError.textContent = error.message;
				$(payButton).prop('disabled', false);
				$(payButton).removeClass('bg-secondary');
			} else {
				const tokenInput = document.getElementById('paymentMethod');
				tokenInput.value = paymentMethod.id;

				// Confirm the payment with 3D Secure
				const { clientSecret, paymentIntentId, error: confirmError } = await handlePayment(paymentMethod.id);

				if (confirmError) {
					const displayError = document.getElementById('cardErrors');
					displayError.textContent = confirmError.message;
					$(payButton).prop('disabled', false);
					$(payButton).removeClass('bg-secondary');
				} else if (clientSecret) {
					stripe.retrievePaymentIntent(clientSecret).then(function(result) {
						const paymentIntent = result.paymentIntent;

						if (paymentIntent.status === 'requires_action') {
							handle3DSecure(clientSecret, paymentIntentId);
						} else if (paymentIntent.status === 'succeeded') {
							enviarPedido();
						} else {
							const displayError = document.getElementById('cardErrors');
							displayError.textContent = 'El estado del pago es: ' + paymentIntent.status;
							$(payButton).prop('disabled', false);
							$(payButton).removeClass('bg-secondary');
						}
					}).catch(function(err) {
						console.log('Error al recuperar el PaymentIntent:', err.message);
					});
				}
			}
		});

		async function handlePayment(paymentMethodId) {
			const value = $('input[name="value"]').val();
			const currency = $('input[name="currency"]').val();

			const response = await fetch('/payments/pay', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				},
				body: JSON.stringify({
					payment_method_id: paymentMethodId,
					value: value,
					currency: currency
				})
			});

			return response.json();
		}

		async function handle3DSecure(clientSecret, paymentIntentId) {
			stripe
			  .handleCardAction(clientSecret)
			  .then(function(result) {
				// Verifica si hubo un error con 3D Secure
				if (result.error) {
				  const displayError = document.getElementById('cardErrors');
				  displayError.textContent = result.error.message;
				  $('#payButton').prop('disabled', false);  
				  $('#payButton').removeClass('bg-secondary');
				} 
				else if (result.paymentIntent && result.paymentIntent.status === 'requires_confirmation') {
				  fetch('/payments/confirm', {
					method: 'POST',
					headers: {
					  'Content-Type': 'application/json',
					  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token
					},
					body: JSON.stringify({
					  payment_intent_id: result.paymentIntent.id
					})
				  })
				  .then(response => response.json())
				  .then(confirmResponse => {
					if (confirmResponse.error) {
					  const displayError = document.getElementById('cardErrors');
					  displayError.textContent = confirmResponse.error;
					  $('#payButton').prop('disabled', false);
					  $('#payButton').removeClass('bg-secondary');
					} 
					else if (confirmResponse.success) {
					  enviarPedido();
					}
				  })
				  .catch(error => {
					const displayError = document.getElementById('cardErrors');
					displayError.textContent = 'Ocurrió un error inesperado: ' + error.message;
					$('#payButton').prop('disabled', false);
					$('#payButton').removeClass('bg-secondary');
				  });
				}
			  })
			  .catch(function(error) {
				const displayError = document.getElementById('cardErrors');
				displayError.textContent = 'Ocurrió un error inesperado: ' + error.message;
				$('#payButton').prop('disabled', false);
				$('#payButton').removeClass('bg-secondary');
			  });
		}

		async function enviarPedido() {		
			try {
				const productos = $('input[name="productos"]').val();
				let direccion = $('input[name="direccion"]').val();
				if (!direccion) {
					direccion = 'RECOGIDA';
				}
				const total = $('input[name="value"]').val();
				const nombre = $('#a_domicilio_nombre_completo:visible').val() || $('#en_local_nombre_completo:visible').val();
				const email = $('#a_domicilio_email:visible').val() || $('#en_local_email:visible').val();
				const telefono = $('#a_domicilio_telefono:visible').val() || $('#en_local_telefono:visible').val();
				const observaciones = $('#observaciones:visible').val();
				const response = await fetch('{{ route('enviar_pedido') }}', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					body: JSON.stringify({
						productos: productos,
						direccion: direccion,
						total: total,
						nombre:nombre,
						email:email,
						telefono:telefono,
						observaciones: observaciones
					})
				});

				const result = await response.json();
				
				if (result.success) {
					window.location.href = `/mostrar/hoy/${result.id}`;
				} else {
					const displayError = document.getElementById('cardErrors');
					displayError.textContent = 'Hubo un problema al enviar el pedido.';
					$(payButton).prop('disabled', false);
					$(payButton).removeClass('bg-secondary');
				}
			} catch (error) {
				console.error('Error en la solicitud:', error);
				const displayError = document.getElementById('cardErrors');
				displayError.textContent = 'Hubo un problema al enviar el pedido.';
				$(payButton).prop('disabled', false);
				$(payButton).removeClass('bg-secondary');
			}
		}
</script>
@endpush