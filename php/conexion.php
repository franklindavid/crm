<?php
$conexion=mysqli_connect("localhost","root","","hotel");
if (mysqli_connect_errno($conexion)) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
}
?>