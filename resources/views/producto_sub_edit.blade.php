@extends('layouts.user')

@section('user')
<h3>Subproductos a elegir:</h3>
<form action="{{route('update_producto',['id'=>$carrito->id])}}" method="POST">
    @csrf
    @foreach ($combinados as $combinado)
        @foreach ($combinado->subproductos as $subproducto)
            <fieldset>
                @php
                        $existeSubproducto = DB::table('carrito_subproductos')
                            ->where('registro_id', $carrito->id)
                            ->where('subproducto_id', $subproducto->id)
                            ->exists();
                @endphp
            <input type="checkbox" name="subproductos[]" value="{{ $subproducto->id }}" {{ $existeSubproducto ? 'checked' : '' }}>
            <label>{{$subproducto->nombre}}</label>
            </fieldset>
        @endforeach
    @endforeach
    <br>
    <button type="submit">Modificar</button>
</form>
@endsection