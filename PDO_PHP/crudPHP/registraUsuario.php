<?php
include ('conexion.php');
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$telefono = $_GET['telefono'];
$apellido = $_GET['apellido'];

// echo $nombre,$correo,$telefono;
$sql = "INSERT INTO usuarios (Nombre,email,telefono,apellido)VALUES('$nombre','$correo','$telefono','$apellido')";


if($conn->query($sql) === TRUE){
    header( 'Location: index.php');
    exit();
}else{
    echo "Error: ".$sql;
}
