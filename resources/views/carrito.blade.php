<?php
//use App\Currency;
use App\TypeOrder;

//$currencies = Currency::all();
$typeOrders = TypeOrder::all();
?>
@extends('layouts.user')
@section('user')
<main class="page-content carrito">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Mi pedido</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="section-50 section-sm-195">
      <div class="container"  >
        <div class="row">
          <div class="col-xs-12">
            <h4 class="text-left font-default">{{count($carrito)}} Producto(s) en el carrito</h4>
            <div class="table-responsive offset-top-30">
              <table class="table table-shopping-cart">
                <tbody>
                    @if (count($carrito) <= '0')
                    <tr>
                        <td>No hay nigun producto en el carrito.</td>
                    </tr>
                    @else
                    @foreach ($carrito as $item)
                        <tr id="item-{{$item->id}}">
                            <td style="width: 1px">
                                <div class="inset-left-20">
                                    <div class="product-image">
                                        @if($item->portada)
                                            <img src="{{asset('admin/'.$item->portada)}}" width="155" height="130" style="width: 155px; height: 130px; object-fit: contain;" alt="{{$item->alimento}}">
                                        @else
                                            <img src="/img/sin-imagen.jpg" width="155" height="130" style="width: 155px; height: 130px; object-fit: contain;" alt="{{$item->alimento}}">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="min-width: 340px; text-align: left;">
                                <span class="h5 text-sbold">{{$item->alimento}}</span>
                                @if($item->comentario)
                                    <div class="offset-1 font-italic">{!! nl2br(e($item->comentario)) !!}</div>
                                @endif
                                @if($item->subproductos->count() > 0)
                                    <div class="carrito-ingredientes" style="margin-top: 4px;">
                                        @foreach($item->subproductos as $subproducto)
                                            @php
                                                $subproducto2 = App\Subproducto::find($subproducto->subproducto_id);
                                            @endphp
                                            @if($subproducto2)
                                                <span>{{$subproducto2->nombre}}</span>
                                                <span>/</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="carrito-cantidad">
                                    <input type="number" value="{{$item->cantidad}}" min="1" onchange="handleOnChangeCantidad({{$item->id}}, this)">
                                </div>
                            </td>
                            <td>
                                <div class="inset-left-20"><span class="h5 text-sbold" style="white-space: nowrap">{{$item->precio}} €</span></div>
                            </td>
                            <td>
                                <div class="inset-left-20"><span class="h5 text-sbold" style="white-space: nowrap"><span class="item-total">{{number_format($item->precio * $item->cantidad, 2)}}</span> €</span></div>
                            </td>
                            <td>
                                <div class="inset-left-20">
                                    <!--TEST-->
                                    @php
                                        $productoID = $item->idalimento;
                                        $tieneCombinados = App\Alimento::find($productoID)->combinados->count() > 0;
                                    @endphp
                                    <form  action="{{route('destroy_carrito',$item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  style="appearance: none; background: none; border: none; padding: 0;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.43081 0C9.03241 0 8.6657 0.217176 8.4742 0.566527L6.99075 3.27273H1.09091C0.488417 3.27273 0 3.76114 0 4.36364C0 4.96613 0.488417 5.45455 1.09091 5.45455H2.72754V22.9091C2.72754 23.5116 3.21596 24 3.81845 24H20.1821C20.7846 24 21.273 23.5116 21.273 22.9091V5.45455H22.9091C23.5116 5.45455 24 4.96613 24 4.36364C24 3.76114 23.5116 3.27273 22.9091 3.27273H17.0164L15.5671 0.574674C15.377 0.220781 15.0078 0 14.6061 0H9.43081ZM14.5397 3.27273L13.9537 2.18182H10.0769L9.47887 3.27273H14.5397ZM9.81818 8.72727C10.4207 8.72727 10.9091 9.21569 10.9091 9.81818V16.9091C10.9091 17.5116 10.4207 18 9.81818 18C9.21569 18 8.72727 17.5116 8.72727 16.9091V9.81818C8.72727 9.21569 9.21569 8.72727 9.81818 8.72727ZM14.1818 8.72727C14.7843 8.72727 15.2727 9.21569 15.2727 9.81818V16.9091C15.2727 17.5116 14.7843 18 14.1818 18C13.5793 18 13.0909 17.5116 13.0909 16.9091V9.81818C13.0909 9.21569 13.5793 8.72727 14.1818 8.72727ZM4.90936 5.45455V21.8182H19.0912V5.45455H4.90936Z" fill="#9C9C9C"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif


                </tbody>
              </table>
                @if (count($carrito) > 0)
                <div id="alerta"></div>
                <div class="carrito-formulario-cupon-cliente">
                    <label for="cupon" class="label-cupon">Código Cupón</label>
                    <input type="text" id="cupon" class="input-cupon">
                    <div id="cupones"></div>
                    <button type="button" class="boton-pagar" onclick="aplicarCupon()">Aplicar Cupón</button>
                </div>
                @endif
                
            </div>
              @if (count($carrito) > 0)

              <form id="form-payment" action="{{ route('pay') }}" method="POST">
                  @csrf


                <div class="row offset-top-80 inset-left-50 inset-right-50">
                    <div class="col-md-8">
                        <p class="mb-3 mb-md-0" style="font-size: 32px; font-weight: 900; text-align:left; color: #2B2C2F; line-height: 32px;">Total de la cesta</p>
                    </div>
                    <div class="col-md-4 text-left text-md-right">
                        <p style="font-size: 32px; font-weight: 900; color: #2B2C2F; line-height: 32px;"><span id="total-cesta" >{{$total->total}}</span> €</p>
                    </div>
                </div>

                <div class="carrito-separador"></div>

                <div class="row inset-left-50 inset-right-50 accordion" id="metodos-de-envio">
                    <div class="col-md-8">
                        <p class="mb-3 mb-md-0" style="font-size: 32px; font-weight: 900; text-align:left; color: #2B2C2F; line-height: 32px;">Forma de envío</p>
                    </div>

                    <div class="col-md-8">
                    <div class="carrito-radio radio" style="margin-bottom: 24px; margin-top: 24px;">
                        <input required type="radio" name="type_order" value="1" id="envio-domicilio"  data-toggle="collapse" data-target="#envio-domicilio-container" aria-expanded="false" aria-controls="envio-domicilio-container">
                        <label for="envio-domicilio">Envío a domicilio</label>
                        <div class="ml-auto text-left text-md-right">
                                <p style="font-size: 28px; font-weight: 900; color: #2B2C2F; line-height: 32px;">+ {{ number_format(\App\Alimento::find($config->gastos_de_envio_id)->precio, 2) }} €</p>
                            </div>
                    </div>

                        <!-- A mostrar si seleccionamos envío a domicilio -->
                        <div id="envio-domicilio-container" class="collapse" data-parent="#metodos-de-envio">
                            <div class="carrito-formulario-datos-cliente">
                                <div style="margin-bottom: 20px;">
                                    <label for="a_domicilio_nombre_completo">Nombre completo</label>
                                    <input type="text" id="a_domicilio_nombre_completo" name="nombre_1">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label for="a_domicilio_telefono">Teléfono móvil de contacto</label>
                                    <input type="text" id="a_domicilio_telefono" name="telefono_1">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label for="a_domicilio_email">Email</label>
                                    <input type="email" id="a_domicilio_email" name="email_1" value="">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label for="a_domicilio_direccion">Dirección de entrega</label>
                                    <input type="text" id="a_domicilio_direccion" name="direccion">
                                </div>
{{--                                <div style="margin-bottom: 20px;">--}}
{{--                                    <label for="a_domicilio_codigo_postal">Código postal</label>--}}
{{--                                    <input type="text" id="a_domicilio_codigo_postal" name="postal_code">--}}
{{--                                </div>--}}
                                <div style="margin-bottom: 16px;">
                                    <label for="observaciones">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" cols="30" rows="3" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="carrito-radio radio" style="margin-bottom: 24px;">
                            <input required type="radio" name="type_order" value="1" id="recogida-local" data-toggle="collapse" data-target="#recoger-local-container" aria-expanded="false" aria-controls="recoger-local-container">
                            <label for="recogida-local">Recoger del local</label>
                        </div>

                        <!-- A mostrar si seleccionamos recogida en local -->
                        <div id="recoger-local-container" class="collapse" data-parent="#metodos-de-envio">
                            <div class="carrito-formulario-datos-cliente">
                                <div style="margin-bottom: 20px;">
                                    <label for="en_local_nombre_completo">Nombre completo</label>
                                    <input type="text" id="en_local_nombre_completo" name="nombre_2">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label for="en_local_telefono">Teléfono móvil de contacto</label>
                                    <input type="text" id="en_local_telefono" name="telefono_2">
                                </div>
                                <div>
                                    <label for="en_local_email">Email</label>
                                    <input type="email" id="en_local_email" name="email_2" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carrito-checkbox custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="acepto_proteccion_datos" name="acepto_proteccion_datos">
                    <label class="custom-control-label" for="acepto_proteccion_datos">Acepta protección de datos</label>
                </div>

                <div class="carrito-separador"></div>

                <div class="carrito-metodos-de-pago row inset-left-50 inset-right-50">
                    <div class="col-md-8">
                        <p style="font-size: 32px; font-weight: 900; text-align:left; color: #2B2C2F; line-height: 32px; margin-bottom: 25px;">Métodos de pago</p>
                        <div class="carrito-radio radio">
                            <input type="radio" name="metodos-de-pago" id="pago-online-con-tarjeta" checked>
                            <label class="text-left" for="pago-online-con-tarjeta">Pago online con tarjeta de crédito</label>
                        </div>
                        <div  id='paymentForm'>
                            @foreach ($typeOrders as $typeOrder)
                                <div id="{{ $typeOrder->name }}Collapse">
                                    @includeIf('components.' . strtolower($typeOrder->name) . '-collapse')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="carrito-separador"></div>

                <div class="row inset-left-50 inset-right-50">
                    <div class="col-md-12 text-left text-md-right">
                        <span style="font-size: 32px; font-weight: 900; color:#2b2c2f; border-bottom: 2px solid #2b2c2f; padding-bottom: 2px;">Total: </span>
                        <span style="font-size: 32px; font-weight: 900; color:#2b2c2f; border-bottom: 2px solid #2b2c2f; padding-bottom: 2px;">
                        <span id="total">{{ number_format($totalAbsoluto, 2) }}</span> €</span>
                        <button
                            type="submit"
                            id="payButton"
                            class="boton-pagar"
                            @if(!$estadoTPV) disabled @endif
                        >
                            <svg class="animate-spin" style="display: none; width: 20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle style="opacity: .25" cx="12" cy="12" r="10" stroke="#AAA" stroke-width="4"></circle>
                                <path style="opacity: .75" fill="#AAA" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="payButtonText">
                                Enviar mi pedido
                            </span>
                        </button>
                    </div>
                </div>


              </form>
              @endif

          </div>
          <!-- <a href="{{route('enviar_pedido')}}">TEST JSON</a> -->
        </div>
      </div>
    </section>
