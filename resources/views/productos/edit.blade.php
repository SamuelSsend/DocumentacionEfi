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
                    Editar producto - {{$producto->titulo}}
                  </h1>

                </div>

              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('update.producto',$producto->id)}}" method="POST" enctype="multipart/form-data">

            @csrf
           @method('PATCH')
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
                          <input type="text" class="form-control form-control-flush" name="titulo" placeholder="Nombre del producto" value="{{$producto->titulo}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <div class="row">
                  <div class="col-lg-6 col-md-12">
                      <div class="card">
                          <div class="card-body">
                                <input type="text" class="form-control form-control-flush" name="precio" placeholder="Precio del producto" value="{{$producto->precio}}">
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                      <div class="card">
                          <div class="card-body">
                              <select  class="custom-select" data-toggle="select" name="categoria">
                                @foreach ($categorias as $item)
                                    @if (trim($item->titulo) == trim($producto->categoria))
                                        <option value="{{$item->titulo}}" selected>{{$item->titulo}}</option>
                                    @else
                                        <option value="{{$item->titulo}}">{{$item->titulo}}</option>
                                    @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
              </div>

            </div>

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <textarea name="descripcion_manual" class="form-control form-control-flush" placeholder="Descripción del producto">{{$producto->descripcion_manual}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <textarea name="descripcion_hosteltactil" class="form-control form-control-flush" placeholder="Descripción HostelTactil" readonly>{{$producto->descripcion_hosteltactil}}</textarea>
                    </div>
                </div>
            </div>


            <div class="form-group">
              <div class="card">
                  <div class="card-body">
                      <div class="form-check" style="display: flex; flex-wrap: wrap;">
                          @foreach ($alergenos as $key => $alergeno)
                              <div style="width: 50%;">
                                  <input class="form-check-input" type="checkbox" value="{{$alergeno->id}}" id="alergeno{{$alergeno->id}}" name="alergenos[]"
                                  @if(count($checkAlergenos)>0  && in_array($alergeno->id, $checkAlergenos))
                                      checked=checked
                                  @endif>
                                  <label class="form-check-label" for="alergeno{{$alergeno->id}}">
                                      {{$alergeno->nombre}}
                                  </label>
                                  <img src="data:image/png;base64,{{ base64_encode($alergeno->imagen) }}" alt="{{$alergeno->nombre}}">
                              </div>
                              @if ($key % 2 == 1)
                                  <br>
                              @endif
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>

            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                      <input type="file" name="portada" class="files">
                    </div>
                </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">





            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
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
