@extends('layouts.user')
@section('user')


<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Confirmación de Pedido</p>
            <ul class="breadcrumbs-custom offset-top-10">
                <li><a href="{{route('inicio')}}">Regresar a inicio</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    @if(Session::has('warning'))
        <div class="alert alert-warning" role="alert">
            <h4>{{ Session::get('warning') }}</h4>
        </div>
    @elseif(Session::has('success'))
      <div class="alert alert-success" role="alert">
      <h4>Su pedido se ha enviado correctamente y pronto estará en camino. <br>Nº de pedido: {{ $id }}</h4>
      </div>

    <img class="section-sm-50" src="/img/delivery-guy.gif"alt="Motorista" width=250px margin-top=0>
    @endif

  </main>


@endsection
