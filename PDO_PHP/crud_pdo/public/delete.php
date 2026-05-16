<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM citas WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        // En producción, registrar el error en log en lugar de mostrarlo
        error_log("Error al eliminar cita: " . $e->getMessage());
    }
}

header("Location: index.php");
exit();
?>
