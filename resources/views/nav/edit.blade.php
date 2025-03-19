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
                    Formulario
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Registrar menú
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('update.nav',$nav->id)}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
           
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


            <div class="form-group">
             
                <div class="card mb-4">
                    <div class="card-body">
    
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label for="exampleInputEmail1">Seleccionar enlace</label>
                            <div class="input-group input-group-merge">
                              <input type="text" id="enlace_input" class="form-control form-control-prepended" placeholder="Nuevo enlace en el menú" name="enlace" value="{{$nav->enlace}}">
                              <div class="input-group-prepend">
                                <div class="input-group-text" style="padding-right: 0px;padding:0px !important">
                                  <button class="btn btn-primary" style="border-bottom-width: 0px;" type="button" data-toggle="modal" data-target="#links_modal"><span class="fe fe-link"></span></button>
                                </div>
                              </div>

                              @if ($errors->has('enlace'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('enlace') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleInputEmail1">Título</label>
                          <input type="text" class="form-control" id="" placeholder="Titulo del menú" name="titulo" value="{{$nav->titulo}}">
                          @if ($errors->has('titulo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('titulo') }}
                                </div>
                                @endif
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleInputEmail1">Seleccionar icono</label>
                          <div class="input-group input-group-merge">
                            <input type="text" class="form-control form-control-prepended" placeholder="Icono" id="icono_input" name="icono" value="{{$nav->icono}}">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="padding-right: 0px;padding:0px !important">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#iconos-modal" style="border-bottom-width: 0px;"><span class="fe fe-link"></span></button>
                              </div>
                            </div>
                            @if ($errors->has('icono'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('icono') }}
                                </div>
                                @endif
                          </div>

                        </div>


                        {{-- MODAL DE ICONOS --}}
                       @include('nav.icon')
                       @include('nav.links')
                       
                      </div>

                    </div>
                </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
            <a href="{{route('index.nav')}}" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div> 

  @push('scripts')
    <script>
        
        $(document).ready(function(){


            $('.btn-icono').on('click', function(event) {
                let classenlace = $(this).parent().children()[0].className;
                let data_class = classenlace.split(" ");
                
                $("#icono_input").val(data_class[1]);
                $('#iconos-modal').modal('toggle');
            });

            $('.btn-enlaces').on('click', function(event) {
                let classenlace = $(this).parent().parent().children()[1].innerText;

                $("#enlace_input").val(classenlace);
                $('#links_modal').modal('toggle');
            });
        });

    </script>
@endpush
@endsection