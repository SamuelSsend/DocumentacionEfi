<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Combinado;
use App\Subproducto;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class CombinadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $combinado= DB::table('combinado')
            ->orderby('id', 'desc')
            ->get();

        return view('configuraciones.combinados.index', compact('combinado'));
    }

    public function create()
    {
        $subproductos = Subproducto::all();
        return view('configuraciones.combinados.create', compact('subproductos'));
    }

    //TEST
    public function test(Request $request)
    {
        $search = $request->get('search');
        $combinado = Combinado::with('subproductos')
            ->where('nombrecombi', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('configuraciones.combinados.index2', compact('combinado', 'search'));
    }

    public function test_create()
    {
        $subproductos = Subproducto::all();
        return view('configuraciones.combinados.create2', compact('subproductos'));
    }
    

    public function test_store(Request $request)
    {
        // Crear el combinado
        $combinado = new Combinado;
        $combinado->nombrecombi = $request->input('nombrecombi');
        $combinado->save();

        return redirect(route('index.combinado'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'nombrecombi'=>'required|max:200|',
            ]
        );

        try {
            $combinado = new Combinado;
            $combinado->nombrecombi = $request->get('nombrecombi');
   
            $combinado->save();   
            Session::flash('success', 'Se registró con exito el nuevo combinado');
            return redirect()->route('index.combinado');
        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }

    public function test_edit(Combinado $combinado)
    {
        $subproductosDisponibles = Subproducto::all();
        return view('configuraciones.combinados.edit2', compact('combinado', 'subproductosDisponibles'));
    }

    public function eliminarSubproducto(Combinado $combinado, Subproducto $subproducto)
    {
        $combinado->subproductos()->detach($subproducto->id);
        return redirect()->back()->with('message', 'Subproducto eliminado correctamente');
    }

    public function agregarSubproducto(Request $request, Combinado $combinado)
    {
        $subproducto = new Subproducto;
        $subproducto->nombre = $request->input('nombre');
        $subproducto->precio = $request->input('precio');
        $subproducto->estado = "Disponible";
        $subproducto->img_path = "";
        $subproducto->save();

        $combinado->subproductos()->attach($subproducto->id);

        return redirect()->back()->with('message', 'Subproducto agregado correctamente');
    }

    public function relacionarSubproducto(Request $request, Combinado $combinado)
    {
        $subproductoId = $request->input('subproducto_id');

        if ($combinado->subproductos->contains('id', $subproductoId)) {
            return redirect()->back()->with('error', 'El combinado ya está relacionado con el subproducto');
        }
        
        $combinado->subproductos()->attach($subproductoId);

        return redirect()->back()->with('message', 'Subproducto relacionado correctamente');
    }

    public function eliminar($combinado_id)
    {
        // Obtén el combinado a eliminar
        $combinado = Combinado::findOrFail($combinado_id);
        
        // Elimina todas las relaciones de subproductos del combinado
        $combinado->subproductos()->detach();
        $combinado->alimentos()->detach();
    
        // Elimina el combinado
        $combinado->delete();
    
        // Redirecciona a la página principal o a cualquier otra ruta deseada
        return redirect()->route('index.combinado');
    }


    // public function edit($id){
    //     $combinado = Combinado::findOrFail($id);
    //     return view('configuraciones.combinado.edit',compact('combinado'));
    // }

    // public function update(Request $request,$id){
    //     $validator = $request->validate([
    //         'nombre'=>'required|max:200|'.$request->get('nombre').',nombre',
    //     ]);

    //     $combinado->update();   
    //     Session::flash('success', 'Se actualizó con exito el nuevo menú');
    //     return redirect()->route('index.menu');
    //     } 
    //     catch (\Exception $e) {
    //     Session::flash('danger', $e);
    //     return redirect()->back();

    // }

    // public function destroy($id){
    //     try {
    //         $menu = MenuComida::findOrFail($id);
    //            try{
    //                unlink(public_path('admin/'.$menu->preview));
    //                unlink(public_path('admin/'.$menu->fondo));
    //            }
    //            catch(\Exception $e){    
    //            }
    //         $menu->destroy($id);

    //         Session::flash('success', 'Se eliminó el menú correctamente');
    //         return redirect()->back();
    //    } catch (\Exception $e) {
    //         Session::flash('danger', $e);
    //         return redirect()->back();
    //    }
    // }
}
