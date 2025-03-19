<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $current_month = $today['mon'];
        $current_year = $today['year'];
        $mes_string =$data_month[ $current_month - 1];

        $pedidos_1 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',1],
                ['year','=',$current_year]
                ]
            )
            ->first();

        $mes_actual = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',$current_month],
                ['year','=',$current_year]
                ]
            )
            ->first();

        $pedidos_2 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',2],
                ['year','=',$current_year]
                ]
            )
            ->first();



        $pedidos_3 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',3],
                ['year','=',$current_year]
                ]
            )
            ->first();

  
  
        $pedidos_4 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',4],
                ['year','=',$current_year]
                ]
            )
            ->first();

    

        $pedidos_5 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',5],
                ['year','=',$current_year]
                ]
            )
            ->first();

  

        $pedidos_6 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where('mes', '=', 6)
            ->first();



        $pedidos_7 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',7],
                ['year','=',$current_year]
                ]
            )
            ->first();


        $pedidos_8 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',8],
                ['year','=',$current_year]
                ]
            )
            ->first();


      
        $pedidos_9 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',9],
                ['year','=',$current_year]
                ]
            )
            ->first();


        $pedidos_10 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',10],
                ['year','=',$current_year]
                ]
            )
            ->first();



        $pedidos_11 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',11],
                ['year','=',$current_year]
                ]
            )
            ->first();


        $pedidos_12 = DB::table('pedidos')
            ->select(DB::raw("sum(total_pagado) as total_pagado"))
            ->where(
                [
                ['mes','=',12],
                ['year','=',$current_year]
                ]
            )
            ->first();

        $usuarios = DB::table('users')
        ->get();

        $pedidos_totales = DB::table('pedidos')
        ->get();

        $horarios = DB::table('horario')->get();

        return view('dashboard', compact('horarios', 'pedidos_1', 'pedidos_2', 'pedidos_3', 'pedidos_4', 'pedidos_5', 'pedidos_6', 'pedidos_7', 'pedidos_8', 'pedidos_9', 'pedidos_10', 'pedidos_11', 'pedidos_12', 'mes_actual', 'mes_string', 'usuarios', 'pedidos_totales'));
    }

    public function horario(Request $request)
    {
        DB::table('horario')->truncate();
        
        $closed = $request->input('closed', []);
        $from = $request->input('from', []);
        $to = $request->input('to', []);
        
        $daysOfWeek = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        
        foreach ($daysOfWeek as $day) {
            if (isset($closed[$day])) {
                DB::table('horario')->insert(
                    [
                    'dia' => $day,
                    'cerrado' => 1,
                    ]
                );
                Log::info("Inserted closed day: $day");
            } else {
                if (isset($from[$day]) && isset($to[$day])) {
                    foreach ($from[$day] as $index => $fromTime) {
                        $toTime = $to[$day][$index];
                        Log::info("Inserting open day: $day, from: $fromTime, to: $toTime");
                        DB::table('horario')->insert(
                            [
                            'dia' => $day,
                            'desde' => $fromTime,
                            'hasta' => $toTime,
                            'cerrado' => 0,
                            ]
                        );
                    }
                } else {
                    Log::warning("No time slots found for $day");
                }
            }
        }

        return back()->with('success', 'Horario guardado correctamente.');
    }
}
