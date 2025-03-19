@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Haz tu pedido</p>
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
            
            <div class="col-box">
              <ul class="isotope-filters-responsive">
                <li>
                  <p>Elige una categoría:</p>
                </li>
                <li class="block-top-level">
                  <!-- Isotope Filters-->
                  <button class="isotope-filters-toggle btn btn-primary-lighter btn-shape-circle" data-custom-toggle="#isotope-1" data-custom-toggle-disable-on-blur="true">Filtrar<span class="caret"></span></button>
                  <div class="isotope-filters isotope-filters-buttons" id="isotope-1">
                    <ul class="inline-list">
                        @foreach ($menu_comida as $key => $item)
                            @if (($key+1) == '1')
                                <li><a class="btn-shape-circle btn active" data-isotope-filter="Category {{($key + 1)}}" data-isotope-group="gallery" href="#">{{$item->titulo}}</a></li>
                            @else
                                <li><a class="btn-shape-circle btn active" data-isotope-filter="Category {{($key + 1)}}" data-isotope-group="gallery" href="#">{{$item->titulo}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          
          <div class="col-xs-12 offset-top-40">
            <!-- Isotope Content-->
            <div class="row isotope isotope-menu" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group">
                @foreach ($menu_comida as $key => $categoria)
                    @foreach ($alimento as $item)
                        @if ($categoria->titulo == $item->categoria)
                            <div class="col-xs-12 col-sm-6 col-md-4 isotope-item" data-filter="Category {{($key + 1)}}">
                                <div class="thumbnail-menu-modern">
                                    <figure>
                                        <img class="img-responsive" src="{{asset('admin/'.$item->portada)}}" alt="" width="310" height="260"/>
                                    </figure>
                                    <div class="caption">
                                        <h5><a class="link link-default" href="#">{{$item->titulo}}</a></h5>
                                        <p class="text-italic">{{$item->descripcion}}</p>
                                        <p class="price">{{$item->precio}} €</p>
                                        @if (auth::check())
                                        <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="{{route('add_cart',$item->id)}}" style="padding: 5px 20px !important;">
                                          <span class="thin-icon-cart" style="font-size: 23px !important;"></span> Al carrito
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
              
            </div>
          </div>
        </div>
       
      </div>
    </section>
   
  </main>
@endsection