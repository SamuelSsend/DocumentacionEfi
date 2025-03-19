<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Inicio;
use Illuminate\Support\Facades\Validator;
use Session;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $inicio = DB::table('inicio')
        ->first();
        return view('configuraciones.inicio.index', compact('inicio'));
    }

    public function guardar(Request $request)
    {
      
        $validator = $request->validate(
            [
            'titulo_cabecera'=>'required|max:50',
            'titulo_principal'=>'required|max:100',
            'precio'=>'required|max:10',
            'titulo_producto'=>'required|max:50',
            'foot_img_dos'=>'max:5000',
            'foot_img_tres'=>'max:5000',
            'foot_img_cuatro'=>'max:5000',
            'foot_img_uno'=>'max:5000',
            ]
        );
        try {
            $inicio = Inicio::findOrFail(1);
            $inicio->titulo_cabecera = $request->get('titulo_cabecera');
            $inicio->titulo_principal = $request->get('titulo_principal');
            $inicio->precio = $request->get('precio');
            $inicio->titulo_producto = $request->get('titulo_producto');
           
            
            
            
            if($request->foot_img_uno) {
              
                $extension1 = $request->foot_img_uno->extension();
                try{
                    unlink(public_path('admin/'.$inicio->foot_img_uno));
                }
                catch(\Exception $e){    
                }
                if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'webp') {
                    $imgname1 = uniqid();
                    
                    $imageName1 = $imgname1.'.'.$request->foot_img_uno->extension();  
                    $request->foot_img_uno->move(public_path('admin'), $imageName1);
                    $inicio->foot_img_uno = $imageName1;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            if($request->foot_img_dos) {
                $extension2 = $request->foot_img_dos->extension();
                try{
                    unlink(public_path('admin/'.$inicio->foot_img_dos));
                }
                catch(\Exception $e){    
                }
                if($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                    $imgname2 = uniqid();
                    $imageName2 = $imgname2.'.'.$request->foot_img_dos->extension();  
                    $request->foot_img_dos->move(public_path('admin'), $imageName2);
                    $inicio->foot_img_dos = $imageName2;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            if($request->foot_img_tres) {
                $extension3 = $request->foot_img_tres->extension();
                try{
                    unlink(public_path('admin/'.$inicio->foot_img_tres));
                }
                catch(\Exception $e){    
                }
                if($extension3 == 'png' || $extension3 == 'jpeg' || $extension3 == 'jpg' || $extension3 == 'webp') {
                    $imgname3 = uniqid();
                    $imageName3 = $imgname3.'.'.$request->foot_img_tres->extension();  
                    $request->foot_img_tres->move(public_path('admin'), $imageName3);
                    $inicio->foot_img_tres = $imageName3;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            if($request->foot_img_cuatro) {
                $extension4 = $request->foot_img_cuatro->extension();
                try{
                    unlink(public_path('admin/'.$inicio->foot_img_cuadro));
                }
                catch(\Exception $e){    
                }
                if($extension4 == 'png' || $extension4 == 'jpeg' || $extension4 == 'jpg' || $extension4 == 'webp') {
                    $imgname4 = uniqid();
                    $imageName4 = $imgname4.'.'.$request->foot_img_cuatro->extension();  
                    $request->foot_img_cuatro->move(public_path('admin'), $imageName4);
                    $inicio->foot_img_cuatro = $imageName4;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            $inicio->save();
            Session::flash('success', 'Se actualizó los cambios con exito');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }
}
