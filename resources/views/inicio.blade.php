@extends('layouts.user')
@section('user')
    <main class="page-content">
        <!-- Swiper variant 3-->
        <section class="bg-gray-darker">
            <div class="swiper-variant-1">
                <div class="swiper-container swiper-slider swiper-container-horizontal swiper-container-fade"
                     data-slide-effect="fade" data-min-height="600px">
                    <div class="swiper-wrapper" style="transition-duration: 600ms;">


                        @foreach ($slider as $item)
                            <div class="swiper-slide" data-slide-bg="{{asset('admin/'.$item->portada)}}" data-swiper-slide-index="1">
                                <div class="swiper-slide-caption slide-caption-2 text-center">
                                    <div class="container">
                                        <div class="row align-items-sm-center">
                                            <div class="col-12">
                                                <h5 class="text-italic font-secondary text-white not-animated"
                                                    data-caption-animate="fadeInUpSmall"
                                                    data-caption-delay="100">{{$item->titulo}}</h5>
                                                <h2 class="text-uppercase text-white offset-top-0 not-animated"
                                                    data-caption-animate="fadeInUpSmall"
                                                    data-caption-delay="400">{{$item->subtitulo}}</h2>

                                                <h4 class="text-primary-lighter offset-top-10 not-animated"
                                                    data-caption-animate="fadeInUpSmall"
                                                    data-caption-delay="1000">{{$item->estado}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- Swiper Navigation-->
                        <div class="swiper-pagination-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="swiper-pagination swiper-pagination-clickable">
											<span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
											<span class="swiper-pagination-bullet"></span>
											<span class="swiper-pagination-bullet"></span>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="section-50 section-sm-100" style="background: {{$config->color_fondo_menu}} !important">
            <div class="container-wide">
                <div class="row justify-content-xs-center">

                    @foreach ($seccion_uno as $item)
                        @if ($item->estado == '1')
                            <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active">
                                <a class="thumbnail-variant-3" href="menu-single.html">
                                    <img class="img-responsive" src="{{asset('admin/'.$item->portada)}}" alt=""
                                         width="566" height="401">
                                    <div class="caption text-center">
                                        <h3 class="text-italic">{{$item->titulo}}</h3>
                                        <p class="big">{{$item->subtitulo}}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </section>
        <section class="section-50 section-sm-top-80 section-sm-bottom-150 bg-gray-lighter">
			<div class="container">
				<div class="row section-bottom-34 section-sm-bottom-80">
					<div class="col-md-12">
						<h3 style="color: #000">Realice su pedido online</h3>
					</div>
				</div>
				<div class="row">
					@foreach ($menu_comida as $item)
					<a href="{{route('cliente.menu.show',strtolower($item->titulo))}}" class="col-md-4" style="margin-bottom: 50px;">
						<img style="width: 100%; height: 280px; object-fit: contain; margin-bottom: 16px;" src="{{asset('admin/'.$item->preview)}}" alt="{{$item->titulo}}"  onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
						<h3 style="font-size: 32px; font-weight: 700; color: #000;">{{$item->titulo}}</h3>
					</a>
					@endforeach
				</div>
			</div>
        </section>
        <!--banner-->
		 <!--
        <section class="bg-image-5">
            <section class="parallax-container parallax-light" data-parallax-img="{{asset('images/parallax-03.png')}}">
                <div class="material-parallax parallax"><img src="{{asset('images/parallax-03.png')}}" alt="" style="display: block;"></div>
                <div class="parallax-content">
                    <div class="container section-80 section-sm-top-140 section-sm-bottom-150 text-center">
                        <div class="row justify-content-xs-center">
                            <div class="col-sm-10 col-lg-6">
                                <h4 class="text-italic divider-custom-small-primary">{{$inicio->titulo_cabecera}}</h4>
                                <h2 class="text-uppercase text-italic offset-top-10 offset-sm-top-0">{{$inicio->titulo_principal}}</h2>
                                <div class="label-price offset-top-10">
                                    <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                                        <div class="unit-left">
                                            <h1 class="text-accent">{{$inicio->precio}}</h1>
                                        </div>
                                        <div class="unit-body">
                                            <ul class="big text-left">
                                                <li>{{$inicio->titulo_producto}}</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
		-->
        <!--services-->
        <section class="section-50 section-sm-130" style="background: {{$config->color_fondo_menu}} !important">
            <div class="container">
                <div class="row justify-content-xs-center">
                    @foreach ($seccion_tres as $item)
                        @if ($item->estado == '1')
                            <div class="col-sm-6 col-md-3 view-animate fadeInUpBigger delay-04">
                                <!-- Box icon-->
                                <article class="box-icon box-icon-variant-1">
                                    <div class="icon-wrap">
                                        <span class="icon icon-lg text-base {{$item->icono}} icon-xl"
                                              style="color: {{$config->color_texto_menu}} !important"></span>
                                    </div>
                                    <div class="box-icon-header">
                                        <h5 style="color: {{$config->color_texto_menu}} !important">{{$item->titulo}}</h5>
                                    </div>
                                    <hr class="divider-xs bg-accent">
                                    <p style="color: {{$config->color_texto_menu}} !important">{{$item->descripcion}}</p>
                                </article>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </section>
        <!--section gallery-->
        <section>
            <div class="row no-gutters" data-lightgallery="group">
                @foreach ($galeria as $item)
                    <div class="col-xs-6 col-md-3">
                        <a class="thumbnail-gallery" data-lightgallery="item" href="{{asset('admin/'.$item->foto)}}">
                            <img src="{{asset('admin/'.$item->foto)}}" alt="" width="480" height="394"></a>
                    </div>
                @endforeach

            </div>
        </section>
        <section>
            <!--Please, add the data attribute data-key="YOUR_API_KEY" in order to insert your own API key for the Google map.-->
            <!--Please note that YOUR_API_KEY should replaced with your key.-->
            <!--Example: <div class="google-map-container" data-key="YOUR_API_KEY">-->
            {!!$config->iframe!!}
        </section>
    </main>
@endsection
