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
                    Categorías de menú
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Menús disponibles
                  </h1>
                 
                </div>
                <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
                    <a href={{route('create.menu')}} class="btn btn-primary d-block d-md-inline-block lift">
                      Registrar
                    </a>
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
                   @foreach ($combinado as $item)
                        <div class="col-12 col-md-6 col-xl-6">
                
                            <!-- Card -->
                            <div class="card">
                
                            <!-- Dropdown -->
                            <div class="dropdown card-dropdown">
                                <a href="#!" class="dropdown-ellipses dropdown-toggle text-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('edit.menu',$item->id)}}" class="dropdown-item">
                                    <i class="fe fe-edit-3"></i> Editar
                                </a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}" style="cursor:pointer"><i class="fe fe-trash-2"></i> Eliminar</a>
                               
                                </div>
                            </div>
                
                            <!-- Image -->
                            <!--<img src="{/{asset('admin/'.$item->fondo)}}" alt="..." class="card-img-top">-->
                
                            <!-- Body -->
                            <div class="card-body text-center">
                
                                <!-- Image --><!--
                                <a href="{/{route('inicio')}}/menu/{/{$item->titulo}}" class="avatar avatar-xl card-avatar card-avatar-top">
                                <img src="{/{asset('admin/'.$item->preview)}}" class="avatar-img rounded-circle border border-4 border-card" alt="...">
                                </a>-->
                
                                <!-- Heading --><!--
                                <h2 class="card-title">
                                <a href="{/{route('inicio')}}/menu/{/{$item->titulo}}">{/{$item->titulo}}</a>
                                </h2>-->
                
                                <!-- Text --><!--
                                <p class="small text-muted mb-3">
                                    {/{$item->enlace}}
                                </p>-->
                
                
                            </div>
                
                            <!-- Footer -->
                            
                
                            </div>
                
                        </div>
                        @include('configuraciones.modal')
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


         
      </script>
  @endpush
@endsection