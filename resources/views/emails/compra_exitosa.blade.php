<!DOCTYPE html>
<html>
<head>
    <title>Pedido Enviado</title>
</head>
<body>
    <h1>Gracias por tu compra, {{ $customerName }}!</h1>
    <p>Tu pedido número {{ $orderNumber }} ha sido generado con éxito.</p>
    <p>Detalles del pedido:</p>
    <ul>
        @foreach ($orderItems as $item)
            <li>{{ $item['nombre'] }} - Cantidad: {{ $item['cantidad'] }} - Precio unitario: {{ $item['preciounitario'] }}€</li>
            @if (!empty($item['comentarioscocina']))
                <ul>
                    @foreach ($item['comentarioscocina'] as $comentario)
                        <li>Comentario: {{ $comentario['descripcion'] }}</li>
                    @endforeach
                </ul>
            @endif
            @if (!empty($item['subproductos']))
                <ul>
                    @foreach ($item['subproductos'] as $subitem)
                        <li>{{ $subitem['nombre'] }} - Precio: {{ $subitem['preciounitario'] }}€</li>
                        @if(!empty($subitem['Subproductos']))
                            <ul>
                                @foreach($subitem['Subproductos'] as $segundoNivel)
                                    <li>{{$segundoNivel['nombre']}} - Precio: {{$segundoNivel['preciounitario']}}€</li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            @endif
        @endforeach
    </ul>
    <ul>
    @foreach($cupones as $cupon)
        @if($cupon->tipo_descuento === 'envio_gratis')
            <li>Cupon: {{ $cupon->nombre }} - envío gratis</li>
        @else
            <li>Cupon: {{ $cupon->nombre }} - Descuento: {{ $cupon->descuento_aplicado }}€</li>
        @endif
    @endforeach
    </ul>
    <p>Total pagado: {{ $totalPaid }}€</p>
    @if($deliveryAddress !== "RECOGIDA")
        <p>Dirección de entrega: {{ $deliveryAddress }}</p>
    @else
        <p>Recoger en restaurante</p>
    @endif
    <p>Visítanos en: <a href="{{ $appUrl }}">{{ $appUrl }}</a></p>
    <p>Este es un correo electrónico automatizado, por favor no responda a este mensaje.</p>
    <p>Gracias por confiar en nosotros.</p>
</body>
</html>