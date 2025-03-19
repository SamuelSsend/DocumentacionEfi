<?php

//constantes
const nombre = 'efipos';
const tipo = '23';
const moneda = 'EUR';

//Extracción de pedido desde la base de datos

$inc = include "conexion_db.php";
$codigo_pedido = "";

if ($inc) {
    $consulta_carrito = "SELECT id, idalimento, producto, cantidad, precio, iduser, estado FROM carrito";
    $resultado_carrito = mysqli_query($conex, $consulta_carrito);
    if ($resultado_carrito) {
        while($row = $resultado_carrito->fetch_array()){
            $orden = $row['id'];
            $idproducto = $row['idalimento'];
            $nombreproducto = $row['producto'];
            $cantidad = $row['cantidad'];
            $preciounitario = $row['precio'];
            $iduser = $row['iduser'];
            $estado = $row['estado'];
        }
    }
}    

if ($inc) {
    $consulta_carrito = "SELECT direccion, total_pagado FROM pedidos";
    $resultado_carrito = mysqli_query($conex, $consulta_carrito);
    if ($resultado_carrito) {
        while($row = $resultado_carrito->fetch_array()){
            $direccion = $row['direccion'];
            $total = $row['total_pagado'];
        }
    }
}

if ($inc) {
    $consulta_carrito = "SELECT name FROM users";
    $resultado_carrito = mysqli_query($conex, $consulta_carrito);
    if ($resultado_carrito) {
        while($row = $resultado_carrito->fetch_array()){
            $nombrecliente = $row['name'];
        }
    }
}



$codigo_pedido = '';
$nombrecliente = 'Juan Sastre';
$nif = '';
$comentariocliente = '';
$importe = $total;
$estado = 'ACEPTED';
$comentarioscocina = [];


$data = Array (
    
    "servicio" => [
        "nombre" => nombre,                               //Nombre del servicio (siempre será "efipos")
        "orden" => $orden,                                //Numero del pedido
        "tipo" => tipo,
        "codigopedido" => "5"                             //Nº de identificación del servicio (siempre será 23)
        ],
    "fecha" => date("Y-m-d\TH:i:s.z"),                    //Fecha del pedido
    "moneda" => moneda,                                   //Moneda del pago (constante)
    "total" => $total,                                    //Total de la cuenta
    "productos" => Array (Array(                          //Productos del pedido
                "idproducto" => $idproducto,
                "nombre" => $nombreproducto,
                "cantidad" => $cantidad,
                "preciounitario" => $preciounitario,
                "comentarioscocina" => $comentarioscocina,
                "subproductos" => []
    )
    ),
    "direccion" => $direccion, //Dirección de envio
    "cliente" => [
            "nombre" => $nombrecliente,                    //Productos del pedido
            "nif" => $nif
    ],
    "comentariocliente" => $comentariocliente,
    "pagos" => [
            "importe" => $importe                          //Importe a pagar
    ],
    "estado" => $estado

    )
;

//Guardar archivo .json
$orden = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents("order.json", $orden);

//url-ify the data for the POST
//$fields_string = http_build_query($orden);

$curl = curl_init();

curl_setopt_array(
    $curl, array(
    CURLOPT_URL => 'http://46.183.119.158:20200/api/Orden',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $orden
    ,
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'IDLocal: 1143',
    'Authorization: Bearer HjtBBUCxd6mNkxApKo3GNXyPdLMFbF35wJ6pt_Q-FDrv2-Ubl2551Sdz_NseNb81q8p97usjLagA63WFaKw4nxxlr2gcBozU119HGvysts0q09XLcI4pjlHUWWFO0yUG3hDfNmaCYfDeridsdZvJGngxKxAAgb20NL-BRaFroZVgcer9sbaj-mt9OkSGYj3WpAV5_3P37ylGNqZuxItgHekb669gvpugxg3cYdTuS0oE_9HDRmd-zOVd-lyBgK3A_ZO7rW-PmDRFqWxhusuFJdbHJNtAyjGUpuPDsA1w-h6_cghOejzfh87M87czU-3sLvqKRUFgAj_3P0H3QElJVFFI-ULkzxG4yiXRA4hgXI2LQbEPR1ishGx_vjfZ3Xm8tFgpBLhUr4nDINdzu8XRUxoEvNCVOUbCaK1IwLb7saPlluQAiJ8ZdzN57qarpw9-0YooeaxgVACinyPYQuuIJvct9mk7DKpJHOvbZMZH1og'
    ),
    )
);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
