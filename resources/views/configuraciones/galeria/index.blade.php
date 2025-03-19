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
                    Fotos de presentación
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Galería
                  </h1>
                 
                </div>
               
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
                    <div class="col-12">
          
                      <!-- Files -->
                      <div class="card" data-list="{&quot;valueNames&quot;: [&quot;name&quot;]}">
                        <div class="card-header">
          
                          <!-- Title -->
                          <h4 class="card-header-title">
                            Imagenes
                          </h4>
          
                   
                          <!-- Button -->
                          <button data-toggle="modal" data-target="#modalMembers" class="btn btn-sm btn-primary">
                            Nueva imagen
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="modalMembers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <form action="{{route('store.galeria')}}" method="post" enctype="multipart/form-data">
                              @csrf   
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Agregar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="titulo" placeholder="Titulo de la imagen">
                                    </div> 
                                    <div class="form-group">
                                      <textarea name="resena" class="form-control" placeholder="Descripcion de la imagen" style="height:80px"></textarea>
                                    </div>
                                    <input type="file" name="foto" class="files" >
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Subir</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
          
                        </div>

                        <div class="card-body">
                            <div class="row">
                              @foreach ($galeria as $item)
                                <div class="card">
                                  <div class="card-body">
                                    <div class="row align-items-center">
                                      <div class="col-auto">
                    
                                        <!-- Image -->
                                        <a href="project-team-overview.html" class="avatar avatar-lg">
                                          <img src="{{asset('admin/'.$item->foto)}}" alt="..." class="avatar-img rounded">
                                        </a>
                    
                                      </div>
                                      <div class="col ml-n2">
                    
                                        <!-- Heading -->
                                        <h4 class="mb-1">
                                          <a href="team-overview.html">{{$item->titulo}}</a>
                                        </h4>
                    
                                        <!-- Text -->
                                        <p class="small text-muted mb-1">
                                          {{$item->resena}}
                                        </p>
                    
                                      
                    
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            </div>
                        </div>
                      </div>
          
                    </div>
                  </div>     
            </div>

           

        

    
        </div>
      </div> <!-- / .row -->
    </div>

  </div>
  @push('scripts')
      <script>
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