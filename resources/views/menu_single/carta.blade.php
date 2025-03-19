@extends('layouts.user')
@section('user')
    <main class="page-content">
        <!-- Breadcrumbs & Page title-->
        <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
                        <p class="h3 text-white">{{$menu_comida->titulo}}</p>
                        <ul class="breadcrumbs-custom offset-top-10">
                            <li><a href="{{route('inicio')}}">Regresar a inicio</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-50 section-sm-100">
            <div class="container">
                <div class="row justify-content-xs-center">
                    <div class="col-xs-12">
                        <div class="inset-lg-left-15 inset-lg-right-15"></div>
                        <div class="menu-classic menu-classic-single" style="background-image: url({{asset('admin/'.$menu_comida->fondo)}});">
                            <h4 class="title"><a class="link-white" href="menu-single.html"></a></h4>
                            <ul class="list-menu">
                                @if (count($alimento) <= '0')
                                    <li>
                                        <div class="menu-item h6"><span><span>No hay ninguno disponible</span></span>:c</div>
                                        <div class="menu-item-desc"><span>Vuelva mañana!</span></div>
                                    </li>
                                @else
                                    @foreach ($alimento as $item)
                                        <li>
                                            <div class="menu-item h6"><span><span>{{$item->titulo}}</span></span>{{$item->precio}}€</div>
                                            <div class="menu-item-desc"><span>{{$item->descripcion}}</span></div>
                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
