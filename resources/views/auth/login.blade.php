@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Iniciar Sesión</p>
            
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

                  @if (Session::has('success'))
                  <blockquote class="quote-default quote-default-left mb-4">
                    <div class="quote-body">
                      <div class="unit unit-xs-horizontal unit-xs-top unit-spacing-sm">
                        <div class="unit-left">
                          <svg x="0px" y="0px" width="37px" height="27px" viewBox="0 0 37 27">
                            <path d="M16.916,18.73c0,2.351-0.833,4.319-2.499,5.901C12.754,26.208,10.786,27,8.516,27  c-2.268,0-4.255-0.792-5.96-2.369c-1.703-1.582-2.552-3.477-2.552-5.679c0-2.208,1.022-4.891,3.064-8.054L9.879-0.018h6.585  l-4.202,11.471C15.365,12.847,16.916,15.275,16.916,18.73z M36.99,18.73c0,2.351-0.833,4.319-2.499,5.901  C32.828,26.208,30.86,27,28.588,27c-2.269,0-4.256-0.792-5.959-2.369c-1.702-1.582-2.555-3.477-2.555-5.679  c0-2.208,1.025-4.891,3.066-8.054l6.813-10.916h6.581l-4.197,11.471C35.437,12.847,36.99,15.275,36.99,18.73z"></path>
                          </svg>
                        </div>
                        <div class="unit-body">
                          <h4 style="    font-size: 20px;
                          padding-top: 10px;">{{Session::get('success')}}</h4>
                        </div>
                      </div>
                    </div>
                    
                  </blockquote>
                  @endif

                  <div class="group-sm mb-4">
                    <a class="btn btn-facebook btn-icon btn-icon-left" href="{{route('registro')}}">
                        <span class="icon icon-xs fa-user"></span>
                        <span>Registrate</span>
                      </a>
                     
                  </div>
                 
                  <!-- RD Mailform-->
                  <form  action="{{ route('login') }}" method="POST" autocomplete="off" >
                    {{ csrf_field() }}
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
                      <label class="form-label form-label-outside rd-input-label" for="contact-email">Contraseña</label>
                      <input class="form-control form-control-has-validation form-control-last-child {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" autocomplete="new-password">
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="offset-top-50">

                      <button class="btn btn-primary-lighter btn-fullwidth btn-shadow" type="submit">Ingresar</button>
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