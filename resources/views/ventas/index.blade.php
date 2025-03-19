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
                    Ventas
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Historial de pedidos
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
                      <div class="card">
                        <div class="card-header">

                          <!-- Title -->
                          <h4 class="card-header-title">
                            Pedidos
                          </h4>


                          </button>


                        </div>

                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Total pagado</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opciones</th>
                              </tr>
                            </thead>
                            @foreach ($pedido as $item)

                              <tbody>
                                <tr>
                                  <td>{{$item->fecha}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->total_pagado}} €</td>
                                  <td>
                                      @if ($item->estado == 'En espera')
                                        <span class="badge badge-warning">{{$item->estado}}</span>
                                      @elseif($item->estado == 'Enviado')
                                       <span class="badge badge-primary">{{$item->estado}}</span>
                                      @elseif($item->estado == 'Entregado')
                                       <span class="badge badge-success">{{$item->estado}}</span>
                                      @endif
                                  </td>
                                  <td>

                                    <!-- Dropdown -->
                                  <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" data-expanded="false" aria-expanded="false">
                                      <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                      <a href="{{route('detalle.ventas',$item->id)}}" class="dropdown-item" style="cursor:pointer">
                                        <i class="fe fe-folder"></i> Ver detalles
                                      </a>

                                      <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}" style="cursor:pointer">
                                        <i class="fe fe-toggle-left"></i> Cambiar estado
                                      </a>

                                    </div>
                                  </div>

                                  </td>
                                </tr>


                                <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                    <form action="{{route('estado.ventas',$item->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:300px">
                                            <div class="modal-content">
                                              <div class="modal-card card" data-list="{&quot;valueNames&quot;: [&quot;name&quot;]}">
                                                <div class="card-header">

                                                  <!-- Title -->
                                                  <h4 class="card-header-title" id="exampleModalCenterTitle">
                                                    Cambiar estado
                                                  </h4>

                                                  <!-- Close -->
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>

                                                </div>

                                                <div class="card-body">

                                                  <select class="custom-select" data-toggle="select" name="estado">
                                                      @if ($item->estado == 'En espera')
                                                          <option value="En espera" selected>En espera</option>
                                                          <option value="Enviado">Enviado</option>
                                                          <option value="Entregado">Entregado</option>
                                                      @elseif($item->estado == 'Enviado')
                                                          <option value="En espera">En espera</option>
                                                          <option value="Enviado" selected>Enviado</option>
                                                          <option value="Entregado">Entregado</option>
                                                      @elseif($item->estado == 'Entregado')
                                                          <option value="En espera">En espera</option>
                                                          <option value="Enviado" >Enviado</option>
                                                          <option value="Entregado" selected>Entregado</option>
                                                      @endif
                                                  </select>

                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </form>
                                </div>

                              </tbody>


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
