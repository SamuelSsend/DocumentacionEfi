<?php
/*
if (mysqli_connect("localhost","root","")){
    $con = mysqli_connect("localhost", "root", "");
    echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario y clave</p>";


$baseDatos = "localhost";
$consulta_idProducto = "SELECT * FROM carrito";

mysqli_select_db($con, 'efipos_delivery');
$datos = mysqli_query($consulta_idProducto);


while ($fila = mysql_fetch_array($datos)){
echo "<p>";
echo "-"; //un separador
echo $fila ("idAlimento");
echo "-"; // un separador
echo $fila ("iduser");
echo "-"; // un separador
echo $fila ("producto");
echo "<p>";
echo $fila ("createAt");
echo "<p>";
echo $fila ("estado");
echo "<p>";
echo $fila ("cantidad");
echo "<p>";
echo $fila ("precio");
echo "<p>";
}

}else{
    echo "<p>MySQL no conoce ese usuario y password, y rechaza el intento de conexión</p>";
}

*/

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    echo "<p>MySQL no conoce ese usuario y password, y rechaza el intento de conexión</p>";
    exit();
}

echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario y clave</p>";

mysqli_select_db($con, 'efipos_delivery');
$consulta_idProducto = "SELECT * FROM carrito";
$datos = mysqli_query($con, $consulta_idProducto);

while ($fila = mysqli_fetch_array($datos)) {
    echo "<p>";
    echo "-"; //un separador
    echo $fila["idalimento"];
    echo "-"; // un separador
    echo $fila["iduser"];
    echo "-"; // un separador
    echo $fila["producto"];
    echo "<p>";
    echo $fila["createAt"];
    echo "<p>";
    echo $fila["estado"];
    echo "<p>";
    echo $fila["cantidad"];
    echo "<p>";
    echo $fila["precio"];
    echo "<p>";
}

mysqli_close($con);


?>