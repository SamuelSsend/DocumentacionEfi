<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>404 Error</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <script src="/cdn-cgi/apps/head/3ts2ksMwXvKRuG480KNifJ2_JNM.js"></script><link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body class="one-screen-page bg-image-3">
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Cargando página...</p>
      </div>
    </div>
    <!-- Page-->
    <?php
        
        $config = DB::table('config_general')
        ->first();

    ?>
    <div class="page text-center">
      <!-- Page Header-->
      <header class="page-head"><a class="rd-navbar-brand brand" href="index.html">
          <div class="brand-logo">
            <svg x="0px" y="0px" width="250px" height="41px" viewbox="0 0 250 41">
              <text transform="matrix(1 0 0 1 1.144409e-004 32)" fill="#2C2D2F" font-family="'Grand Hotel'" font-size="45.22">FastDeliveryGo</text>
              <path fill-rule="evenodd" clip-rule="evenodd" fill="#EB5453" d="M43.743,2.954c2.606,0,4.719,2.091,4.719,4.672  c0,2.58-2.113,4.672-4.719,4.672c-2.606,0-4.719-2.091-4.719-4.672C39.024,5.045,41.137,2.954,43.743,2.954z"></path>
            </svg>
          </div></a></header>
      <!-- Page Content-->
      <main class="page-content">
        <section>
          <div class="container">
            <div class="row no-gutters justify-content-xs-center">
              <div class="col-sm-10 col-lg-6">
                <h4 class="font-default">Disculpe, pero esta página no existe.</h4>
                <hr class="hr divider-sm bg-primary-lighter">
                <p class="text-extra-large font-weight-light">404</p>
                <p class="offset-top-40">Es posible que haya escrito mal la dirección o que la página se haya movido</p>
                <div class="group-lg offset-top-30"><a class="btn btn-primary btn-shape-circle btn-icon-left btn-icon" href="{{route('inicio')}}"><span class="icon text-middle mdi mdi-arrow-left text-black"></span><span class="text-black">Ir a inicio</span></a><a class="btn btn-white-outline btn-shape-circle btn-icon-left btn-icon" href="{{route('index.contacto')}}"><span class="icon text-middle mdi mdi-email-outline"></span><span>Contactanos</span></a></div>
              </div>
            </div>
          </div>
        </section>

      </main>
      <!-- Page Footer-->
      <footer class="page-foot text-center">
        <p class="copyright">
            {{$config->cr}}
        </p>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
  </body>
</html>