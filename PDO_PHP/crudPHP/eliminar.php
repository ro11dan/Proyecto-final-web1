<?php
// eliminar.php - Elimina una cita de la base de datos
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM citas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':id' => $id])) {
        // Redirigir al listado con un mensaje de éxito
        header("Location: listar.php?mensaje=eliminado");
        exit;
    } else {
        echo "Error al eliminar la cita.";
    }
} else {
    echo "ID de cita no válido.";
}
?>
