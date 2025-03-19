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
                    Editar pregunta y respuesta
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('store.faq')}}" method="POST" enctype="multipart/form-data">
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

            <!-- Team name -->
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                          <input type="text" class="form-control form-control-flush {{ $errors->has('pregunta') ? ' is-invalid' : '' }}" name="pregunta" placeholder="Pregunta" value="{{$faq->pregunta}}">
                          @if ($errors->has('pregunta'))
                              <div class="invalid-feedback">
                                {{ $errors->first('pregunta') }}
                              </div>
                            @endif
                    </div>
                </div>          
            </div>

            <div class="form-group">
              <div class="row">
                  <div class="col-lg-12 col-md-12">
                      <div class="card">
                          <div class="card-body">
                                <textarea type="text" class="form-control form-control-flush {{ $errors->has('respuesta') ? ' is-invalid' : '' }}" name="respuesta" placeholder="Respuesta" style="height:100px">{{$faq->respuesta}}</textarea>
                                @if ($errors->has('respuesta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('respuesta') }}
                                </div>
                                @endif
                          </div>
                      </div> 
                  </div>
                  
              </div>
                         
            </div>
            

            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
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

      

$('.dz-button').text('Subir portada');

          $(document).ready(function() {
              $('input.files').fileuploader({
                  // Options will go here
              });
          });
         
      </script>
  @endpush
@endsection