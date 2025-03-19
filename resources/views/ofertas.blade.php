@extends('layouts.user')
@section('user')

<main class="page-content">


    <section class="text-center text-sm-left section-50 section-sm-top-100 section-sm-bottom-100 bg-image-1">
      <div class="container">
        


        <div class="row justify-content-xs-center offset-top-30">

          @foreach ($oferta as $key => $item)
           
                <div class="col-sm-6 col-md-4 mb-4"><a class="deals-block deals-block-small" href="#"><img class="img-responsive" src="
                    <?php 
                    if ($item->portada_oferta == '') {
                        echo asset('admin/'.$item->portada);
                    }else{
                        echo asset('admin/'.$item->portada_oferta);
                    }

                    ?>
            " alt="" width="369" height="294">
                    <div class="caption">
                    <div class="title-wrap">
                        <h4 class="text-italic">{{$item->titulo}}</h4>
                        <p>{{$item->descripcion}}</p>
                    </div>
                    <div class="price-block"><span>$</span><span>27</span><span>99</span></div>
                    </div></a>
                </div>
          
          @endforeach
          
        </div>
      </div>
    </section>
  </main>

@endsection