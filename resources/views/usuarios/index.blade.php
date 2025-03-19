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
                    Registro de usuarios
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Usuarios
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>
          <h2>Datos Clientes</h2>
          <a href="{{ route('export.csv') }}" class="btn btn-primary">Exportar CSV</a>
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
                            Elementos
                          </h4>
          

                          </button>
                          <a href="{{route('create.usuario')}}" class="btn btn-sm btn-primary">Nuevo elemento</a>
          
                        </div>

                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th scope="col">Nombres</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Dirección</th>
								                <th scope="col">Teléfono</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Opciones</th>
                              </tr>
                            </thead>
                            @foreach ($user as $item)
                              <tbody>
                                <tr>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->email}}</td>
                                  <td>{{$item->direccion}}</td>
								                  <td>{{$item->telefono}}</td>
                                  <td>{{$item->role}}</td>
                                  <td>

                                    <!-- Dropdown -->
                                  <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" data-expanded="false" aria-expanded="false">
                                      <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                      <a href="{{route('edit.usuario',$item->id)}}" class="dropdown-item" style="cursor:pointer">
                                        <i class="fe fe-edit"></i> Editar usuario
                                      </a>
                                      <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}" style="cursor:pointer">
                                        <i class="fe fe-trash-2"></i> Eliminar
                                      </a>
                                    
                                    </div>
                                  </div>

                                  </td>
                                </tr>
                              </tbody>
                              @include('usuarios.modal')
                            @endforeach
                          </table>
                          
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