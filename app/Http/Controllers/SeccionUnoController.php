<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SeccionUno;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;


class SeccionUnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        $seccion = DB::table('seccion_uno')
        ->get();

        return view('configuraciones.seccion_uno.index', compact('seccion'));
    }

    public function edit($id)
    {
        $seccion = DB::table('seccion_uno')
            ->where('id', '=', $id)
            ->first();

        return view('configuraciones.seccion_uno.edit', compact('seccion'));
    }

    public function update(Request $request,$id)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'subtitulo'=>'required|max:50',
            'estado'=>'required',
            'portada'=>'max:5000',
            ]
        );
        try {
            $seccion = SeccionUno::findOrFail($id);
            $seccion->titulo = $request->get('titulo');
            $seccion->subtitulo = $request->get('subtitulo');
            $seccion->estado = $request->get('estado');
            if($request->portada) {
                
                $extension3 = $request->portada->extension();
                if($extension3 == 'png' || $extension3 == 'jpeg' || $extension3 == 'jpg' || $extension3 == 'webp' || $extension3 == 'svg') {
                    $imgname3 = uniqid();
                    $imageName3 = $imgname3.'.'.$request->portada->extension();  
                    $request->portada->move(public_path('admin'), $imageName3);
                    $seccion->portada = $imageName3;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
   
            $seccion->update();   
            Session::flash('success', 'Se actualizó con exito la entrada');
            return redirect()->route('index.seccion_uno');
        } catch (\Exception $e) {
            Session::flash('success', $e);
            return redirect()->back();
        }
    }
}
