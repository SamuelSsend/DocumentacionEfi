<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pedido;
use App\PedidoDetalle;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;


class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $pedido = DB::table('pedidos as p')
            ->select('p.id', 'p.fecha', 'p.direccion', 'p.total_pagado', 'p.estado', 'p.tiempo_estimado', 'p.name', 'p.email')
            ->orderby('p.id', 'desc')
        //        ->paginate(2)
            ->get();



        return view('ventas.index', compact('pedido'));
    }

    public function detalle($id)
    {
        $pedido = DB::table('pedidos as p')
            ->select('p.id', 'p.fecha', 'p.direccion', 'p.total_pagado', 'p.estado', 'p.tiempo_estimado', 'p.telefono', 'p.name', 'p.email')
            ->where('p.id', '=', $id)
            ->orderby('p.id', 'desc')
            ->first();

        $detalle = DB::table('pedido_detalle')
            ->where('idpedido', '=', $id)
            ->get();

        return view('ventas.modal', compact('pedido', 'detalle'));
    }

    public function estado(Request $request,$id)
    {


        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->get('estado');
        $pedido->update();

        Session::flash('success', 'Se cambió el estado correctamente');
        return redirect()->route('index.ventas');
    }
}
