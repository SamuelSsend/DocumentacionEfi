<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $slider = DB::table('slider')
            ->orderby('id', 'desc')
            ->get();

        return view('configuraciones.slider.index', compact('slider'));
    }

    public function create()
    {
        return view('configuraciones.slider.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'subtitulo'=>'required|max:50',
            'estado'=>'required|max:50',
            'portada'=>'required|max:5000',
            ]
        );
        try {
            $slider = new Slider;
            $slider->titulo = $request->get('titulo');
            $slider->subtitulo = $request->get('subtitulo');
            $slider->estado = $request->get('estado');
            if($request->portada) {
                
                $extension3 = $request->portada->extension();
                if($extension3 == 'png' || $extension3 == 'jpeg' || $extension3 == 'jpg' || $extension3 == 'webp' || $extension3 == 'svg') {
                    $imgname3 = uniqid();
                    $imageName3 = $imgname3.'.'.$request->portada->extension();  
                    $request->portada->move(public_path('admin'), $imageName3);
                    $slider->portada = $imageName3;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
   
            $slider->save();   
            Session::flash('success', 'Se registrÃ³ con exito la nueva entrada');
            return redirect()->route('index.slider');
        } catch (\Exception $e) {
            Session::flash('success', $e);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('configuraciones.slider.edit', compact('slider'));
    }

    public function update(Request $request,$id)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'subtitulo'=>'required|max:50',
            'estado'=>'required|max:50',
            'portada'=>'max:5000',
            ]
        );
        try {
            $slider = Slider::findOrFail($id);
            $slider->titulo = $request->get('titulo');
            $slider->subtitulo = $request->get('subtitulo');
            $slider->estado = $request->get('estado');
            if($request->portada) {
                
                $extension3 = $request->portada->extension();
                if($extension3 == 'png' || $extension3 == 'jpeg' || $extension3 == 'jpg' || $extension3 == 'webp' || $extension3 == 'svg') {
                    $imgname3 = uniqid();
                    $imageName3 = $imgname3.'.'.$request->portada->extension();  
                    $request->portada->move(public_path('admin'), $imageName3);
                    $slider->portada = $imageName3;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
   
            $slider->update();   
            Session::flash('success', 'Se actualizÃ³ con exito la nueva entrada');
            return redirect()->route('index.slider');
        } catch (\Exception $e) {
            Session::flash('success', $e);
            return redirect()->back();
        }
    }
    
    public function destroy($id)
    {
        try {
             $slider = Slider::findOrFail($id);
            try{
                unlink(public_path('admin/'.$slider->foto));
            }
            catch(\Exception $e){    
            }
             $slider->destroy($id);
 
             Session::flash('success', 'Se elimin¨® el slider correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }
}
