<?php

namespace App\Http\Controllers;

use App\ConfigGeneral;
use App\Console\Commands\SincronizarCarta;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Session;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $general = DB::table('config_general')
            ->first();
        return view('configuraciones.general.index', compact('general'));
    }

    public function guardar(Request $request)
    {

        $validator = $request->validate(
            [
            'nombre_empresa' => 'required|max:150',
            'logo' => 'max:5000',
            'cr' => 'required|max:150',
            'ubicacion' => 'required',
            'correo' => 'max:150|email|required',
            'telefono1' => 'required|max:30',
            'telefono2' => 'required|max:30',
            'facebook' => 'required|max:300',
            'twitter' => 'required|max:300',
            'instagram' => 'required|max:300',
            'horarios' => 'required|max:300',
            'color_texto_menu' => 'required',
            'color_fondo_menu' => 'required',
            'facebook_iframe' => 'required',
            'stripe_public' => 'required|max:300',
            'stripe_private' => 'required|max:300',
            'hosteltactil_token' => 'required',
            'hosteltactil_idlocal' => 'required|max:300',
            'hosteltactil_api' => 'required|max:300',
            'hosteltactil_tarifa' => 'required',
            'gastos_de_envio_id' => 'required',
            'precio_minimo' => 'required',
            'carta' => ''
            ]
        );
        $general = ConfigGeneral::findOrFail(1);
        $general->nombre_empresa = $request->get('nombre_empresa');
        $general->cr = $request->get('cr');
        $general->ubicacion = $request->get('ubicacion');
        $general->correo = $request->get('correo');
        $general->telefono1 = $request->get('telefono1');
        $general->telefono2 = $request->get('telefono2');
        $general->facebook = $request->get('facebook');
        $general->twitter = $request->get('twitter');
        $general->iframe = $request->get('iframe');
        $general->instagram = $request->get('instagram');
        $general->horarios = $request->get('horarios');
        $general->horarios = $request->get('horarios');
        $general->color_texto_menu = $request->get('color_texto_menu');
        $general->color_fondo_menu = $request->get('color_fondo_menu');
        $general->facebook_iframe = $request->get('facebook_iframe');
        $general->stripe_public = $request->get('stripe_public');
        $general->stripe_private = $request->get('stripe_private');
        $general->hosteltactil_api = $request->get('hosteltactil_api');
        $general->hosteltactil_token = $request->get('hosteltactil_token');
        $general->hosteltactil_idlocal = $request->get('hosteltactil_idlocal');
        $general->hosteltactil_tarifa = $request->get('hosteltactil_tarifa');
        $general->gastos_de_envio_id = $request->get('gastos_de_envio_id');
        $general->precio_minimo = $request->get('precio_minimo');
        if ($request->logo) {
            $extension1 = $request->logo[0]->extension();
            try {
                unlink(public_path('admin/' . $general->logo));
            } catch (\Exception $e) {
            }
            if ($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'webp' || $extension1 == 'svg') {
                $imgname1 = uniqid();

                $imageName1 = $imgname1 . '.' . $request->logo[0]->extension();
                $request->logo[0]->move(public_path('admin'), $imageName1);
                $general->logo = $imageName1;
            } else {
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }
        }
        if ($request->has('carta')) {
            $name = uniqid() . ".pdf";
            $request->carta[0]->move(public_path('admin'), $name);
            $general->carta = $name;
        }

        $general->save();
        Session::flash('success', 'Se actualizó los cambios con exito');
        return redirect()->back();

    }

    public function precioMin()
    {
        $general = ConfigGeneral::first();
        return response()->json(['precio_minimo' => $general->precio_minimo]);
    }

    public function syncHostelTactil()
    {
        Artisan::call(SincronizarCarta::class);
    }
}