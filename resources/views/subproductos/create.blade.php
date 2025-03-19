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
                    Registrar subproducto
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->
          <form class="mb-4" action="{{route('store.subproducto')}}" method="POST" enctype="multipart/form-data">
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
                          <input type="text" class="form-control form-control-flush" name="nombre" placeholder="Nombre del subproducto" value="{{old('nombre')}}">
                          @if ($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre') }}
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
                                <input type="text" class="form-control form-control-flush" name="precio" placeholder="Precio del subproducto" value="{{old('precio')}}">
                                @if ($errors->has('precio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('precio') }}
                                </div>
                                @endif
                          </div>
                      </div> 
                  </div>
                
              </div>
                         
            </div>
            <div class="form-group">
              <div class="card">
                  <div class="card-body">
                    <input type="file" name="img_path" class="files" >
                  </div>
              </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           
            
     
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
            <a onClick="history.go(-1);" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

            
          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div> 

@endsection