<?php
// editar.php - Muestra el formulario para editar una cita existente
include 'conexion.php';

$cita = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM citas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $cita = $stmt->fetch();
    
    if (!$cita) {
        die("Cita no encontrada.");
    }
} else {
    die("ID de cita no válido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita Veterinaria</title>
    <style>
        /* Estilos similares a index.php */
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Cita</h1>
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
            
            <div class="form-group">
                <label for="nombre_dueno">Nombre del Dueño</label>
                <input type="text" id="nombre_dueno" name="nombre_dueno" value="<?php echo htmlspecialchars($cita['nombre_dueno']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="nombre_mascota">Nombre de la Mascota</label>
                <input type="text" id="nombre_mascota" name="nombre_mascota" value="<?php echo htmlspecialchars($cita['nombre_mascota']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tipo_mascota">Tipo de Mascota</label>
                <input type="text" id="tipo_mascota" name="tipo_mascota" value="<?php echo htmlspecialchars($cita['tipo_mascota']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_cita">Fecha de la Cita</label>
                <input type="date" id="fecha_cita" name="fecha_cita" value="<?php echo htmlspecialchars($cita['fecha_cita']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="hora_cita">Hora de la Cita</label>
                <input type="time" id="hora_cita" name="hora_cita" value="<?php echo htmlspecialchars($cita['hora_cita']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="motivo">Motivo de la Consulta</label>
                <textarea id="motivo" name="motivo" rows="3" required><?php echo htmlspecialchars($cita['motivo']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="estado">Estado de la Cita</label>
                <select id="estado" name="estado">
                    <option value="pendiente" <?php echo $cita['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="atendida" <?php echo $cita['estado'] == 'atendida' ? 'selected' : ''; ?>>Atendida</option>
                    <option value="cancelada" <?php echo $cita['estado'] == 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                </select>
            </div>
            
            <button type="submit">Actualizar Cita</button>
        </form>
        <a href="listar.php">← Volver al listado</a>
    </div>
</body>
</html>
