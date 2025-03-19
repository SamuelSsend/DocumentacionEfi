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
                      Editar Combinado
                    </h6>
  
                    <!-- Title -->
                    <h1 class="header-title">
                      Combinado: {{$combinado->nombrecombi}}
                    </h1>
                   
                  </div>
                  
                </div> <!-- / .row -->
              </div>
            </div>
            <div class="col-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2>Sus subproductos son los siguientes:</h2>
                                <ul>
                                @foreach ($combinado->subproductos as $subproducto)
                                    <li>{{ $subproducto->nombre }} - {{ $subproducto->precio }}€
                                    <form action="{{ route('combinados.eliminarSubproducto', ['combinado' => $combinado, 'subproducto' => $subproducto]) }}" method="POST" class="d-inline">
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
            <div class="col-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2>Crear un nuevo subproducto:</h2>
                                <form action="{{ route('combinados.agregarSubproducto', $combinado) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre del subproducto:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio del subproducto:</label>
                                        <input type="text" name="precio" id="precio" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar subproducto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h2>Agregar un subproducto existente:</h2>
                                <form action="{{ route('combinados.relacionarSubproducto', $combinado) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="subproducto_id">Seleccionar subproducto:</label>
                                        <select name="subproducto_id" id="subproducto_id" class="form-control">
                                            <option value="">Seleccione un subproducto</option>
                                            @foreach($subproductosDisponibles as $subproductoDisponible)
                                                <option value="{{ $subproductoDisponible->id }}">{{ $subproductoDisponible->nombre }}</option>
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
            <a href="{{route('index.combinado')}}" class="btn btn-block btn-link">
                <strong> <- ATRÁS</strong>
            </a>
            <br>

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