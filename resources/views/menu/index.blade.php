@extends('layouts.user')

@section('user')

<section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-xs-12 col-xl-preffix-1 col-xl-11">
				<p class="h3 text-white">Menú</p>
				<p class="h4 text-white">The Beast Burger La Línea</p> 
			</div>
		</div>
	</div>
</section>
@if(Session::has('warning'))
        <div class="alert alert-warning" role="alert">
            <h4>{{ Session::get('warning') }}</h4>
        </div>
@endif
<section class="section-50 section-sm-top-80 section-sm-bottom-150">
	<div class="container">
		<div class="row section-bottom-80">
			<div class="col-md-12">
				<h3 style="color: #000; margin-bottom: 20px;">Realice su pedido online</h3>
				<p style="font-size: 18px; color: #9C9C9C; max-width: 900px; margin: 0 auto;">
					Explora nuestras categorías y realiza tu pedido online para disfrutar de tus comidas favoritas desde la comodidad de tu hogar.
				</p>
			</div>
		</div>
		<div class="row">
			@foreach ($menu_comida as $item)

				@if (strlen($item->titulo) >= '9')
					<a href="{{route('cliente.menu.show',strtolower($item->titulo))}}" class="col-md-4" style="margin-bottom: 50px;">
						<img style="width: 100%; height: 280px; object-fit: contain; margin-bottom: 16px;" src="{{asset('admin/'.$item->preview)}}" alt="{{$item->titulo}}"  onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
						<h3 style="font-size: 32px; font-weight: 700; color: #000;">{{$item->titulo}}</h3>
					</a>
				@else
					<a href="{{route('cliente.menu.show',strtolower($item->titulo))}}" class="col-md-4" style="margin-bottom: 50px;">
						<img style="width: 100%; height: 280px; object-fit: contain; margin-bottom: 16px;" src="{{asset('admin/'.$item->preview)}}" alt="{{$item->titulo}}"  onerror="this.onerror=null; this.src='{{asset('img/sin-imagen.jpg')}}'">
						<h3 style="font-size: 32px; font-weight: 700; color: #000;">{{$item->titulo}}</h3>
					</a>
				@endif

			@endforeach
		</div>

        @if($general->carta)
        <div class="row">
            <a href="{{asset('admin/'.$general->carta)}}" class="boton-descargar-menu">
                <svg width="33" height="24" viewBox="0 0 33 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.2243 17.9439C9.39564 17.9439 10.5361 18.075 11.6456 18.3372C12.7551 18.5994 13.8577 18.9916 14.9533 19.514V4.78505C13.9315 4.18692 12.8474 3.73832 11.7009 3.43925C10.5545 3.14019 9.39564 2.99065 8.2243 2.99065C7.3271 2.99065 6.43589 3.07788 5.55065 3.25234C4.66542 3.42679 3.81209 3.68847 2.99065 4.03738V18.8411C3.86293 18.5421 4.72922 18.3178 5.58953 18.1682C6.44984 18.0187 7.3281 17.9439 8.2243 17.9439ZM17.9439 19.514C19.0405 18.9907 20.1431 18.5979 21.2516 18.3357C22.3601 18.0735 23.5006 17.9429 24.6729 17.9439C25.5701 17.9439 26.4488 18.0187 27.3092 18.1682C28.1695 18.3178 29.0353 18.5421 29.9065 18.8411V4.03738C29.0841 3.68847 28.2303 3.42679 27.345 3.25234C26.4598 3.07788 25.5691 2.99065 24.6729 2.99065C23.5016 2.99065 22.3427 3.14019 21.1963 3.43925C20.0498 3.73832 18.9657 4.18692 17.9439 4.78505V19.514ZM16.4486 23.9252C15.2523 22.9782 13.9564 22.243 12.5607 21.7196C11.1651 21.1963 9.71963 20.9346 8.2243 20.9346C6.90343 20.9346 5.52025 21.1838 4.07477 21.6822C2.62928 22.1807 1.27103 22.9533 0 24V2.31776C1.09657 1.57009 2.38654 0.996885 3.86991 0.598131C5.35327 0.199377 6.80474 0 8.2243 0C9.66978 0 11.0844 0.186916 12.468 0.560748C13.8517 0.934579 15.1786 1.49533 16.4486 2.24299C17.7196 1.49533 19.047 0.934579 20.4307 0.560748C21.8143 0.186916 23.2284 0 24.6729 0C26.0935 0 27.5454 0.199377 29.0288 0.598131C30.5121 0.996885 31.8016 1.57009 32.8972 2.31776V24C31.6511 22.9533 30.2988 22.1807 28.8404 21.6822C27.3819 21.1838 25.9928 20.9346 24.6729 20.9346C23.1776 20.9346 21.7321 21.1963 20.3364 21.7196C18.9408 22.243 17.6449 22.9782 16.4486 23.9252ZM19.4393 8.82243V6.28037C20.2617 5.93146 21.1031 5.66978 21.9634 5.49533C22.8237 5.32087 23.7269 5.23364 24.6729 5.23364C25.3209 5.23364 25.9564 5.28349 26.5794 5.38318C27.2025 5.48287 27.8131 5.60748 28.4112 5.75701V8.14953C27.8131 7.92523 27.2085 7.75676 26.5974 7.64411C25.9863 7.53147 25.3448 7.47564 24.6729 7.47664C23.7259 7.47664 22.8162 7.59526 21.9439 7.83252C21.0717 8.06978 20.2368 8.39975 19.4393 8.82243ZM19.4393 17.0467V14.5047C20.2617 14.1558 21.1031 13.8941 21.9634 13.7196C22.8237 13.5452 23.7269 13.4579 24.6729 13.4579C25.3209 13.4579 25.9564 13.5078 26.5794 13.6075C27.2025 13.7072 27.8131 13.8318 28.4112 13.9813V16.3738C27.8131 16.1495 27.2085 15.9811 26.5974 15.8684C25.9863 15.7558 25.3448 15.6999 24.6729 15.7009C23.7259 15.7009 22.8162 15.8131 21.9439 16.0374C21.0717 16.2617 20.2368 16.5981 19.4393 17.0467ZM19.4393 12.9346V10.3925C20.2617 10.0436 21.1031 9.78193 21.9634 9.60748C22.8237 9.43302 23.7269 9.34579 24.6729 9.34579C25.3209 9.34579 25.9564 9.39564 26.5794 9.49533C27.2025 9.59502 27.8131 9.71963 28.4112 9.86916V12.2617C27.8131 12.0374 27.2085 11.8689 26.5974 11.7563C25.9863 11.6436 25.3448 11.5878 24.6729 11.5888C23.7259 11.5888 22.8162 11.7074 21.9439 11.9447C21.0717 12.1819 20.2368 12.5119 19.4393 12.9346Z" fill="#CC0000"/>
                </svg>
                <span>DESCARGAR MENÚ</span>
            </a>
        </div>
        @endif

	</div>
</section>

@endsection
