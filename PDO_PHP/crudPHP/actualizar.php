<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email', telefono='$telefono' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente.";
        header("Location: listar.php");
        exit;
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }
} else {
    echo "Método no permitido.";
}