<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contacto;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class MensajeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $mensajes = DB::table('contacto')
            ->where(
                [
                ['createAt','LIKE','%'.$search.'%']
                ]
            )
            ->orderby('id', 'desc')
            ->paginate(15);

        
        return view('configuraciones.contacto.index', compact('mensajes', 'search'));
    }

    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->destroy($id);

        Session::flash('success', 'Se eliminó el mensaje correctamente');
        return redirect()->back();
    }

}
