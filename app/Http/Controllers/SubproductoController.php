<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Subproducto;
use Illuminate\Support\Facades\Validator;
use Session;

class SubproductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {
        $search = $request->get('search');
        $subproductos = DB::table('subproductos')
            ->where(
                [
                ['nombre','LIKE','%'.$search.'%']
                ]
            )
            ->orderby('id', 'desc')
            ->paginate(10);

        
        return view('subproductos.index', compact('subproductos', 'search'));
    }

    public function create()
    {
        $combinados = DB::table('combinado')
        ->get();
        return view('subproductos.create', compact('combinados'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'nombre'=>'required|max:200',
            'precio'=>'required|max:11',
            ]
        );


     

            $subproductos = new Subproducto;
            $subproductos->nombre = $request->get('nombre');
            $subproductos->precio = $request->get('precio');
            $subproductos->estado = 'Disponible';
        if ($request->hasFile('img_path')) {
            $uploadedFile = $request->file('img_path');
            
            $extension2 = $uploadedFile->extension();
            
            try {
                unlink(public_path('admin_subproductos/' . $subproductos->img_path));
            } catch (\Exception $e) {
                // Manejar la excepción si es necesario
            }
            
            if ($extension2 == 'png' || $extension2 == 'jpeg' || $extension2 == 'jpg' || $extension2 == 'webp') {
                $imgname2 = uniqid();
                $imageName2 = $imgname2 . '.' . $extension2;
                $uploadedFile->move(public_path('admin_subproductos'), $imageName2);
                $subproductos->img_path = $imageName2;
            } else {
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }
        }
            

            $subproductos->save();
            Session::flash('success', 'Se registró con exito el nuevo subproducto');
            return redirect()->route('admin.subproducto');
        
    }

    public function edit($id)
    {
        $combinado = DB::table('combinados')
        ->get();

        $subproductos = Subproducto::findOrFail($id);


        return view('subproductos.edit', compact('combinados', 'subproductos'));
    }

    public function update(Request $request,$id)
    {
        $validator = $request->validate(
            [
            'nombre'=>'required|max:200',
            'precio'=>'required|max:11',
            'combinado'=>'required|max:200',
            ]
        );

        try {
           
            $subproductos = Subproducto::findOrFail($id);
            $subproductos->nombre = $request->get('nombre');
            $subproductos->precio = $request->get('precio');
            $subproductos->combinado = $request->get('combinado');
            $subproductos->estado = 'Disponible';

            $subproductos->update();
            Session::flash('success', 'Se actualizó con exito el subproducto');
            return redirect()->route('admin.subproducto');
        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }

    public function editar($id)
    {
        $subproducto = Subproducto::findOrFail($id);
        return view('subproductos.edit2', compact('subproducto'));
    }

    public function actualizar(Request $request, $id)
    {
        $subproducto = Subproducto::findOrFail($id);
        
        // Validar los datos del formulario
        $request->validate(
            [
            'nombre' => 'required',
            'precio' => 'required|numeric',
            // Agrega las reglas de validación para los demás campos
            ]
        );

        // Actualizar los datos del subproducto
        $subproducto->nombre = $request->nombre;
        $subproducto->precio = $request->precio;
        // Actualiza los demás campos según corresponda
        
        $subproducto->save();

        // Redirecciona a la página deseada después de la actualización
        return redirect()->route('admin.subproducto')->with('success', 'Subproducto actualizado exitosamente.');
    }

    public function eliminar($subproducto_id)
    {
        try {
             $subproducto = Subproducto::findOrFail($subproducto_id);

             $subproducto->combinados()->detach();
    
            // Elimina el combinado
            $subproducto->delete();
    
            // Redirecciona a la página principal o a cualquier otra ruta deseada
                // try{
                //     unlink(public_path('admin/'.$subproducto->img_path));
                // }
                // catch(\Exception $e){    
                // }
 
             Session::flash('success', 'Se eliminó el subproducto correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }

    public function estado($id)
    {
        try {
             $subproductos = Subproducto::findOrFail($id);
            if($subproductos->estado == 'Disponible') {
                $subproductos->estado = 'Agotado';
            }else{
                $subproductos->estado = 'Disponible';
            }
             $subproductos->update();
 
             Session::flash('success', 'Se actualizó el estado del subproducto correctamente');
             return redirect()->back();
        } catch (\Exception $e) {
             Session::flash('danger', $e);
             return redirect()->back();
        }
    }
}