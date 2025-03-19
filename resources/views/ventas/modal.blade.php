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
                    Pedido
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Detalles de pedido
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
                            Datos
                          </h4>


                          <a href="{{route('index.ventas')}}" class="btn btn-sm btn-primary">Regresar</a>

                        </div>

                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Cliente:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->name}}
                                    </small>
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Dirección:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->direccion}}
                                    </small>
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Telefono:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->telefono}}
                                    </small>
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Email:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->email}}
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Fecha:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->fecha}}
                                    </small>
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Total pagado:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->total_pagado}} €
                                    </small>
                                </div>
                                <div class="col">
                                    <h4 class="mb-1">
                                      <a href="#!">Estado actual:</a>
                                    </h4>
                                    <small class="text-muted">
                                      {{$pedido->estado}}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th scope="col">Pedido</th>
                                <th scope="col">Precio unitario</th>

                              </tr>
                            </thead>
                            @foreach ($detalle as $det)

                                <tbody>
                                    <tr>
                                        <th scope="row">{{$det->producto}}</th>
                                        <td>{{$det->precio}} €</td>


                                    </tr>
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