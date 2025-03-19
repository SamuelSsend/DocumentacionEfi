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
                    Página de inicio
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Slider
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
                            Entradas
                          </h4>
          

                          </button>
                          <a href="{{route('create.slider')}}" class="btn btn-sm btn-primary">Nueva entrada</a>
          
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @foreach ($slider as $item)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card">

                                            <!-- Image -->
                                            <a href="{{route('edit.slider',$item->id)}}">
                                              <img src="{{asset('admin/'.$item->portada)}}" alt="..." class="card-img-top">
                                            </a>
                        
                                            <!-- Body -->
                                            <div class="card-body">
                                              <div class="row align-items-center">
                                                <div class="col">
                        
                                                  <!-- Title -->
                                                  <h4 class="mb-2 name">
                                                    <a href="{{route('edit.slider',$item->id)}}">{{$item->titulo}}</a>
                                                  </h4>
                        
                                                  <!-- Subtitle -->
                                                  <p class="card-text small text-muted">
                                                    {{$item->subtitulo}}
                                                  </p>
                        
                                                </div>
                                                <div class="col-auto">
                        
                                                  <!-- Dropdown -->
                                                  <div class="dropdown">
                                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="{{route('eliminar.slider',$item->id)}}" class="dropdown-item">
                                                        <i class="fe fe-trash-2"></i> Eliminar
                                                      </a>
                                                      <a href="{{route('edit.slider',$item->id)}}" class="dropdown-item">
                                                        <i class="fe fe-edit"></i> Editar
                                                      </a>
                                                    </div>
                                                  </div>
                        
                                                </div>
                                              </div> <!-- / .row -->
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
          


         
      </script>
  @endpush
@endsection