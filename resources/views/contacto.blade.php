@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Contactanos</p>
            <ul class="breadcrumbs-custom offset-top-10">
              <li><a href="{{route('inicio')}}">Inicio</a></li>
              <li class="active">Contacto</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="text-center text-sm-left section-50 section-sm-top-100 section-sm-bottom-100">
      <div class="container">
        <div class="row justify-content-xs-center">
          <div class="col-md-8">
            <h4 class="font-default text-center">Complete el formulario</h4>
            <p class="text-center">
                Estamos disponibles 24/7 por correo electrónico o por teléfono. También puede usar nuestro formulario de contacto rápido para hacer una pregunta sobre nuestros servicios que ofrecemos regularmente. Estaremos encantados de responder sus preguntas..</p>

            
                @if(Session::has('success'))
                    <div class="text-center link-inline active mb-4">
                        {{Session::get('success')}}
                    </div>
               @endif
            <!-- RD Mailform-->
            <form class="" action="{{route('send_contacto.contacto')}}" method="POST">
                @csrf
              <div class="form-inline-flex">
                <div class="form-group">
                  <label class="form-label form-label-outside" for="contact-name-2">Nombres completos</label>
                  <input class="form-control" type="text" placeholder="Nombres" name="nombres">
                    @if ($errors->has('nombres'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombres') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                  <label class="form-label form-label-outside" for="contact-username">Apellidos completos</label>
                  <input class="form-control" type="text" placeholder="Apellidos" name="apellidos">
                  @if ($errors->has('apellidos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('apellidos') }}
                        </div>
                    @endif
                </div>
              </div>
              <div class="form-group offset-top-15">
                <label class="form-label form-label-outside" for="message">Tu mensaje</label>
                <textarea class="form-control" placeholder="Que nos quieres consultar" name="mensaje"></textarea>
                @if ($errors->has('mensaje'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mensaje') }}
                    </div>
                @endif
              </div>
              <div class="offset-top-15">
                <div class="form-inline-flex">
                  <div class="form-group">
                    <label class="form-label form-label-outside" for="contact-email-2">Correo electrónico</label>
                    <input class="form-control"  type="email" placeholder="Correo electrónico" name="correo">
                        @if ($errors->has('correo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('correo') }}
                            </div>
                        @endif
                  </div>
                  <div class="form-group">
                    <label class="form-label form-label-outside" for="contact-email-2">Telefono</label>
                    <input class="form-control" type="text" placeholder="Telefono" name="telefono">
                    @if ($errors->has('telefono'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefono') }}
                        </div>
                    @endif
                  </div>
                  
                </div>
              </div>
              <div class="form-group offset-top-15" style="margin-top:50px">
                <div class="form-group">
                    <button class="btn btn-primary-lighter btn-fullwidth" type="submit">Enviar mensaje</button>
                  </div>
              </div>
            </form>
          </div>
          <div class="col-md-4 offset-top-50 offset-md-top-0 text-left">
            <aside class="inset-lg-left-70">
              <div class="row">
                <div class="col-xs-6 col-md-12">
                  <div class="h6 text-uppercase">Siguenos</div>
                  <div class="text-subline offset-top-15"></div>
                  <div class="offset-top-25">
                    <?php echo $config->facebook_iframe?>
                  </div>
                </div>
                <div class="col-xs-6 col-md-12 offset-top-50 offset-xs-top-0 offset-md-top-50">
                  <div class="block-info">
                    <div class="h6 text-uppercase">Telefono de contacto</div>
                    <div class="text-subline offset-top-15"></div>
                    <div class="offset-top-25">
                      <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                        <div class="unit-left"><span class="icon icon-xs icon-primary text-middle mdi mdi-phone"></span></div>
                        <div class="unit-body"><a class="link-default" href="tel:#">{{$config->telefono1}}</a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6 col-md-12 offset-top-50">
                  <div class="block-info">
                    <div class="h6 text-uppercase">Dirección</div>
                    <div class="text-subline offset-top-15"></div>
                    <div class="offset-top-25 unit unit-horizontal unit-spacing-xs">
                      <div class="unit-left"><span class="icon icon-xs icon-primary text-middle mdi mdi-map-marker"></span></div>
                      <div class="unit-body"><a class="link-default" href="#"><?php echo $config->ubicacion?></a></div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6 col-md-12 offset-top-50">
                  <div class="block-info">
                    <div class="h6 text-uppercase">Atención</div>
                    <div class="text-subline offset-top-15"></div>
                    <div class="offset-top-25 unit unit-horizontal unit-spacing-xs">
                      <div class="unit-left"><span class="icon icon-xs icon-primary mdi mdi-clock text-middle"></span></div>
                      <div class="unit-body"><span class="text-dark inset-left-5">{{$config->horarios}}</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>
    <section>
      <?php echo $config->iframe?>
    </section>
  </main>
@endsection