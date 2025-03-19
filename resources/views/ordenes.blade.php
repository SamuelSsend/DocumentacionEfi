@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Historial de ordenes</p>
            <ul class="breadcrumbs-custom offset-top-10">
                <li><a href="{{route('inicio')}}">Regresar a inicio</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
      Se agrego el producto al carrito, <b>exitosamente.</b>
    </div>
    @endif

    <section class="section-50 section-sm-100" style="padding-top: 50px !important;">
      <div class="container isotope-wrap">
        
        <div class="row justify-content-sm-center">
          <div class="col-xs-12">
            
            <div class="table-responsive">
                <table class="table table-accent table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">Pedido</th>
                      <th class="text-center">Total pagado</th>
                      <th class="text-center">Dirección</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Estado</th>
                    </tr>
                  </thead>
                  @foreach ($pedidos as $item)
                  <tbody>
                    <tr>
                      <td class="text-center">{{$item->producto}}</td>
                      <td class="text-center">${{$item->precio}}</td>
                      <td class="text-center">{{$item->direccion}}</td>
                      <td class="text-center">{{substr($item->fecha,0,10)}}</td>
                      <td class="text-center">{{$item->estado}}</td>
                    </tr>
                  </tbody>
                  @endforeach
                 
                </table>
              </div>
              
          </div>
          <div class="col-xs-12 mt-4">
            {{$pedidos->render()}}
          </div>
          
        </div>
       
      </div>
    </section>
   
  </main>
@endsection