<?php

/*if (mysqli_connect("localhost","root","","delivery")){
    echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario y clave</p>";
}else{
    echo "<p>MySQL no conoce ese usuario y password, y rechaza el intento de conexión</p>";
}

$consulta_idProducto = "SELECT idalimento FROM carrito";

mysqli_select_db($localhost, delivery);
$id_producto = mysqli_query($consulta_idProducto);

echo $id_producto;
*/

$conex = mysqli_connect("localhost", "lc43eqfj_webs", "Efi*pos*789", "lc43eqfj_delivery");


?>