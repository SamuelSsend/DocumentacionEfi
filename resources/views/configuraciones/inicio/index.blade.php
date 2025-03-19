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
                    Configuración
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Página de inicio
                  </h1>

                </div>
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('admin.inicio.store')}}" method="POST" enctype="multipart/form-data">
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
                <h2 class="mb-2">
                    Banner principal
                </h2>
                <p class="text-muted mb-4">
                    Configuración para el banner principal, página de inicio.
                </p>
                <div class="card mb-4">
                    <div class="card-body">
    
       
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer01">Título de la cabecera</label>
                            <input type="text" class="form-control {{ $errors->has('titulo_cabecera') ? ' is-invalid' : '' }}" placeholder="Título superior" required="" name="titulo_cabecera" value="{{$inicio->titulo_cabecera}}">
                            @if ($errors->has('titulo_cabecera'))
                              <div class="invalid-feedback">
                                {{ $errors->first('titulo_cabecera') }}
                              </div>
                            @endif
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer02">Título principal</label>
                            <input type="text" class="form-control {{ $errors->has('titulo_principal') ? ' is-invalid' : '' }}" placeholder="Título principal" required="" name="titulo_principal" value="{{$inicio->titulo_principal}}">
                            @if ($errors->has('titulo_principal'))
                              <div class="invalid-feedback">
                                {{ $errors->first('titulo_principal') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer03">Precio</label>
                            <input type="text" class="form-control {{ $errors->has('precio') ? ' is-invalid' : '' }}" placeholder="3$" required="" name="precio" value="{{$inicio->precio}}">
                            @if ($errors->has('precio'))
                              <div class="invalid-feedback">
                                {{ $errors->first('precio') }}
                              </div>
                            @endif
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer04">Nombre del producto</label>
                            <input type="text" class="form-control {{ $errors->has('precio') ? ' is-invalid' : '' }}" placeholder="Nombre del producto" required="" name="titulo_producto" value="{{$inicio->titulo_producto}}">
                            @if ($errors->has('precio'))
                              <div class="invalid-feedback">
                                {{ $errors->first('precio') }}
                              </div>
                            @endif
                          </div>
                        </div>
                        
                        <img src="{{asset('img/banner_inicio.png')}}" style="width:100%" class="mt-4">

                    </div>
                </div>

                <h2 class="mb-2">
                    Galería
                </h2>
                <p class="text-muted mb-4">
                    Configuración para la galería de 4 imagenes.
                </p>

                <div class="card mb-4">
                    <div class="card-body">
    
       
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer01">Primera imagen</label>
                            <input type="file" class="form-control" name="foot_img_uno" id="imgInp">
                           
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer02">Segunda imagen</label>
                            <input type="file" class="form-control" name="foot_img_dos" id="imgInp2">
                          
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer03">Tercera imagen</label>
                            <input type="file" class="form-control" name="foot_img_tres" id="imgInp3">
                            
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <label for="validationServer04">Cuarta imagen</label>
                            <input type="file" class="form-control" name="foot_img_cuatro" id="imgInp4">
                            
                          </div>
                        </div>
                      

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">


                           
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <a href="project-overview.html">
                                      <img id="blah" src="{{asset('admin/'.$inicio->foot_img_uno)}}" alt="..." class="card-img-top">
                                    </a>
                
                                    <!-- Body -->
                                    <div class="card-body">
                                      <div class="row align-items-center">
                                        <div class="col">
                                           Primera imagen
                                        </div>
                                      </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <a href="project-overview.html">
                                      <img id="blah2" src="{{asset('admin/'.$inicio->foot_img_dos)}}" alt="..." class="card-img-top">
                                    </a>
                
                                    <!-- Body -->
                                    <div class="card-body">
                                      <div class="row align-items-center">
                                        <div class="col">
                                            Segunda imagen
                                        </div>
                                      </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <a href="project-overview.html">
                                      <img id="blah3" src="{{asset('admin/'.$inicio->foot_img_tres)}}" alt="..." class="card-img-top">
                                    </a>
                
                                    <!-- Body -->
                                    <div class="card-body">
                                      <div class="row align-items-center">
                                        <div class="col">
                                            Tercera imagen
                                        </div>
                                      </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <a href="project-overview.html">
                                      <img id="blah4" src="{{asset('admin/'.$inicio->foot_img_cuatro)}}" alt="..." class="card-img-top">
                                    </a>
                
                                    <!-- Body -->
                                    <div class="card-body">
                                      <div class="row align-items-center">
                                        <div class="col">
                                           Cuarta imagen
                                        </div>
                                      </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Guardar cambios</button>
            <a href="#" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div>
  @push('scripts')
      <script>
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


          function readURL2(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp2").change(function() {
            readURL2(this);
          });

          function readURL3(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#blah3').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp3").change(function() {
            readURL3(this);
          });

          function readURL4(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function(e) {
                $('#blah4').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp4").change(function() {
            readURL4(this);
          });
      </script>
  @endpush
@endsection