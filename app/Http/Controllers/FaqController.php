<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Faq;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $faq = DB::table('faq')
            ->orderby('id', 'desc')
            ->get();

        return view('configuraciones.faq.index', compact('faq'));
    }

    public function create()
    {
        return view('configuraciones.faq.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
            'pregunta'=>'required|max:150',
            'respuesta'=>'required',

            ]
        );

        try {
            $faq = new Faq;
            $faq->pregunta = $request->get('pregunta');
            $faq->respuesta = $request->get('respuesta');
            $faq->save();   
            Session::flash('success', 'Se registró con exito la nueva pregunta');
            return redirect()->route('index.faq');
        } catch (\Exception $e) {
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $faq = DB::table('faq')
            ->where('id', '=', $id)
            ->first();

        return view('configuraciones.faq.edit', compact('faq'));
    }
}
