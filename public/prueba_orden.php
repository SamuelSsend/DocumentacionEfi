<?php


//constantes
const nombre = 'efipos';
const tipo = '23';
const moneda = 'EUR';

$orden = rand(1000, 10000);


//generamos la consulta
$server = "localhost";
$user = "efiposdelivery";
$pass = "efi*dev*789";
$bd = "delivery";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass, $bd)
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT idalimento, producto, cantidad, precio FROM carrito";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) { die();
}

$productos = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $idproducto = $row['idalimento'];
    $nombreproducto = $row['producto'];
    $cantidad = $row['cantidad'];
    $preciounitario = $row['precio'];
    

    $productos[] = array('idproducto'=> $idproducto, 'nombre'=> $nombreproducto, 'cantidad'=> $cantidad, 'preciounitario'=> $preciounitario);

} 
//Creamos el JSON
$productos_carrito = json_encode($productos);
echo $productos_carrito;

// if ($inc){
//     $consulta_carrito = "SELECT direccion, total_pagado FROM pedidos";
//     $resultado_carrito = mysqli_query($conex, $consulta_carrito);
//     if ($resultado_carrito) {
//         while($row = $resultado_carrito->fetch_array()){
//             $direccion = $row['direccion'];
//             $total = $row['total_pagado'];
//         }
//     }
// }


if ($conexion) {
    $consulta_carrito = "SELECT name, direccion FROM users";
    $resultado_carrito = mysqli_query($conexion, $consulta_carrito);
    if ($resultado_carrito) {
        while($row = $resultado_carrito->fetch_array()){
            $nombrecliente = $row['name'];
            $direccion = $row['direccion'];
        }
    }
}


$data = Array (
    
    "servicio" => [
        "nombre" => nombre,                               //Nombre del servicio (siempre será "efipos")
        "orden" => $orden,                                //Numero del pedido
        "tipo" => tipo,
        "codigopedido" => $orden                             //Nº de identificación del servicio (siempre será 23)
        ],
    "fecha" => date("Y-m-d\TH:i:s.z"),                    //Fecha del pedido
    "moneda" => moneda,                                   //Moneda del pago (constante)
    "total" => "14.50",//$total,                          //Total de la cuenta
    "productos" => $productos,                            //Productos del pedido
    "direccion" => $direccion, //Dirección de envio
    "cliente" => [
            "nombre" => $nombrecliente,                    //Productos del pedido
            "nif" => ""
    ],
    "comentariocliente" => "",
    "pagos" => [
            "importe" => "14.50"                            //$importe
    ],
    "estado" => "ACEPTED"

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

// //Borrar carrito

$link = mysqli_connect("localhost", "efiposdelivery", "efi*dev*789");

mysqli_select_db($link, "delivery");

mysqli_query($link, "DELETE FROM carrito WHERE iduser = 10");

mysqli_close($link); // Cerramos la conexion con la base de datos

echo 'Se ha destruido el carrito';

?>
