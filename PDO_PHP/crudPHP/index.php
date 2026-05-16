<?php
// index.php - Formulario para registrar una nueva cita
include 'conexion.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y limpiar datos del formulario
    $nombre_dueno = trim($_POST['nombre_dueno']);
    $nombre_mascota = trim($_POST['nombre_mascota']);
    $tipo_mascota = trim($_POST['tipo_mascota']);
    $fecha_cita = $_POST['fecha_cita'];
    $hora_cita = $_POST['hora_cita'];
    $motivo = trim($_POST['motivo']);
    $estado = $_POST['estado'];

    // Validar que los campos obligatorios no estén vacíos
    if (empty($nombre_dueno) || empty($nombre_mascota) || empty($tipo_mascota) || empty($fecha_cita) || empty($hora_cita) || empty($motivo)) {
        $mensaje = "Por favor, completa todos los campos obligatorios.";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO citas (nombre_dueno, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo, estado) 
                VALUES (:nombre_dueno, :nombre_mascota, :tipo_mascota, :fecha_cita, :hora_cita, :motivo, :estado)";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la consulta con los valores
        if ($stmt->execute([
            ':nombre_dueno' => $nombre_dueno,
            ':nombre_mascota' => $nombre_mascota,
            ':tipo_mascota' => $tipo_mascota,
            ':fecha_cita' => $fecha_cita,
            ':hora_cita' => $hora_cita,
            ':motivo' => $motivo,
            ':estado' => $estado
        ])) {
            $mensaje = "Cita registrada exitosamente.";
            // Limpiar el formulario después de un registro exitoso (opcional)
            // $_POST = array();
        } else {
            $mensaje = "Error al registrar la cita.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cita Veterinaria</title>
    <style>
        /* Estilos básicos para el formulario */
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .mensaje { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Nueva Cita</h1>
        
        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo strpos($mensaje, 'exitosamente') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre_dueno">Nombre del Dueño *</label>
                <input type="text" id="nombre_dueno" name="nombre_dueno" value="<?php echo isset($_POST['nombre_dueno']) ? htmlspecialchars($_POST['nombre_dueno']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="nombre_mascota">Nombre de la Mascota *</label>
                <input type="text" id="nombre_mascota" name="nombre_mascota" value="<?php echo isset($_POST['nombre_mascota']) ? htmlspecialchars($_POST['nombre_mascota']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tipo_mascota">Tipo de Mascota *</label>
                <input type="text" id="tipo_mascota" name="tipo_mascota" value="<?php echo isset($_POST['tipo_mascota']) ? htmlspecialchars($_POST['tipo_mascota']) : ''; ?>" placeholder="Ej. Perro, Gato, Conejo..." required>
            </div>
            
            <div class="form-group">
                <label for="fecha_cita">Fecha de la Cita *</label>
                <input type="date" id="fecha_cita" name="fecha_cita" value="<?php echo isset($_POST['fecha_cita']) ? htmlspecialchars($_POST['fecha_cita']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="hora_cita">Hora de la Cita *</label>
                <input type="time" id="hora_cita" name="hora_cita" value="<?php echo isset($_POST['hora_cita']) ? htmlspecialchars($_POST['hora_cita']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="motivo">Motivo de la Consulta *</label>
                <textarea id="motivo" name="motivo" rows="3" required><?php echo isset($_POST['motivo']) ? htmlspecialchars($_POST['motivo']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="estado">Estado de la Cita</label>
                <select id="estado" name="estado">
                    <option value="pendiente" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="atendida" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'atendida') ? 'selected' : ''; ?>>Atendida</option>
                    <option value="cancelada" <?php echo (isset($_POST['estado']) && $_POST['estado'] == 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                </select>
            </div>
            
            <button type="submit">Registrar Cita</button>
        </form>
        <a href="listar.php">Ver lista de citas</a>
    </div>
</body>
</html>
