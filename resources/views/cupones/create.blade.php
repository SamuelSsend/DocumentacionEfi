@extends('layouts.admin2')
@section('contenido')
<div class="container">
    <br>
    <h2>Crear Cupón</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('cupones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Cupón</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div class="form-group">
            <label for="codigo">Código del Cupón</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
        </div>
        <div class="form-group">
            <label for="canjeos_max">Número de Canjeos</label>
            <input type="number" class="form-control" id="canjeos_max" name="canjeos_max" value="{{ old('canjeos_max') }}">
        </div>
        <div class="form-group">
            <label for="precio_minimo">Precio Mínimo del Carrito</label>
            <input type="number" class="form-control" id="precio_minimo" name="precio_minimo" value="{{ old('precio_minimo') }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_descuento">Tipo de Descuento</label>
            <select class="form-control" id="tipo_descuento" name="tipo_descuento" required>
                <option value="porcentaje">Porcentaje</option>
                <option value="envio_gratis">Envío Gratis</option>
                <option value="importe_fijo">Importe Fijo</option>
            </select>
        </div>
        <div class="form-group" id="descuento_group">
            <label for="descuento" id="descuento_label">Descuento (%)</label>
            <input type="number" class="form-control" id="descuento" name="descuento" value="{{ old('descuento') }}" step=".01">
        </div>
        <button type="submit" class="btn btn-primary">Crear Cupón</button>
    </form>
</div>

<script>
    document.getElementById('tipo_descuento').addEventListener('change', function () {
        var descuentoGroup = document.getElementById('descuento_group');
        var descuentoLabel = document.getElementById('descuento_label');
        if (this.value === 'porcentaje') {
            descuentoLabel.textContent = "Descuento (%)";
            descuentoGroup.style.display = 'block';
        } else if (this.value === 'importe_fijo') {
            descuentoLabel.textContent = "Descuento (Importe Fijo)";
            descuentoGroup.style.display = 'block';
        } else {
            descuentoGroup.style.display = 'none';
        }
    });
</script>
@endsection
