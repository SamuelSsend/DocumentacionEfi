<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Alimento;
use App\Combinado;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $productos = Alimento::with('combinados')
            ->where('titulo', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('productos.index', compact('productos', 'search'));
    }

    public function create()
    {
        $categorias = DB::table('menu_comida')->get();
        $combinados = Combinado::all();
        return view('productos.create', compact('categorias', 'combinados'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:250',
            'precio'=>'required|max:250',
            'portada'=>'required|max:5000',
            ]
        );




            $alimento = new Alimento;
            $alimento->titulo = $request->get('titulo');
            $alimento->descripcion_manual = $request->get('descripcion_manual');
            $alimento->precio = $request->get('precio');
            $alimento->categoria = $request->get('categoria');
            $alimento->estado = 'Disponible';
            $alimento->oferta = '0';


        if($request->portada) {

            $extension2 = $request->portada[0]->extension();
            try{
                unlink(public_path('admin/'.$alimento->portada));
            }
            catch(\Exception $e){
            }
            if($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                $imgname2 = uniqid();
                $imageName2 = $imgname2.'.'.$request->portada[0]->extension();
                $request->portada[0]->move(public_path('admin'), $imageName2);
                $alimento->portada = $imageName2;
            }else{
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }
        }
            $alimento->save();

            $combinadosIds = $request->input('combinados');
            $alimento->combinados()->attach($combinadosIds);

            Session::flash('success', 'Se registró con exito el nuevo producto');
            return redirect()->route('admin.producto');

    }

    public function edit($id)
    {
        $categorias = DB::table('menu_comida')
        ->get();

        $combinados = Combinado::all();
        $producto = Alimento::findOrFail($id);
        $alergenos = DB::table('alergeno')->get();
        $checkAlergenos = DB::table('alimento_alergeno')
            ->select('alergeno_id')
            ->where('alimento_id', $id)
            ->get()
            ->pluck('alergeno_id')
            ->toArray();


        return view('productos.edit', compact('categorias', 'producto', 'combinados', 'alergenos', 'checkAlergenos'));
    }

    public function update(Request $request,$id)
    {
        DB::table('alimento_alergeno')->where('alimento_id', $id)->delete();
        if($request->has('alergenos')) {
            $alergenos = $request->get('alergenos');
            foreach($alergenos as $alergeno){
                DB::table('alimento_alergeno')->insert(
                    [
                    'alimento_id'=>$id,
                    'alergeno_id'=>$alergeno,
                    ]
                );
            }
        }

        $validator = $request->validate(
            [
            'titulo'=>'required|max:250',
            'precio'=>'required|max:250',
            'portada'=>'max:5000',
            ]
        );
        
        try {
            $alimento = Alimento::findOrFail($id);
            $alimento->titulo = $request->get('titulo');
            $alimento->descripcion_manual = $request->get('descripcion_manual') ?? '';
            $alimento->precio = $request->get('precio');
            $alimento->categoria = $request->get('categoria');
            $alimento->estado = 'Disponible';
            if($request->portada) {

                $extension2 = $request->portada[0]->extension();
                // try{
                //     unlink(public_path('admin/'.$alimento->portada));
                // }
                // catch(\Exception $e){
                // }
                if($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                    $imgname2 = uniqid();
                    $imageName2 = $imgname2.'.'.$request->portada[0]->extension();
                    $request->portada[0]->move(public_path('admin'), $imageName2);
                    $alimento->portada = $imageName2;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            $alimento->update();
            
            Session::flash('success', 'Se actualizó con exito el nuevo producto');
            return redirect()->route('admin.producto');
        } catch (\Exception $e) {
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function eliminar($id)
    {
        try {
             $producto = Alimento::findOrFail($id);
            try{
                unlink(public_path('admin/'.$producto->portada));
            }
            catch(\Exception $e){
            }
             $producto->destroy($id);
             $producto->combinados()->detach();

             Session::flash('success', 'Se eliminó el producto correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }

    public function edit_combinados($id)
    {
        $producto = Alimento::findOrFail($id);
        $combinados = Combinado::all();

        return view('productos.edit_combinados', compact('producto', 'combinados'));
    }

    public function update_combinados(Request $request, Alimento $producto)
    {
        $combinado = $request->input('combinado_id');

        if ($producto->combinados->contains('id', $combinado)) {
            return redirect()->back()->with('error', 'El combinado ya está relacionado con el producto');
        }

        $producto->combinados()->attach($combinado);

        return redirect()->back()->with('message', 'Combinado relacionado correctamente');
    }

    public function eliminar_combinados(Alimento $producto, Combinado $combinado)
    {
        $producto->combinados()->detach($combinado->id);
        return redirect()->back()->with('message', 'Subproducto eliminado correctamente');
    }


    public function estado($id)
    {
        try {
             $producto = Alimento::findOrFail($id);
            if($producto->estado == 'Disponible') {
                $producto->estado = 'Agotado';
            }else{
                $producto->estado = 'Disponible';
            }
             $producto->update();

             Session::flash('success', 'Se actualizó el estado del producto correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }

    public function oferta($id)
    {
        try {
             $producto = Alimento::findOrFail($id);
            if($producto->oferta == '0') {
                $producto->oferta = '1';
            }else{
                $producto->oferta = '0';
            }
             $producto->update();

             Session::flash('success', 'Se modificó el estado del producto');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }

    public function index_oferta()
    {
        $productos = Alimento::query()
            ->where('oferta', '=', '1')
            ->orderby('id', 'desc')
            ->get();

        return view('productos.index_oferta', compact('productos'));
    }

    public function update_portada(Request $request, $id)
    {
        $validator = $request->validate(
            [
            'portada_oferta'=>'max:5000',
            ]
        );
        try {

            $alimento = Alimento::findOrFail($id);
            if($request->portada_oferta) {

                $extension2 = $request->portada_oferta[0]->extension();
                try{
                    unlink(public_path('admin/'.$alimento->portada_oferta));
                }
                catch(\Exception $e){
                }
                if($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                    $imgname2 = uniqid();
                    $imageName2 = $imgname2.'.'.$request->portada_oferta[0]->extension();
                    $request->portada_oferta[0]->move(public_path('admin'), $imageName2);
                    $alimento->portada_oferta = $imageName2;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            $alimento->update();
            Session::flash('success', 'Se actualizó con exito el nuevo producto');
            return redirect()->route('index_oferta.producto');
        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }
}
