<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Obtener la cita actual
$stmt = $pdo->prepare("SELECT * FROM citas WHERE id = :id");
$stmt->execute([':id' => $id]);
$cita = $stmt->fetch();

if (!$cita) {
    echo "<p style='text-align:center; padding:20px;'>Cita no encontrada. <a href='index.php'>Volver</a></p>";
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_dueno = trim($_POST['nombre_dueno'] ?? '');
    $nombre_mascota = trim($_POST['nombre_mascota'] ?? '');
    $tipo_mascota = $_POST['tipo_mascota'] ?? '';
    $fecha_cita = $_POST['fecha_cita'] ?? '';
    $hora_cita = $_POST['hora_cita'] ?? '';
    $motivo_consulta = trim($_POST['motivo_consulta'] ?? '');
    $estado = $_POST['estado'] ?? 'pendiente';

    if (!$nombre_dueno || !$nombre_mascota || !$tipo_mascota || !$fecha_cita || !$hora_cita || !$motivo_consulta) {
        $error = "Todos los campos marcados con * son obligatorios";
    } else {
        try {
            $sql = "UPDATE citas SET nombre_dueno = :nombre_dueno, nombre_mascota = :nombre_mascota, 
                    tipo_mascota = :tipo_mascota, fecha_cita = :fecha_cita, hora_cita = :hora_cita, 
                    motivo_consulta = :motivo_consulta, estado = :estado WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre_dueno' => $nombre_dueno,
                ':nombre_mascota' => $nombre_mascota,
                ':tipo_mascota' => $tipo_mascota,
                ':fecha_cita' => $fecha_cita,
                ':hora_cita' => $hora_cita,
                ':motivo_consulta' => $motivo_consulta,
                ':estado' => $estado,
                ':id' => $id
            ]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Error al actualizar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 Editar Cita Veterinaria</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #34495e; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; }
        textarea { min-height: 80px; resize: vertical; }
        .btn { display: inline-block; padding: 12px 25px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; font-size: 1em; margin: 5px 0; }
        .btn:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; }
        .btn-secondary:hover { background: #7f8c8d; }
        .error { background: #ffebee; color: #c62828; padding: 10px; border-radius: 5px; margin-bottom: 15px; border-left: 4px solid #c62828; }
        .required { color: #e74c3c; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐾 Editar Cita Veterinaria</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Nombre del Dueño <span class="required">*</span></label>
                <input type="text" name="nombre_dueno" value="<?= htmlspecialchars($cita['nombre_dueno']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Nombre de la Mascota <span class="required">*</span></label>
                <input type="text" name="nombre_mascota" value="<?= htmlspecialchars($cita['nombre_mascota']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tipo de Mascota <span class="required">*</span></label>
                <select name="tipo_mascota" required>
                    <option value="">-- Seleccionar --</option>
                    <?php foreach(['Perro','Gato','Ave','Roedor','Reptil','Otro'] as $tipo): ?>
                        <option value="<?= $tipo ?>" <?= $cita['tipo_mascota'] === $tipo ? 'selected' : '' ?>><?= $tipo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Fecha de la Cita <span class="required">*</span></label>
                <input type="date" name="fecha_cita" value="<?= htmlspecialchars($cita['fecha_cita']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Hora de la Cita <span class="required">*</span></label>
                <input type="time" name="hora_cita" value="<?= htmlspecialchars($cita['hora_cita']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Motivo de la Consulta <span class="required">*</span></label>
                <textarea name="motivo_consulta" required><?= htmlspecialchars($cita['motivo_consulta']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <?php foreach(['pendiente','atendida','cancelada'] as $est): ?>
                        <option value="<?= $est ?>" <?= $cita['estado'] === $est ? 'selected' : '' ?>><?= ucfirst($est) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn">💾 Actualizar Cita</button>
            <a href="index.php" class="btn btn-secondary">← Volver</a>
        </form>
    </div>
</body>
</html>
