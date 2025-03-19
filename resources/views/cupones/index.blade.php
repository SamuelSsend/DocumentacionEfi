@extends('layouts.admin2')
@section('contenido')

<div class="container">
    <br>
    <h2>Cupones Activos</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($cupones->isEmpty())
        <div class="alert alert-warning">
            No hay cupones activos en este momento.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Canjeos</th>
                    <th>Número de Canjeos Max</th>
                    <th>Precio Mínimo</th>
                    <th>Tipo de Descuento</th>
                    <th>Descuento</th>
                    <!-- <th>Categoría</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cupones as $cupon)
                    <tr>
                        <td>{{ $cupon->nombre }}</td>
                        <td>{{ $cupon->codigo }}</td>
                        <td>{{ $cupon->fecha_inicio }}</td>
                        <td>{{ $cupon->fecha_fin }}</td>
                        <td>{{ $cupon->num_canjeos}}</td>
                        <td>{{ $cupon->canjeos_max?$cupon->canjeos_max: '∞' }}</td>
                        <td>{{ $cupon->precio_minimo }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $cupon->tipo_descuento)) }}</td>
                        <td>{{ $cupon->descuento }}</td>
                        <!-- <td>{{ $cupon->categoria }}</td> -->
                        <td>
                            <form action="{{ route('cupones.destroy', $cupon->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cupón?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
