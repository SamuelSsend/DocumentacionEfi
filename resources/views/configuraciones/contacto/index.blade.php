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
                    BANDEJA DE ENTRADA
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Mensajes
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
                  <div class="col-lg-4 mb-4">
                    {!! Form::open(array('url'=>'panel/mensajes','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                    <div class="input-group input-group-merge">
                      
                      <input type="date" name="search" value="{{$search}}" class="form-control form-control-prepended">
                      <div class="input-group-prepend">
                          <button class="btn btn-primary"><span class="fe fe-search"></span></button>
                      </div>
                     
                    </div>
                    {{Form::close()}}
                  </div>

                  <div class="col-lg-2 mb-4">
                    <a href="{{route('index.mensaje')}}" class="btn btn-primary"><span class="fe fe-repeat"></span> Resetear</a>
                  </div>

                    @foreach ($mensajes as $item)
                        <div class="col-12 col-xl-12">
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="row align-items-center">
                               
                                <div class="col ml-n2">
                                  <h4 class="mb-1">
                                    <a>{{$item->nombres}} {{$item->apellidos}}</a>
                                  </h4>
              
                                  <!-- Text -->
                                  <p class="card-text small text-muted mb-1">
                                    {{$item->createAt}}
                                  </p>
                                </div>
                                <div class="col ml-n2">
                                    <h4 class="mb-1">
                                        Telefono:
                                      </h4>
                                    <p class="card-text small text-muted mb-1">
                                      {{$item->telefono}}
                                    </p>
                                </div>

                                <div class="col ml-n2">
                                    <h4 class="mb-1">
                                        Correo electrónico:
                                      </h4>
                                    <p class="card-text small text-muted mb-1">
                                      {{$item->correo}}
                                    </p>
                                </div>

                                <div class="col-auto">
              
                                  <!-- Dropdown -->
                                  <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" data-expanded="false" aria-expanded="false">
                                      <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                      <a data-toggle="modal" data-target="#open_mensaje{{$item->id}}" class="dropdown-item" style="cursor:pointer">
                                        <i class="fe fe-cloud "></i> Ver mensaje
                                      </a>
                                      <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}" style="cursor:pointer">
                                        <i class="fe fe-trash-2"></i> Eliminar
                                      </a>
                                      
                                    </div>
                                  </div>


                                  <div class="modal fade" id="open_mensaje{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-card card" data-list="{&quot;valueNames&quot;: [&quot;name&quot;]}">
                                          <div class="card-header">
                              
                                            <!-- Title -->
                                            <h4 class="card-header-title" id="exampleModalCenterTitle">
                                              DE: {{$item->correo}}
                                            </h4>
                              
                                            <!-- Close -->
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                              
                                          </div>
                                          
                                          <div class="card-body">
                              
                                            <p>{{$item->mensaje}}</p>
                              
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

              
                                </div>
                              </div> <!-- / .row -->
                            </div> <!-- / .card-body -->
                          </div>
                      </div>
                      @include('configuraciones.contacto.modal')
         
                    @endforeach

                    <div class="col-lg-12 mt-4">
                      {{$mensajes->render()}}
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