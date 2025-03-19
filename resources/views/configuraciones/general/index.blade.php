@extends('layouts.admin')
@section('contenido')
<div class="main-content">


    @include('navbar')



    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">



          <!-- Header -->
          <div class="header mt-md-5">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Pretitle -->
                  <h6 class="header-pretitle">
                    Configuración
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Página de inicio
                  </h1>

                </div>
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('admin.general.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
              @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>
            <div class="form-group">
              @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{Session::get('danger')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>

            <!-- Team name -->
            <div class="form-group">
                <h2 class="mb-2">
                    General
                </h2>
                <p class="text-muted mb-4">
                    Configuración general para toda la página.
                </p>
                <div class="card mb-4">
                    <div class="card-body">
                        <input type="text" class="form-control form-control-flush" placeholder="Nombre de la empresa" name="nombre_empresa" value="{{$general->nombre_empresa}}">
                        @if ($errors->has('nombre_empresa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre_empresa') }}
                                </div>
                                @endif
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <input type="text" class="form-control form-control-flush" placeholder="Texto para pié de página" name="cr" value="{{$general->cr}}">
                        @if ($errors->has('cr'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cr') }}
                                </div>
                                @endif
                    </div>
                </div>
                <div class="card mb-4">
                  <div class="card-body">
                      Logo
                    <input type="file" name="logo" class="files" >
                  </div>

                </div>

                <div class="card mb-4">
                    <div class="card-body">

                        <label for="carta">Carta en PDF</label>
                        @if($general->carta)
                        <div>
                                <a class="btn btn-sm btn-secondary" href="{{asset('admin/'.$general->carta)}}" target="_blank">Ver Carta</a>
                        </div>
                        @endif

                        <input type="file" name="carta" class="files" accept="application/pdf" >
                    </div>
                </div>

              <div class="form-group">
                <h2 class="mb-2">
                    Gastos de envío
                </h2>
                  <div class="card">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col-12 col-md-6 mb-3">
                                  <label for="validationServer01">ID ARTÍCULO ENVÍO</label>
                                  <input type="text" class="form-control" placeholder="Gastos de envío"
                                         value="{{$general->gastos_de_envio_id}}"
                                         name="gastos_de_envio_id" required="">
{{--                                  @if ($errors->has('gastos_de_envio'))--}}
{{--                                      <div class="invalid-feedback">--}}
{{--                                          {{ $errors->first('gastos_de_envio') }}--}}
{{--                                      </div>--}}
{{--                                  @endif--}}
                              </div>
                          </div>
                      </div>
                  </div>

              </div>

              <div class="form-group">
                <h2 class="mb-2">
                    Precio mínimo del carrito
                </h2>
                  <div class="card">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col-12 col-md-6 mb-3">
                                  <input type="text" class="form-control" placeholder="Precio mínimo"
                                         value="{{$general->precio_minimo}}"
                                         name="precio_minimo" required="">
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
            
            <div class="form-group">
              <h2 class="mb-2">
                  Menú de la web
              </h2>
              <p class="text-muted mb-4">
                  Personaliza el color de texto y fondo del menú.
              </p>
              <div class="card">
                  <div class="card-body">
                      <div class="form-row">
                        <div class="col-12 col-md-6 mb-3">
                          <label for="validationServer01">Color de texto</label>
                          <input type="text" class="form-control color-picker" name="color_texto_menu" required="" value="{{$general->color_texto_menu}}">

                          @if ($errors->has('color_texto_menu'))
                          <div class="invalid-feedback">
                              {{ $errors->first('color_texto_menu') }}
                          </div>
                          @endif
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                          <label for="validationServer02">Color de fondo</label>
                          <input type="text" class="form-control color-picker" name="color_fondo_menu" required="" value="{{$general->color_fondo_menu}}">
                          @if ($errors->has('color_fondo_menu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('color_fondo_menu') }}
                                </div>
                                @endif
                        </div>
                      </div>
                  </div>
                </div>
          </div>


            <div class="form-group">
                <h2 class="mb-2">
                    Contacto
                </h2>
                <p class="text-muted mb-4">
                    Información de contacto de la empresa.
                </p>
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer01">Telefono 1</label>
                            <input type="text" class="form-control" placeholder="Telefono de contacto" value="{{$general->telefono1}}" name="telefono1" required="" data-mask="(+00) 000-0000000">
                            @if ($errors->has('telefono1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telefono1') }}
                                </div>
                                @endif

                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer02">Telefono 2</label>
                            <input type="text" class="form-control" placeholder="Telefono de contacto" value="{{$general->telefono2}}" name="telefono2" required="" data-mask="(+00) 000-0000000">
                            @if ($errors->has('telefono1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telefono1') }}
                                </div>
                                @endif
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="validationServer02">Correo</label>
                                <input type="text" class="form-control" placeholder="Correo electrónico" value="{{$general->correo}}" name="correo" required="">
                                @if ($errors->has('correo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('correo') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="validationServer02">Horarios</label>
                                <input type="text" class="form-control" placeholder="Horarios de atención" value="{{$general->horarios}}" name="horarios" required="">
                                @if ($errors->has('horarios'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('horarios') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div  class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="validationServer02">Ubicación</label>
                                <textarea class="form-control" placeholder="Dirección de la empresa" name="ubicacion" required="">{{$general->ubicacion}}</textarea>
                                @if ($errors->has('ubicacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ubicacion') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div  class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="validationServer02">Google maps</label>
                                <textarea class="form-control" placeholder="Iframe" name="iframe" required="" style="height:120px">{{$general->iframe}}</textarea>
                                @if ($errors->has('iframe'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('iframe') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
            </div>

            <div class="form-group">
                <h2 class="mb-2">
                    Redes Sociales
                </h2>
                <p class="text-muted mb-4">
                    Páginas de redes sociales.
                </p>
                <div class="card mb-4">
                   <div class="card-body">
                        <div class="input-group input-group-merge mb-3">
                            <input type="text" name="facebook" class="form-control form-control-prepended" placeholder="Facebook" value="{{$general->facebook}}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fe fe-facebook"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-3">
                            <input type="text" name="instagram" class="form-control form-control-prepended" placeholder="Instagram" value="{{$general->instagram}}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fe fe-instagram"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group-merge mb-3">
                            <input type="text" name="twitter" class="form-control form-control-prepended" placeholder="Twitter" value="{{$general->twitter}}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fe fe-twitter"></span>
                                </div>
                            </div>
                        </div>
                   </div>


                </div>

                <div class="card mb-4">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                            <textarea id="txt_facebook" name="facebook_iframe" class="form-control" style="height:222px">{{$general->facebook_iframe}}</textarea>
                        </div>
                        <div class="col-lg-6" id="cont_facebook">

                            <?php echo $general->facebook_iframe?>

                        </div>
                      </div>
                  </div>
               </div>
            </div>

            <!-- Divider -->
            <hr class="mt-4 mb-5">


            <div class="form-group">
              <h2 class="mb-2">
                  API Stripe
              </h2>
              <p class="text-muted mb-4">
                  Llaves de Stripe
              </p>
              <div class="card mb-4">
                 <div class="card-body">
                    <div class="form-row">
                      <div class="col-12 col-md-6 mb-3">
                          <label for="validationServer02">Llave pública</label>
                          <input type="text" class="form-control" placeholder="Llave pública" value="{{$general->stripe_public}}" name="stripe_public" required="">
                          @if ($errors->has('stripe_public'))
                          <div class="invalid-feedback">
                              {{ $errors->first('stripe_public') }}
                          </div>
                          @endif
                      </div>
                      <div class="col-12 col-md-6 mb-3">
                          <label for="validationServer02">Llave privada</label>
                          <input type="text" class="form-control" placeholder="Llave privada" value="{{$general->stripe_private}}" name="stripe_private" required="">
                          @if ($errors->has('stripe_private'))
                          <div class="invalid-feedback">
                              {{ $errors->first('stripe_private') }}
                          </div>
                          @endif
                      </div>
                  </div>

                 </div>


              </div>


          </div>

              <div class="form-group">
                  <h2 class="mb-2">
                      API Hostel Táctil
                  </h2>
                  <p class="text-muted mb-4">
                      Configuración Hostel Táctil
                  </p>
                  <div class="card mb-4">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col-12 col-md-6 mb-3">
                                  <label for="hosteltactil_api">API URL</label>
                                  <input type="text" class="form-control" placeholder="http://IP:PUERTO/api" value="{{$general->hosteltactil_api}}" name="hosteltactil_api" required="">
                                  @if ($errors->has('hosteltactil_api'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('hosteltactil_api') }}
                                      </div>
                                  @endif
                              </div>
                              <div class="col-12 col-md-6 mb-3">
                                  <label for="hosteltactil_token">Token</label>
                                  <input type="password" class="form-control" placeholder="Token" value="{{$general->hosteltactil_token}}" name="hosteltactil_token" required="">
                                  @if ($errors->has('hosteltactil_token'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('hosteltactil_token') }}
                                      </div>
                                  @endif
                              </div>
                              <div class="col-12 col-md-6 mb-3">
                                  <label for="hosteltactil_idlocal">ID Local</label>
                                  <input type="text" class="form-control" placeholder="ID Local" value="{{$general->hosteltactil_idlocal}}" name="hosteltactil_idlocal" required="">
                                  @if ($errors->has('hosteltactil_idlocal'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('hosteltactil_idlocal') }}
                                      </div>
                                  @endif
                              </div>
                              <div class="col-12 col-md-6 mb-3">
                                  <label for="hosteltactil_tarifa">Tarifa</label>
                                  <select type="text" class="form-control"
                                           name="hosteltactil_tarifa"
                                          required=""
                                  >
                                      @for($i = 1; $i <= 8; $i++)
                                          <option value="{{$i}}" @if($general->hosteltactil_tarifa == $i) selected @endif>{{$i}}</option>
                                      @endfor
                                  </select>
                                  @if ($errors->has('hosteltactil_tarifa'))
                                      <div class="invalid-feedback">
                                          {{ $errors->first('hosteltactil_tarifa') }}
                                      </div>
                                  @endif
                              </div>
                          </div>

                      </div>


                  </div>


              </div>



            <button type="submit" class="btn btn-block btn-primary">Guardar cambios</button>
            <a href="#" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div>
  @push('scripts')
      <script>

          $('.dz-button').text('Subir logo');

          $('.color-picker').spectrum({
            type: "text"
          });

          $('#txt_facebook').keyup(function(){
            let data = $('#txt_facebook').val();

            $('#cont_facebook').html(' ');
            $('#cont_facebook').html(data.replace(/['"]+/g, ''));
          });

          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp").change(function() {
            readURL(this);
          });

          $(document).ready(function() {
              $('input.files').fileuploader({
                  // Options will go here
              });
          });

      </script>
  @endpush
@endsection
