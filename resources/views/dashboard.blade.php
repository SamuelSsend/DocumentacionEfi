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
                    Panel de control
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                   Dashboard
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->

          <div class="row">
            <div class="col-12 col-lg-6 col-xl">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
  
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                       {{$mes_string}}
                      </h6>
  
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{$mes_actual->total_pagado}}€
                      </span>
  
                    </div>
                    <div class="col-auto">
  
                      <!-- Icon -->
                      <span class="h2 fe fe-calendar text-muted mb-0"></span>
  
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>


            <div class="col-12 col-lg-6 col-xl">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
  
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                       Usuarios
                      </h6>
  
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{count($usuarios)}}
                      </span>
  
                    </div>
                    <div class="col-auto">
  
                      <!-- Icon -->
                      <span class="h2 fe fe-user text-muted mb-0"></span>
  
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-6 col-xl">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col">
  
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                       Pedidos totales
                      </h6>
  
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{count($pedidos_totales)}}
                      </span>
  
                    </div>
                    <div class="col-auto">
  
                      <!-- Icon -->
                      <span class="h2 fe fe-shopping-bag text-muted mb-0"></span>
  
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
          </div>
        
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="chart">
                    <canvas class="chart-canvas" id="chart1"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          <form method="POST" action="{{ route('horario') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horario de apertura y cierre</h4>
                    </div>
                    <div class="card-body">
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $day)
                            @php
                                $horariosDelDia = $horarios->where('dia', $day)->where('cerrado', 0);
                                $isClosed = $horarios->where('dia', $day)->where('cerrado', 1)->count() > 0;
                            @endphp
                            <div class="day d-flex flex-column mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>{{ $day }}</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="closed-{{ $day }}" name="closed[{{ $day }}]"
                                            @if ($isClosed) checked @endif>
                                        <label class="form-check-label" for="closed-{{ $day }}">Cerrado</label>
                                    </div>
                                </div>
                                <div id="time-slots-{{ $day }}" class="d-flex flex-wrap">
                                    @if (!$isClosed)
                                        @foreach ($horariosDelDia as $horario)
                                            <div class="time-slot d-flex mr-2">
                                                <label class="mr-1">Desde: </label>
                                                <select class="from form-control mr-2" name="from[{{ $day }}][]">
                                                    @for ($i = 0; $i < 24; $i++)
                                                        @for ($j = 0; $j < 60; $j += 15)
                                                            @php
                                                                $val = sprintf('%02d:%02d', $i, $j);
                                                                $value = sprintf('%02d:%02d:00', $i, $j);
                                                            @endphp
                                                            <option value="{{ $val }}" @if ($horario->desde == $value) selected @endif>{{ $val }}</option>
                                                        @endfor
                                                    @endfor
                                                </select>
                                                <label class="mr-1">Hasta: </label>
                                                <select class="to form-control mr-2" name="to[{{ $day }}][]">
                                                    @for ($i = 0; $i < 24; $i++)
                                                        @for ($j = 0; $j < 60; $j += 15)
                                                            @php
                                                                $val = sprintf('%02d:%02d', $i, $j);
                                                                $value = sprintf('%02d:%02d:00', $i, $j);
                                                            @endphp
                                                            <option value="{{ $val }}" {{($horario->hasta == $value) ? 'selected': ''}}>{{ $val }}</option>
                                                        @endfor
                                                    @endfor
                                                </select>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <button class="add-slot btn btn-primary mr-2" type="button" data-day="{{ $day }}"
                                        @if ($isClosed) disabled @endif>Añadir tramo horario</button>
                                    <button class="remove-slot btn btn-danger" type="button" data-day="{{ $day }}"
                                        @if ($isClosed) disabled @endif>Quitar tramo horario</button>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" value="Guardar" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    
        </div>
      </div> <!-- / .row -->
    </div>
    
  </div>
  @push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    var timeSlotCounts = {};

    function createTimeSlot(minTime, day, fromTime = null, toTime = null) {
        var timeSlot = $('<div class="time-slot d-flex mr-2"></div>');
        var labelFrom = $('<label class="mr-1">Desde: </label>');
        var selectFrom = $('<select class="from form-control mr-2" name="from[' + day + '][]"></select>');
        var labelTo = $('<label class="mr-1">Hasta: </label>');
        var selectTo = $('<select class="to form-control mr-2" name="to[' + day + '][]"></select>');

        for (var i = 0; i < 24; i++) {
            for (var j = 0; j < 60; j += 15) {
                var value = (i < 10 ? '0' + i : i) + ':' + (j < 10 ? '0' + j : j);
                if (value >= minTime) {
                    selectFrom.append('<option value="' + value + '"' + (value === fromTime ? ' selected' : '') + '>' + value + '</option>');
                    selectTo.append('<option value="' + value + '"' + (value === toTime ? ' selected' : '') + '>' + value + '</option>');
                }
            }
        }

        timeSlot.append(labelFrom);
        timeSlot.append(selectFrom);
        timeSlot.append(labelTo);
        timeSlot.append(selectTo);
        return timeSlot;
    }

    $('.add-slot').click(function() {
        var day = $(this).data('day');
        if (!timeSlotCounts[day]) {
            timeSlotCounts[day] = 0;
        }
        if (timeSlotCounts[day] < 3) {
            var lastToValue = $('#time-slots-' + day + ' .to').last().val();
            $('#time-slots-' + day).append(createTimeSlot(lastToValue, day));
            timeSlotCounts[day]++;
        }
    });

    $('.remove-slot').click(function() {
        var day = $(this).data('day');
        if (timeSlotCounts[day] > 1) {
            $('#time-slots-' + day).children().last().remove();
            timeSlotCounts[day]--;
        }
    });

    $('.day').each(function() {
        var day = $(this).find('.add-slot').data('day');
        if ($('#time-slots-' + day + ' .time-slot').length === 0) {
            $('#time-slots-' + day).append(createTimeSlot('00:00', day));
            timeSlotCounts[day] = 1;
        }
    });

    $(document).on('change', '.from, .to', function() {
        var from = $(this).parent().find('.from');
        var to = $(this).parent().find('.to');
        if (from.val() >= to.val()) {
            alert('La hora "desde" debe ser anterior a la hora "hasta".');
            from.val(to.val());
        }
    });

    $(document).on('change', '.form-check-input', function() {
        var day = $(this).attr('id').replace('closed-', '');
        if ($(this).is(':checked')) {
            $('#time-slots-' + day + ' select').prop('disabled', true);
            $('.day:has(#time-slots-' + day + ') .add-slot, .day:has(#time-slots-' + day + ') .remove-slot').prop('disabled', true);
        } else {
            $('#time-slots-' + day + ' select').prop('disabled', false);
            $('.day:has(#time-slots-' + day + ') .add-slot, .day:has(#time-slots-' + day + ') .remove-slot').prop('disabled', false);
            $('#time-slots-' + day).empty();
            $('#time-slots-' + day).append(createTimeSlot('00:00', day));
            timeSlotCounts[day] = 1;
        }
    });
});

        new Chart('chart1', {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  callback: function(value) {
                    return '€' + value;
                  }
                }
              }]
            }
          },
          data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
              label: 'Earned',
              data: ["<?php echo $pedidos_1->total_pagado?>","<?php echo $pedidos_2->total_pagado?>","<?php echo $pedidos_3->total_pagado?>","<?php echo $pedidos_4->total_pagado?>","<?php echo $pedidos_5->total_pagado?>","<?php echo $pedidos_6->total_pagado?>","<?php echo $pedidos_7->total_pagado?>","<?php echo $pedidos_8->total_pagado?>","<?php echo $pedidos_9->total_pagado?>","<?php echo $pedidos_10->total_pagado?>","<?php echo $pedidos_11->total_pagado?>","<?php echo $pedidos_12->total_pagado?>"]
            }]
          }
        });
      </script>
  @endpush
@endsection