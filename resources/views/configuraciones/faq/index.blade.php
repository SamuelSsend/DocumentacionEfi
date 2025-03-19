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
                    Preguntas Frecuentes
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   FAQ
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
                            Preguntas
                          </h4>
          
                   
                          <!-- Button -->
                          <a href="{{route('create.faq')}}" class="btn btn-sm btn-primary">
                            Registrar
                          </a>
          
                        </div>

                        <div class="card-body">
          
                          <!-- List -->
                            <ul class="list-group list-group-lg list-group-flush list my-n4">
                            
                                @foreach ($faq as $item)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                      <div class="col-auto">
                
                                        <!-- Avatar -->
                                        <a href="#!" class="avatar avatar-lg">
                                          <span class="avatar-title rounded bg-white text-secondary">
                                            <span class="fe fe-folder"></span>
                                          </span>
                                        </a>
                
                                      </div>
                                      <div class="col ml-n2">
                
                                        <!-- Title -->
                                        <h4 class="mb-1 name">
                                          <a href="#!">{{$item->pregunta}}</a>
                                        </h4>
                
                                        <!-- Time -->
                                        <p class="card-text small text-muted">
                                            {{$item->respuesta}}
                                        </p>
                
                                      </div>
                                     
                                      <div class="col-auto">
                
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                
                                          <!-- Toggle -->
                                          <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                          </a>
                
                                          <!-- Menu -->
                                          <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('edit.faq',$item->id)}}" class="dropdown-item">
                                                <i class="fe fe-edit"></i> Editar
                                            </a>
                                           
                                          </div>
                
                                        </div>
                
                                      </div>
                                    </div> <!-- / .row -->
                                  </li>
                                @endforeach
                            </ul>
          
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