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
          <form class="mb-4" action="{{route('update.seccion_tres',$seccion->id)}}" method="POST">
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Titulo</b></label>
                                    <input type="text" name="titulo" class="form-control"  placeholder="Titulo" value="{{$seccion->titulo}}">
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Descripcion</b></label>
                                    <textarea name="descripcion" class="form-control">{{$seccion->descripcion}}</textarea>
                                   
                                  </div>
                            </div>
                            <div class="col-lg-6 mx-auto">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><b>Seleccionar icono</b></label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control form-control-prepended" placeholder="Icono" id="icono_input" name="icono" value="{{$seccion->icono}}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="padding-right: 0px;padding:0px !important">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#iconos-modal" style="border-bottom-width: 0px;"><span class="fe fe-link"></span></button>
                                            </div>
                                        </div>
                                    
                                        

                                        @if ($errors->has('icono'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('icono') }}
                                            </div>
                                            @endif
                                    </div>

                                    <div class="text-center"> 
                                        <span id="span-icono" class="{{$seccion->icono}}" style="    font-size: 100px;"></span>
                                    </div>

                                    @include('nav.icon')
                                    
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
            <a href="{{route('index.seccion_tres')}}" class="btn btn-block btn-link text-muted">
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


        $('.btn-icono').on('click', function(event) {
            let classenlace = $(this).parent().children()[0].className;
            let data_class = classenlace.split(" ");
            
            $("#icono_input").val(data_class[1]);
            $("#span-icono").attr("class","");
            $("#span-icono").addClass(data_class[1]);
            $('#iconos-modal').modal('toggle');
        });

      
        });

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