</main>

@push('scripts')
<script>
    function aplicarCupon() {
            let coupon = document.getElementById('cupon').value;
            let url = "{{ route('apply-coupon', ':cupon') }}";
            url = url.replace(':cupon', coupon);

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    $("#total-cesta").text(data.total);
                    $("#total").text(data.totalAbsoluto);
                    
                    location.reload();
                    
                    //actualizarCupones(data.cupon);
                    document.getElementById("cupon").value = "";
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        showAlert(xhr.responseJSON.error, 'danger');
                    } else {
                        showAlert('Error al aplicar el cupón', 'danger');
                    }
                }
            });
        }
        $(document).ready(function() {
            $.get('/obtener-cupones', function(data) {
                actualizarCupones(data.cupones);
            });
        });

        $(document).on('click', '.eliminar', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/eliminar-cupon/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        showAlert('Hubo un error al eliminar el cupón', 'danger');
                    }
                }
            });
        });
        function actualizarCupones(cupones) {
        let tabla = document.createElement('table');
        tabla.className = 'table table-borderless'; 
        
        for (let i = 0; i < cupones.length; i++) {
            let fila = document.createElement('tr');
            
            let celdaNombre = document.createElement('td');
            celdaNombre.textContent = cupones[i].nombre;
            fila.appendChild(celdaNombre);
            
            let celdaTipo = document.createElement('td');
            if (cupones[i].tipo_descuento == 'porcentaje') {
                celdaTipo.textContent = 'Descuento del ' + cupones[i].descuento + '%';
            }else if(cupones[i].tipo_descuento == 'importe_fijo'){
                celdaTipo.textContent = 'Descuento de ' + cupones[i].descuento + '€';
            } else if (cupones[i].tipo_descuento == 'envio_gratis') {
                celdaTipo.textContent = 'Envío gratis';
            }
            fila.appendChild(celdaTipo);
            
            let celdaBoton = document.createElement('td');
            let boton = document.createElement('button');
            boton.className = 'eliminar btn btn-sm btn-outline-danger';
            boton.textContent = 'Eliminar';
            boton.dataset.id = cupones[i].id;
            celdaBoton.appendChild(boton);
            fila.appendChild(celdaBoton);

            tabla.appendChild(fila);
        }
        
        document.getElementById('cupones').innerHTML = '';
        document.getElementById('cupones').appendChild(tabla);
    }
    function changeType(type_id) {
        $.ajax({
            url: "{{route('carrito.change-type')}}",
            type: 'PATCH',
            data: {
                'type_id': type_id,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                $("#total-cesta").text(data.total);
                if($("#recogida-local").is(":checked")) {
                    $("#total").text(data.totalAbsoluto);
                } else {
                    $("#total").text(data.totalAbsoluto);
                }
            }
        });
    }

    function showAlert(message, type) {
        let alert = document.createElement('div');
        alert.className = 'alert alert-' + type;
        alert.textContent = message;

        document.getElementById("alerta").appendChild(alert);

        setTimeout(function() {
            document.getElementById("alerta").removeChild(alert);
        }, 3000);
    }
    document.getElementById('payButton').addEventListener('click', function(e) {
        const checkbox = document.getElementById('acepto_proteccion_datos');
        if (!checkbox.checked) {
            alert('Debes aceptar la política de protección de datos antes de continuar.');
            e.preventDefault();
        }
    });
    $(document).ready(function(){
        $('#telef div').removeClass("stepper");
        $('.stepper-arrow').css("display","none");

        $("#envio-domicilio-container, #recoger-local-container").on('shown.bs.collapse', function() {
            $(this).find('input').prop('required', true);

            if ($(this).prop('id') === "envio-domicilio-container") {
                changeType(1);
            } else {
                changeType(2);
            }
        });

        $("#envio-domicilio-container, #recoger-local-container").on('hidden.bs.collapse', function() {
            $(this).find('input').prop('required', false);
        });

        $('#direccion').keyup(function(){
            var car_direccion = $('#direccion').val();
            if(car_direccion >= '2'){
                $('#buyButton').attr("disabled", false);
            }else{
                $('#buyButton').attr("disabled", true);
            }
        });

        $("#envio-domicilio").click()
    });

    function handleOnChangeCantidad(id, input) {
        let url = "{{route('carrito.update', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'PATCH',
            data: {
                'cantidad': input.value,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                $(`#item-${id}`).find('.item-total').text((parseFloat(data.carrito.precio) * parseFloat(data.carrito.cantidad)).toFixed(2));
                $("#total-cesta").text(data.total);
                if($("#recogida-local").is(":checked")) {
                    $("#total").text(data.totalAbsoluto);
                } else {
                    $("#total").text(data.totalAbsoluto);
                }
                $("#num-carrito").text(data.num_carrito)
                if (data.mensaje) {
                    showAlert(data.mensaje, 'warning');
                    setTimeout(function(){
                        location.reload();
                    },3000);
                }
            }
        });
    }
</script>
@endpush
@endsection
