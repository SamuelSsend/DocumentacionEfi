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
                    Registrar Entrada
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('store.slider')}}" method="POST" enctype="multipart/form-data">
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
    
       
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer01">Titulo uno</label>
                            <input type="text" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" placeholder="HOTT STUFF" required="" name="titulo" value="{{old('titulo')}}">
                            @if ($errors->has('titulo'))
                              <div class="invalid-feedback">
                                {{ $errors->first('titulo') }}
                              </div>
                            @endif
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer02">Titulo dos</label>
                            <input type="text" class="form-control {{ $errors->has('subtitulo') ? ' is-invalid' : '' }}" placeholder="Mexican" required="" name="subtitulo" value="{{old('subtitulo')}}">
                            @if ($errors->has('subtitulo'))
                              <div class="invalid-feedback">
                                {{ $errors->first('subtitulo') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer03">Titulo tres</label>
                            <input type="text" class="form-control {{ $errors->has('estado') ? ' is-invalid' : '' }}" placeholder="Burger" required="" name="estado"  value="{{old('estado')}}">
                            @if ($errors->has('estado'))
                              <div class="invalid-feedback">
                                {{ $errors->first('estado') }}
                              </div>
                            @endif
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer04">Portada</label>
                            <input type="file" id="imgInp" class="form-control {{ $errors->has('portada') ? ' is-invalid' : '' }}" placeholder="Nombre del producto" required="" name="portada" >
                            @if ($errors->has('portada'))
                              <div class="invalid-feedback">
                                {{ $errors->first('portada') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        
                        <img src="{{asset('img/slider.png')}}" id="blah" style="width:100%" class="mt-4">

                    </div>
                </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
            <a href="https://backoffice.efiposdelivery.com/panel/configuraciones/slider" class="btn btn-block btn-link text-muted">
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