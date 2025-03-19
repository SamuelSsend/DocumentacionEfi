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
                    Editar contenedor
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('update.seccion_uno',$seccion->id)}}" method="POST" enctype="multipart/form-data">
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

          
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" name="titulo" class="form-control"  placeholder="Titulo" value="{{$seccion->titulo}}">
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Subtitulo</label>
                                    <input type="text" name="subtitulo" class="form-control" placeholder="Subtitulo" value="{{$seccion->subtitulo}}">
                                  </div>
                            </div>
                            <div class="col-lg-6 mx-auto">
                                <div class="form-group">
                                    <label>Portada</label>
                                    <input type="file" id="imgInp" name="portada" class="form-control mb-4" >
                                    <img id="blah" class="mb-4" src="{{asset('admin/'.$seccion->portada)}}" style="width:100% !important">

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" checked="false" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Visibilidad <b id="txtestado"></b></label>

                                        <input type="hidden" value="{{$seccion->estado}}" name="estado" id="dataestado">
                                      </div>
                                  </div>
                            </div>
                        </div>
                        
                        
                       
                        
                    </div>
                  </div>
     

            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
            <a href="{{route('index.seccion_uno')}}" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div> 

  @push('scripts')
      <script>

          $(document).ready(function(){
            var check = $('#dataestado').val();
           
            if(check == '1'){
                $('#customSwitch1').attr("checked",true);
                $('#txtestado').text('activa');
            }
            else if(check == '0'){
                $('#customSwitch1').attr("checked",false);
                $('#txtestado').text('desactiva');
            }

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

        $( '#customSwitch1' ).on( 'click', function() {
            if( $(this).is(':checked') ){
                $('#dataestado').val('1');
                $('#txtestado').text('activa');
            } else {
                $('#dataestado').val('0');
                $('#txtestado').text('desactiva');
            }
        });
         
      </script>
  @endpush
@endsection