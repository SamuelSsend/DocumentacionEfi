<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Galeria;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $galeria = DB::table('galeria')
            ->orderby('id', 'desc')
            ->get();

        return view('configuraciones.galeria.index', compact('galeria'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'imagen'=>'max:5000',
            'titulo'=>'required|max:250',
            'resena'=>'required|max:250',
            ]
        );

        try {
            $galeria = new Galeria;
            $galeria->titulo = $request->get('titulo');
            $galeria->resena = $request->get('resena');
            if($request->foto) {
                    
                $extension2 = $request->foto[0]->extension();
                if($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                    $imgname2 = uniqid();
                    $imageName2 = $imgname2.'.'.$request->foto[0]->extension();  
                    $request->foto[0]->move(public_path('admin'), $imageName2);
                    $galeria->foto = $imageName2;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            $galeria->save();
            Session::flash('success', 'Se agrego con exito la nueva imagen');
            return redirect()->route('index.galeria');
        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }

    public function eliminar($id)
    {
        try {
             $galeria = Galeria::findOrFail($id);
            try{
                unlink(public_path('admin/'.$galeria->foto));
            }
            catch(\Exception $e){    
            }
             $galeria->destroy($id);
 
             Session::flash('success', 'Se eliminó la imagen correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }
}
