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
                    Editar combinados del producto - {{$producto->titulo}}
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

            <!-- Team name -->
            <div class="col-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2>Los combinados de {{$producto->titulo}} son los siguientes:</h2>
                                <ul>
                                @foreach ($producto->combinados as $combinado)
                                    <li>{{ $combinado->nombrecombi }}
                                    <form action="{{route('eliminar.producto_combinados',['producto' => $producto, 'combinado' => $combinado])}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">

            <div class="col-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2>Agregar un combinado:</h2>
                                <form action="{{route('update.producto_combinados',$producto)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="combinado_id">Seleccionar combinado:</label>
                                        <select name="combinado_id" id="combinado_id" class="form-control">
                                            <option value="">Seleccione un combinado</option>
                                            @foreach($combinados as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombrecombi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Relacionar subproducto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('admin.producto')}}" class="btn btn-block btn-link">
                <strong> <- ATRÁS</strong>
            </a>

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