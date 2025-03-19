<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Navegacion;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;


class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $nav = DB::table('navegacion')
            ->orderby('id', 'desc')
            ->get();

        return view('nav.index', compact('nav'));
    }

    public function create()
    {
        return view('nav.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'enlace'=>'required|max:250',
            'icono'=>'required|max:50',
            ]
        );

        $nav = new Navegacion;
        $nav->titulo = $request->get('titulo');
        $nav->icono = $request->get('icono');
        $nav->enlace = $request->get('enlace');
        $nav->save();

        Session::flash('success', 'Se registró con exito el nuevo item de menú');
        return redirect()->route('index.nav');
    }

    public function edit($id)
    {
        $nav = Navegacion::findOrFail($id);
        return view('nav.edit', compact('nav'));
    }

    public function update(Request $request,$id)
    {
        $validator = $request->validate(
            [
            'titulo'=>'required|max:50',
            'enlace'=>'required|max:250',
            'icono'=>'required|max:50',
            ]
        );

        $nav = Navegacion::findOrFail($id);
        $nav->titulo = $request->get('titulo');
        $nav->icono = $request->get('icono');
        $nav->enlace = $request->get('enlace');
        $nav->update();

        Session::flash('success', 'Se actualizó con exito el nuevo item de menú');
        return redirect()->route('index.nav');
    }

    public function destroy($id)
    {
        $nav = Navegacion::findOrFail($id);
        $nav->destroy($id);

        Session::flash('success', 'Se eliminó el menú correctamente');
        return redirect()->back();
    }
}
