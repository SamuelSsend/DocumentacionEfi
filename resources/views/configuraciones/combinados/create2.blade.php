@extends('layouts.admin')
@section('estilos')
<style>
  .boton-generar {
      display: block;
  }
</style>
@endsection
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
                    Registrar nuevo combinado
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('store.combinado')}}" method="POST" enctype="multipart/form-data">
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
                          <input type="text" class="form-control form-control-flush" name="nombrecombi" placeholder="Nombre del combinado" value="{{old('titulo')}}">
                          @if ($errors->has('titulo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('titulo') }}
                            </div>
                            @endif
                    </div>
                </div>          
            </div>
        


        
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
            <a href="{{route('index.combinado')}}" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

            <!-- Divider -->
            <hr class="mt-4 mb-5">
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
      <script>
       var botonAgregar = document.getElementById('toggle-botones');
    var botonesContainer = document.getElementById('botones-subproducto-container');
    var importarSubproductoContainer = document.getElementById('importar-subproducto-container');

    botonAgregar.addEventListener('click', function () {
        if (botonesContainer.style.display === 'none') {
            botonesContainer.style.display = 'block';
        } else {
            botonesContainer.style.display = 'none';
        }
    });

    document.getElementById('agregar-subproducto').addEventListener('click', function () {
        var subproductosContainer = document.getElementById('subproductos-container');
        var subproductoDiv = document.createElement('div');
        subproductoDiv.classList.add('subproducto');
        subproductoDiv.innerHTML = `
            <label for="subproducto_nombre">Nombre:</label>
            <input type="text" name="subproducto_nombre[]" class="subproducto_nombre">
            <label for="subproducto_precio">Precio:</label>
            <input type="text" name="subproducto_precio[]" class="subproducto_precio">
        `;
        subproductosContainer.appendChild(subproductoDiv);
        botonesContainer.style.display = 'none'; // Oculta los botones después de agregar un subproducto
    });

    document.getElementById('importar-subproducto').addEventListener('click', function () {
        botonesContainer.style.display = 'none'; // Oculta los botones al hacer clic en "Importar subproducto"
        importarSubproductoContainer.style.display = 'block'; // Muestra el contenedor de importación de subproducto
    });

    document.getElementById('importar').addEventListener('click', function () {
        var select = document.getElementById('subproducto_seleccionado');
        var subproductoId = select.value;
        var subproductoNombre = select.options[select.selectedIndex].text;
        
        if (subproductoId) {
            var subproductosContainer = document.getElementById('subproductos-container');
            var subproductoDiv = document.createElement('div');
            subproductoDiv.classList.add('subproducto');
            subproductoDiv.innerHTML = `
                <input type="hidden" name="subproducto_id[]" value="${subproductoId}">
                <label>Nombre: ${subproductoNombre}</label>
            `;
            subproductosContainer.appendChild(subproductoDiv);
        }

        importarSubproductoContainer.style.display = 'none'; // Oculta el contenedor de importación de subproducto después de importar
        botonesContainer.style.display = 'block'; // Muestra nuevamente los botones
    });
      </script>
  @endpush
@endsection