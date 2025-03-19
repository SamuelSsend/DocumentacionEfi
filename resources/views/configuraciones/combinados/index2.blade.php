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
                    Combinados registrados en el sistema.
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Combinados
                  </h1>

                </div>
{{--                <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">--}}
{{--                    <a href="{{route('create.combinado')}}" class="btn btn-primary d-block d-md-inline-block lift">--}}
{{--                      Registrar--}}
{{--                    </a>--}}
{{--                </div>--}}
              </div> <!-- / .row -->
            </div>
          </div>
          <div class="form-group">
            <div class="row">
            <div class="col-lg-12 mb-4">
              {!! Form::open(array('url'=>'panel/configuraciones/combinado','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
              <div class="input-group input-group-merge">

                <input type="search" name="search" value="{{$search}}" class="form-control form-control-prepended" placeholder="Buscar combinado por nombre">
                <div class="input-group-prepend">
                    <button class="btn btn-primary"><span class="fe fe-search"></span></button>
                </div>

              </div>
              {{Form::close()}}
            </div>
                @foreach ($combinado as $item)
                    <div class="col-12 col-xl-12">
                      <div class="card mb-3">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-auto">

                              <!-- Avatar -->

                              <a  class="avatar avatar-lg">
                                <img src="" alt="..." class="avatar-img rounded-circle">
                              </a>

                            </div>
                            <div class="col ml-n2">

                              <!-- Title -->
                              <h2 class="mb-1">
{{--                                <a href="{{route('combinados.edit',$item->id)}}">--}}
                                    {{$item->nombrecombi}}
{{--                                </a>--}}
                              </h2>

                              <!-- Text -->

              <!-- Precio -->

                              <!-- Id -->
                              <p class="card-text small text-muted mb-1">ID:
                                {{$item->id}}
                              </p>
                              @if($item->subproductos->count() > 0)
                                <h3>Subproductos:</h3>
                                <ul>
                                  @foreach($item->subproductos as $subproducto)
                                    <li>{{$subproducto->nombre}}</li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>

                              <div class="col-auto">

                                <!-- Dropdown -->
                            <div class="dropdown">
                              <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" data-expanded="false" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('combinados.edit', $item->id) }}" class="dropdown-item" style="cursor:pointer">
                                  <i class="fe fe-edit"></i> Editar combinado
                                </a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{ $item->id }}" style="cursor:pointer">
                                  <i class="fe fe-trash-2"></i> Eliminar
                                </a>
                              </div>
                            </div>


                              </div>
                            </div>

                          </div> <!-- / .row -->
                        </div> <!-- / .card-body -->
                    </div>
                    </a>
                  @include('configuraciones.combinados.modal')
                  @include('subproductos.estado')
                  @include('subproductos.oferta')
                @endforeach
        </div>
    </div>
@endsection
