<?php 
session_start();
include "conexion.php";
$usuario = $_POST['user'];
$password = $_POST['pass'];

$consulta = "SELECT COUNT(*) as contar FROM usuarios WHERE user='$usuario' AND password='$password'";
$ejecutar = mysqli_query($conn, $consulta);
$array = mysqli_fetch_array($ejecutar);

if($array['contar'] > 0){
    $_SESSION['usuario'] = $usuario;
    header("location: ../dashboard.php");
}else{  
    echo "Usuario o contraseña incorrecta";
}
?>