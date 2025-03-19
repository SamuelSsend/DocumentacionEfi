<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SeccionTres;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;


class SeccionTresController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        $seccion = DB::table('seccion_tres')
        ->get();

        return view('configuraciones.seccion_tres.index', compact('seccion'));
    }

    public function edit($id)
    {
        $seccion = DB::table('seccion_tres')
            ->where('id', '=', $id)
            ->first();

        return view('configuraciones.seccion_tres.edit', compact('seccion'));
    }

    public function update(Request $request,$id)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'descripcion'=>'required|max:150',
            'estado'=>'required',
            'icono'=>'required|max:50',
            ]
        );
        try {
            $seccion = SeccionTres::findOrFail($id);
            $seccion->titulo = $request->get('titulo');
            $seccion->descripcion = $request->get('descripcion');
            $seccion->estado = $request->get('estado');
            $seccion->icono = $request->get('icono');
            $seccion->update();   
         
            Session::flash('success', 'Se actualizó con exito la entrada');
            return redirect()->route('index.seccion_tres');
        } catch (\Exception $e) {
            Session::flash('success', $e);
            return redirect()->back();
        }
    }
}
