<?php
// actualizar.php - Procesa la actualización de una cita
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre_dueno = trim($_POST['nombre_dueno']);
    $nombre_mascota = trim($_POST['nombre_mascota']);
    $tipo_mascota = trim($_POST['tipo_mascota']);
    $fecha_cita = $_POST['fecha_cita'];
    $hora_cita = $_POST['hora_cita'];
    $motivo = trim($_POST['motivo']);
    $estado = $_POST['estado'];
    
    $sql = "UPDATE citas SET 
                nombre_dueno = :nombre_dueno,
                nombre_mascota = :nombre_mascota,
                tipo_mascota = :tipo_mascota,
                fecha_cita = :fecha_cita,
                hora_cita = :hora_cita,
                motivo = :motivo,
                estado = :estado
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':id' => $id,
        ':nombre_dueno' => $nombre_dueno,
        ':nombre_mascota' => $nombre_mascota,
        ':tipo_mascota' => $tipo_mascota,
        ':fecha_cita' => $fecha_cita,
        ':hora_cita' => $hora_cita,
        ':motivo' => $motivo,
        ':estado' => $estado
    ])) {
        header("Location: listar.php?mensaje=actualizado");
        exit;
    } else {
        echo "Error al actualizar la cita.";
    }
} else {
    echo "Método no permitido.";
}
?>
