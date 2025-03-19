@extends('layouts.admin')
@section('contenido')
<div class="main-content">


    @include('navbar')



    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">



          <!-- Header -->
          <div class="header mt-md-5">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Pretitle -->
                  <h6 class="header-pretitle">
                    Subproductos registrados en el sistema.
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Subproductos
                  </h1>

                </div>
{{--                <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">--}}
{{--                    <a href={{route('registrar.subproducto')}} class="btn btn-primary d-block d-md-inline-block lift">--}}
{{--                      Registrar--}}
{{--                    </a>--}}
{{--                </div>--}}
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->

            <div class="form-group">
              @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>
            <div class="form-group">
              @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{Session::get('danger')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>

            <!-- Team name -->
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-12 mb-4">
                    {!! Form::open(array('url'=>'panel/data/subproductos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                    <div class="input-group input-group-merge">

                      <input type="search" name="search" value="{{$search}}" class="form-control form-control-prepended" placeholder="Buscar subproducto por nombre">
                      <div class="input-group-prepend">
                          <button class="btn btn-primary"><span class="fe fe-search"></span></button>
                      </div>

                    </div>
                    {{Form::close()}}
                  </div>

                    @foreach ($subproductos as $item)
                        <div class="col-12 col-xl-12">
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col-auto">

                                  <!-- Avatar -->

                                  <a  class="avatar avatar-lg">
                                    <img src="{{asset('admin_subproductos/'.$item->img_path)}}" alt="..." class="avatar-img rounded-circle">
                                  </a>

                                </div>
                                <div class="col ml-n2">

                                  <!-- Title -->
                                  <h4 class="mb-1">
                                    <a>{{$item->nombre}}</a>
                                  </h4>

                                  <!-- Text -->

								  <!-- Precio -->
                                  <p class="card-text small text-muted mb-1">
                                    {{$item->precio}} €
                                  </p>

                                  <!-- Id -->
                                  <p class="card-text small text-muted mb-1">ID:
                                    {{$item->id}}
                                  </p>

                                  <!-- Status -->
                                  <p class="card-text small">
                                    @if ($item->estado == 'Disponible')
                                      <span class="text-success">●</span> {{$item->estado}}
                                    @else
                                    <span class="text-danger">●</span> {{$item->estado}}
                                    @endif
                                  </p>

                                </div>
{{--                                <div class="col-auto">--}}
{{--                                  @if ($item->estado == 'Disponible')--}}
{{--                                    <a data-toggle="modal" data-target="#estado-{{$item->id}}" class="btn btn-sm btn-danger d-none d-md-inline-block" style="color: white !important">--}}
{{--                                      Desactivar--}}
{{--                                    </a>--}}
{{--                                  @else--}}
{{--                                    <a data-toggle="modal" data-target="#estado-{{$item->id}}" class="btn btn-sm btn-success d-none d-md-inline-block" style="color: white !important">--}}
{{--                                      Activar--}}
{{--                                    </a>--}}
{{--                                  @endif--}}
{{--                                  <!-- Button -->--}}
{{--                                </div>--}}
                                <div class="col-auto">

                                  <!-- Dropdown -->

                                  <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" data-expanded="false" aria-expanded="false">
                                      <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                      <a href="{{route('edit.subproducto',$item->id)}}" class="dropdown-item" style="cursor:pointer">
                                        <i class="fe fe-edit"></i> Editar subproducto
                                      </a>
                                      <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}" style="cursor:pointer">
                                        <i class="fe fe-trash-2"></i> Eliminar
                                      </a>
                                    </div>
                                  </div>


                                </div>
                              </div> <!-- / .row -->
                            </div> <!-- / .card-body -->
                          </div>
                      </div>
                      @include('subproductos.modal')
                      @include('subproductos.estado')
                      @include('subproductos.oferta')
                    @endforeach

                    <div class="col-lg-12 mt-4">
                      {{$subproductos->render()}}
                    </div>
                </div>
            </div>






        </div>
      </div> <!-- / .row -->
    </div>

  </div>
  @push('scripts')
      <script>

$('.dz-button').text('Subir logo');

        $('.color-picker').spectrum({
          type: "text"
        });

          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp").change(function() {
            readURL(this);
          });



      </script>
  @endpush
@endsection
