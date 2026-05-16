<?php
$host = "127.0.0.1:3306";
$user = "root";
$password = "Aaron123";
$dbName = "crud_app";

$conn = new mysqli($host,$user,$password,$dbName);

if($conn->connect_error){
    echo "<h1>Error en conexion". $conn->connect_error;
}else{
    echo "<h1>conexion realizada</h1>";
}