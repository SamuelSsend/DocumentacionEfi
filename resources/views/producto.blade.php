@extends('layouts.user')

@section('user')
    <h3>Subproductos a elegir:</h3>
    <form action="{{route('add_cart_subproductos',['idalimento'=>$producto->id])}}" method="POST">
        @csrf
        @foreach ($combinados as $combinado)
            @foreach ($combinado->subproductos as $subproducto)
                <fieldset>
                    
                <input type="checkbox" name="subproductos[]" value="{{ $subproducto->id }}" >
                <label>{{$subproducto->nombre}}</label>
                </fieldset>
            @endforeach
        @endforeach
        <br>
        <button type="submit">Agregar al carrito</button>
    </form>
@endsection