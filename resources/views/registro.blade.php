@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs" style="background-image: url(images/registro.jpg);background-size:100%">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Registrate ahora!</p>
            
          </div>
        </div>
      </div>
    </section>

    <!-- Buttons-->
    <section class="bg-white text-center section-50 section-sm-100" style="padding-top: 30px !important">
      <div class="container">
        <div class="row justify-content-xs-center">
          <div class="col-sm-8 col-lg-6">
            <div class="responsive-tabs responsive-tabs-modern responsive-tabs-modern-mod-1 responsive-tabs-horizontal" style="display: block; width: 100%;">
              
              <div class="resp-tabs-container">
              
                <div class="resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">

               
                 
                  <!-- RD Mailform-->
                  <form  action="{{ route('registro.store') }}" method="POST" autocomplete="off" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-label form-label-outside rd-input-label" for="contact-name">Nombre completo</label>
                        <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" autocomplete="new-text">
                        @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                    <div class="form-group">
                      <label class="form-label form-label-outside rd-input-label" for="contact-name">Correo electrónico</label>
                      <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" autocomplete="new-text">
                      @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="form-label form-label-outside rd-input-label" for="contact-name">Dirección de envío</label>
                      <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('direccion') ? ' is-invalid' : '' }}" type="text" name="direccion" autocomplete="new-text">
                      @if ($errors->has('direccion'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="form-label form-label-outside rd-input-label" for="contact-name">Nº de Teléfono</label>
                      <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('telefono') ? ' is-invalid' : '' }}" type="text" name="telefono" autocomplete="new-text">
                      @if ($errors->has('telefono'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telefono') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="form-label form-label-outside rd-input-label" for="contact-email">Contraseña</label>
                      <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" autocomplete="new-password">
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="offset-top-50">

                      <button class="btn btn-primary-lighter btn-fullwidth btn-shadow" type="submit">Registrarme</button>
                    </div>
                  </form>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection