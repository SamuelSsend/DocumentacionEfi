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
                    Registrar producto
                  </h1>

                </div>

              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('store.producto')}}" method="POST" enctype="multipart/form-data">
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

            <!-- Team name -->
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                          <input type="text" class="form-control form-control-flush" name="titulo" placeholder="Nombre del producto" value="{{old('titulo')}}">
                          @if ($errors->has('titulo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('titulo') }}
                                </div>
                                @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
              <div class="row">
                  <div class="col-lg-6 col-md-12">
                      <div class="card">
                          <div class="card-body">
                                <input type="text" class="form-control form-control-flush" name="precio" placeholder="Precio del producto" value="{{old('precio')}}">
                                @if ($errors->has('precio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('precio') }}
                                </div>
                                @endif
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                      <div class="card">
                          <div class="card-body">
                              <select class="custom-select" data-toggle="select" name="categoria">
                                @foreach ($categorias as $item)
                                  <option value="{{$item->titulo}}">{{$item->titulo}}</option>
                                @endforeach


                              </select>
                              @if ($errors->has('categoria'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('categoria') }}
                                </div>
                                @endif
                          </div>
                      </div>
                  </div>
              </div>

            </div>

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <textarea name="descripcion_manual" class="form-control form-control-flush" placeholder="Descripción del producto">{{old('descripcion_manual')}}</textarea>
                        @if ($errors->has('descripcion_manual'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion_manual') }}
                                </div>
                                @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                      <input type="file" name="portada" class="files" >
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="card">
                  <div class="card-body">

                    <select name="combinados[]" id="combinados" multiple required>
                      @foreach($combinados as $combinado)
                        <option value="{{$combinado->id}}">{{$combinado->nombrecombi}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>

            <!-- Divider -->
            <hr class="mt-4 mb-5">





            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
            <a href="{{route('admin.producto')}}" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div>

  @push('scripts')
      <script>



$('.dz-button').text('Subir portada');

          $(document).ready(function() {
              $('input.files').fileuploader({
                  // Options will go here
              });
          });

      </script>
  @endpush
@endsection
