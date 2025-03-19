@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">FAQ</p>
            <ul class="breadcrumbs-custom offset-top-10">
                <li><a href="{{route('inicio')}}">Inicio</a></li>
                <li class="active">FAQ</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="text-center text-sm-left section-50 section-sm-top-80 section-sm-bottom-100 bg-gray-lighter">
      <div class="container">
        <h4 class="font-default text-center">Preguntas Frecuentes</h4>
        
        <div class="row justify-content-xs-center">
          <div class="col-md-8">
            <div class="inset-lg-left-45 inset-lg-right-45">
              <!-- Responsive-tabs-->
              <div class="responsive-tabs responsive-tabs-modern" data-type="accordion">
                <ul class="resp-tabs-list">
                    @foreach ($faq as $item)
                    <div>
                      <li>{{$item->pregunta}}</li>
                    </div>
                    @endforeach
                </ul>
                <div class="resp-tabs-container text-left">
                    @foreach ($faq as $item)
                    <div>
                      <p>{{$item->respuesta}}</p>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection