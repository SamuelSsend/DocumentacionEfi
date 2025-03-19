<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contacto;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class ContactoController extends Controller
{
    public function contacto()
    {
        $config = DB::table('config_general')
        ->first();


        return view('contacto', compact('config'));
    }

    public function send_contacto(Request $request)
    {

            $validator = $request->validate(
                [
                'nombres'=>'required|max:50',
                'apellidos'=>'required|max:50',
                'correo'=>'required|max:50|email',
                'mensaje'=>'required|max:200',
                'telefono'=>'required|max:9'
                ]
            );

            $contacto = new Contacto;
            $contacto->nombres = $request->get('nombres');
            $contacto->apellidos = $request->get('apellidos');
            $contacto->correo = $request->get('correo');
            $contacto->mensaje = $request->get('mensaje');
            $contacto->telefono = $request->get('telefono');
            $mytime = Carbon::now();
            $contacto->createAt = $mytime->format('Y-m-d H:i:s');
            $contacto->save();

            Session::flash('success', 'Se envió su mensaje con exito, nos comunicaremos en breve.');
            return redirect()->back();

    }
}
