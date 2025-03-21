<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <?php

    $config = DB::table('config_general')
        ->first();

        $slider = DB::table('slider')
        ->get();

        $seccion_uno = DB::table('seccion_uno')
        ->get();

        $menu_comida = DB::table('menu_comida')
            ->whereActivo(1)
            ->get();

        $alimento = \App\Alimento::where('activo_hosteltactil', true)->get();

        $num_menu = count($menu_comida);

        $inicio = DB::table('inicio')
        ->first();

        $seccion_tres = DB::table('seccion_tres')
        ->get();

        $galeria = DB::table('galeria')
            ->take('4')
            ->get();

        $nav = DB::table('navegacion')
        ->get();

    if (session()->has('iduser')) {
        $num_carrito = \App\Carrito::query()->where('uuid', session()->get('iduser'))->where('estado', 'En el carrito')->sum('cantidad');
    } else {
        $num_carrito = 0;
    }

    ?>
    <!-- Site Title-->
    <title><?php echo $config->nombre_empresa?></title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <!-- Stylesheets-->
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
    <style>
      .rd-navbar-nav .navbar-icon:before{
        font-size: 41px !important;
      }
      .thumbnail-menu-modern .price:before {
          content: "";
          display: inline-block;
      }
      .rd-navbar-nav .navbar-icon:before {

        color: <?php echo $config->color_texto_menu?> !important;
      }
    </style>
  </head>
  <body>
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Header-->
      <header class="page-head">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-minimal" style="background: {{$config->color_fondo_menu}} !important">
          <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="100px" data-lg-stick-up-offset="100px" style="background: {{$config->color_fondo_menu}} !important">
            <div class="container container-fluid">
              <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand--><a class="rd-navbar-brand brand" href="http://www.thebeastburger.es">
                    <img src="/img/logo-the-beast.webp" alt="The Beast" style="height: 41px;">
                    </a>
                </div>
                <!-- RD Navbar Nav-->
                <div class="rd-navbar-nav-wrap" style="display: flex; align-items: center; justify-content: space-between;">
                  <!-- RD Navbar Nav-->
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li><a class="navbar-icon restaurant-icon-19" href="{{ route('cliente.menu.index') }}" style="color: {{$config->color_texto_menu}} !important">Menu</a>
                      <!-- RD Navbar Dropdown-->
                      <ul class="rd-navbar-dropdown menu-img-wrap">
                        @foreach ($menu_comida as $item)
                          @if (strlen($item->titulo) >= '9')
                            <li class="menu-img">
                              <a href="{{route('cliente.menu.show',strtolower($item->titulo))}}"  style="font-size:11px !important">
                                <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60" onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
                                <span style="">{{$item->titulo}}</span>
                              </a>
                            </li>
                          @else
                            <li class="menu-img">
                              <a href="{{route('cliente.menu.show',strtolower($item->titulo))}}" style="font-size:11px !important">
                                <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60" onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
                                <span>{{$item->titulo}}</span>
                              </a>
                            </li>
                          @endif

                        @endforeach
                      </ul>
                    </li>
                      <li><a class="navbar-icon restaurant-icon-30" href="{{ route('cliente.menu.index') }}" style="color: {{$config->color_texto_menu}} !important">Carta</a>
                          <!-- RD Navbar Dropdown-->
                          <ul class="rd-navbar-dropdown menu-img-wrap">
                              @foreach ($menu_comida as $item)
                                  @if (strlen($item->titulo) >= '9')
                                      <li class="menu-img">
                                          <a href="{{route('cliente.carta.show',strtolower($item->titulo))}}"  style="font-size:11px !important">
                                              <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60" onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
                                              <span style="">{{$item->titulo}}</span>
                                          </a>
                                      </li>
                                  @else
                                      <li class="menu-img">
                                          <a href="{{route('cliente.carta.show',strtolower($item->titulo))}}" style="font-size:11px !important">
                                              <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60" onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
                                              <span>{{$item->titulo}}</span>
                                          </a>
                                      </li>
                                  @endif

                              @endforeach
                          </ul>
                      </li>
                   @foreach ($nav as $item)

                      <li class="{{ (request()->is('contacto')) ? 'active' : '' }}">
                        <a class="navbar-icon {{$item->icono}}" href="{{$item->enlace}}" style="color: {{$config->color_texto_menu}} !important">{{$item->titulo}}</a>
                      </li>

                   @endforeach


                  </ul>

                  <!-- RD Navbar Shop-->
                  <ul class="rd-navbar-nav rd-navbar-shop list-inline" style="display: flex; align-items: center;">
                      <li>
                        <a class="unit unit-horizontal unit-middle unit-spacing-xxs link-gray-light" href="{{route('open_carrito')}}" style="position: relative;">
                            <div class="unit-left"><span class="icon icon-md icon-primary thin-icon-cart"></span></div>
                            <span id="num-carrito" style="color: {{$config->color_texto_menu}} !important; font-size: 12px; position: absolute; top: -5px; right: -16px; width: 20px; height: 20px; border: 1px solid {{$config->color_texto_menu}}; border-radius: 99999px; display: flex; align-items: center; justify-content: center; text-align: center;padding: 4px; letter-spacing: 0;">{{$num_carrito}}</span>
                        </a>
                      </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- Page Content-->
      @yield('user')
      <!-- Page Footer -->
      <footer class="page-foot text-sm-left">
        <section class="bg-gray-darker section-top-55 section-bottom-60">
          <div class="container">
            <div class="row border-left-cell">
              <div class="col-sm-6 col-md-3 col-lg-5"><a class="brand brand-inverse" href="index.html">
                  <img src="/img/logo-the-beast.webp" alt="The Beast" style="height: 41px;">
                <ul class="list-unstyled contact-info offset-top-5">
                  <li>
                    <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                      <div class="unit-left"><span class="text-white">Dirección:</span></div>
                      <div class="unit-body text-left text-gray-light">
                        <p>{{$config->ubicacion}}</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                      <div class="unit-left"><span class="text-white">Email:</span></div>
                      <div class="unit-body"><a class="link-gray-light" href="mailto:#">{{$config->correo}}</a></div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-sm-6 col-md-3 offset-top-50 offset-sm-top-0">
                <h4 class="text-uppercase">Menú</h4>
                <ul class="list-tags offset-top-15">
                  @foreach ($menu_comida as $item)
                  <li class="text-gray-light"><a class="link-gray-light" href="menu-single.html">{{$item->titulo}}</a></li>
                  @endforeach
                </ul>
                <a href="{{route('login')}}" style="display: inline-block; background-color:#cc0000; margin-top: 10px; border-radius: 30px; padding: 8px 25px;">
                    <span style="font-size: 14px; text-transform: uppercase; color: #fff; display: block;">Iniciar sesión</span>
                </a>
              </div>
              <!-- <div class="col-sm-10 col-lg-5 offset-top-50 offset-md-top-0 col-md-6">
                <h4 class="text-uppercase"><a class="link-gray-light" href="{{route('faq')}}">Preguntas frecuentes</a></h4>
              </div> -->
            </div>
          </div>
        </section>
        <section class="section-20 bg-white">
          <div class="container">
            <div class="row justify-content-xs-center justify-content-sm-between">
              <div class="col-sm-5 offset-top-26 text-md-left">
                <p class="copyright">
                  {{$config->cr}}
                  <!-- {%FOOTER_LINK}-->
                </p>
              </div>
              <div class="col-sm-4 offset-top-30 offset-sm-top-0 text-md-right">

                <ul class="list-inline list-inline-sizing-1">
                      <li><a class="link-silver-light" target="_blank" href="{{$config->instagram}}"><span class="icon icon-xs fa-instagram"></span></a></li>
                      <li><a class="link-silver-light" target="_blank" href="{{$config->facebook}}"><span class="icon icon-xs fa-facebook"></span></a></li>
                      <li><a class="link-silver-light" target="_blank" href="{{$config->twitter}}"><span class="icon icon-xs fa-twitter"></span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </section>

      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    @stack('scripts')
    <!--LIVEDEMO_00 -->



  </body>
</html>
