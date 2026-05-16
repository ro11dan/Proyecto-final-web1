<?php
require_once __DIR__ . '/../config/db.php';

$error = '';
$success = '';

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
            $sql = "INSERT INTO citas (nombre_dueno, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo_consulta, estado) 
                    VALUES (:nombre_dueno, :nombre_mascota, :tipo_mascota, :fecha_cita, :hora_cita, :motivo_consulta, :estado)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre_dueno' => $nombre_dueno,
                ':nombre_mascota' => $nombre_mascota,
                ':tipo_mascota' => $tipo_mascota,
                ':fecha_cita' => $fecha_cita,
                ':hora_cita' => $hora_cita,
                ':motivo_consulta' => $motivo_consulta,
                ':estado' => $estado
            ]);
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            $error = "Error al crear la cita: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 Nueva Cita Veterinaria</title>
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
        <h1>🐾 Nueva Cita Veterinaria</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Nombre del Dueño <span class="required">*</span></label>
                <input type="text" name="nombre_dueno" value="<?= htmlspecialchars($_POST['nombre_dueno'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label>Nombre de la Mascota <span class="required">*</span></label>
                <input type="text" name="nombre_mascota" value="<?= htmlspecialchars($_POST['nombre_mascota'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tipo de Mascota <span class="required">*</span></label>
                <select name="tipo_mascota" required>
                    <option value="">-- Seleccionar --</option>
                    <option value="Perro" <?= ($_POST['tipo_mascota'] ?? '') === 'Perro' ? 'selected' : '' ?>>Perro</option>
                    <option value="Gato" <?= ($_POST['tipo_mascota'] ?? '') === 'Gato' ? 'selected' : '' ?>>Gato</option>
                    <option value="Ave" <?= ($_POST['tipo_mascota'] ?? '') === 'Ave' ? 'selected' : '' ?>>Ave</option>
                    <option value="Roedor" <?= ($_POST['tipo_mascota'] ?? '') === 'Roedor' ? 'selected' : '' ?>>Roedor</option>
                    <option value="Reptil" <?= ($_POST['tipo_mascota'] ?? '') === 'Reptil' ? 'selected' : '' ?>>Reptil</option>
                    <option value="Otro" <?= ($_POST['tipo_mascota'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Fecha de la Cita <span class="required">*</span></label>
                <input type="date" name="fecha_cita" value="<?= htmlspecialchars($_POST['fecha_cita'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label>Hora de la Cita <span class="required">*</span></label>
                <input type="time" name="hora_cita" value="<?= htmlspecialchars($_POST['hora_cita'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label>Motivo de la Consulta <span class="required">*</span></label>
                <textarea name="motivo_consulta" required><?= htmlspecialchars($_POST['motivo_consulta'] ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="pendiente" <?= ($_POST['estado'] ?? '') === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="atendida" <?= ($_POST['estado'] ?? '') === 'atendida' ? 'selected' : '' ?>>Atendida</option>
                    <option value="cancelada" <?= ($_POST['estado'] ?? '') === 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
                </select>
            </div>
            
            <button type="submit" class="btn">💾 Guardar Cita</button>
            <a href="index.php" class="btn btn-secondary">← Volver</a>
        </form>
    </div>
</body>
</html>
