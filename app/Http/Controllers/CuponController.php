<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Carrito;
use App\Cupon;

class CuponController extends Controller
{
    public function create()
    {
        $categorias = DB::table('menu_comida')
            ->select('titulo')
            ->where('activo', '=', '1')
            ->get();

        return view('cupones.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'precio_minimo' => 'required|numeric|min:0',
            'tipo_descuento' => 'required|in:porcentaje,envio_gratis,importe_fijo',
            'descuento' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::table('cupon')->insert([
                'nombre' => $request->input('nombre'),
                'codigo' => $request->input('codigo'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
                'canjeos_max' => $request->input('canjeos_max'),
                'precio_minimo' => $request->input('precio_minimo'),
                'tipo_descuento' => $request->input('tipo_descuento'),
                'descuento' => $request->input('descuento'),
                'categoria' => implode(',', $request->input('categoria', [])),
                'activo' => 1,
            ]);

            return redirect()->route('cupones.index')->with('success', 'Cupón creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear el cupón: ' . $e->getMessage())->withInput();
        }
    }


    public function index()
    {
        $cupones = DB::table('cupon')
            ->where('activo', 1)
            ->get();

        return view('cupones.index', compact('cupones'));
    }
    
    public function obtener()
    {
        $uuid = session()->get('iduser');
    
        // Si uuid es null, busca un carrito que tenga el uuid en null
        $carrito = Carrito::where('uuid', $uuid)->orWhereNull('uuid')->first();
    
        // Verifica si $carrito es null
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }
    
        $cupones = $carrito->cupones;
    
        return response()->json(['cupones' => $cupones]);
    }

    public function destroy($id)
    {
        DB::table('cupon')->where('id', $id)->delete();
        return redirect()->route('cupones.index')->with('success', 'Cupón eliminado correctamente');
    }

    public function delete($id)
    {
        DB::table('carrito_cupon')->where('cupon_id', '=', $id)->delete();
        Cupon::where('id', $id)->where('num_canjeos', '>', 0)->decrement('num_canjeos', 1);
        return response()->json(['success' => true]);
    }
}
