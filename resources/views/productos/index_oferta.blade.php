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
                    Alimentos registrados en el sistema.
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Productos en ofertas
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
                 

                    @foreach ($productos as $item)
                        <div class="col-12 col-xl-12">
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col-auto">
              
                                  <!-- Avatar -->
                                  <a href="profile-posts.html" class="avatar avatar-lg">
                                    @if ($item->portada_oferta == '')
                                      <img src="{{asset('admin/'.$item->portada)}}" alt="..." class="avatar-img rounded-circle">
                                    @else
                                      <img src="{{asset('admin/'.$item->portada_oferta)}}" alt="..." class="avatar-img rounded-circle">
                                    @endif
                                  </a>
              
                                </div>
                                <div class="col ml-n2">
              
                                  <!-- Title -->
                                  <h4 class="mb-1">
                                    <a href="profile-posts.html">{{$item->titulo}}</a>
                                  </h4>
              
                                  <!-- Text -->
                                  <p class="card-text small text-muted mb-1">
                                    {{$item->descripcion}}
                                  </p>
              
                                  <!-- Status -->
                                  <p class="card-text small">
                                    {{$item->precio}}
                                  </p>
              
                                </div>
                                <div class="col-auto">
                                    <a data-toggle="modal" data-target="#oferta-{{$item->id}}" class="btn btn-sm btn-danger d-none d-md-inline-block" style="color: white !important">
                                      Quitar
                                    </a>
                                </div>
                                <div class="col-auto">
              
                                    <a data-toggle="modal" data-target="#portada-{{$item->id}}" class="btn btn-sm btn-success d-none d-md-inline-block" style="color: white !important">
                                        Poster personalizado
                                      </a>
                                </div>
                              </div> <!-- / .row -->
                            </div> <!-- / .card-body -->
                          </div>
                      </div>
                      @include('productos.modal')
                      @include('productos.estado')
                      @include('productos.oferta')
                      @include('productos.portada_oferta')
                    @endforeach

                   
                </div>             
            </div>

           

        

    
        </div>
      </div> <!-- / .row -->
    </div>

  </div>
  @push('scripts')
      <script>

$('.dz-button').text('Subir logo');

        $('.color-picker').spectrum({
          type: "text"
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

          $(document).ready(function() {
              $('input.files').fileuploader({
                  // Options will go here
              });
          });
         
      </script>
  @endpush
@endsection