<?php
require_once __DIR__ . '/../config/db.php';

// Consultar todas las citas
$sql = "SELECT * FROM citas ORDER BY fecha_cita ASC, hora_cita ASC";
$stmt = $pdo->query($sql);
$citas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 Gestión de Citas Veterinarias</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; margin-bottom: 20px; text-align: center; }
        .btn { display: inline-block; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; margin: 5px 0; }
        .btn:hover { background: #2980b9; }
        .btn-edit { background: #f39c12; }
        .btn-edit:hover { background: #d35400; }
        .btn-delete { background: #e74c3c; }
        .btn-delete:hover { background: #c0392b; }
        .btn-success { background: #27ae60; }
        .btn-success:hover { background: #219653; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #34495e; color: white; }
        tr:hover { background: #f1f1f1; }
        .estado { padding: 5px 10px; border-radius: 15px; font-size: 0.85em; font-weight: bold; }
        .estado.pendiente { background: #f39c12; color: white; }
        .estado.atendida { background: #27ae60; color: white; }
        .estado.cancelada { background: #e74c3c; color: white; }
        .actions { display: flex; gap: 5px; }
        @media (max-width: 768px) {
            table { font-size: 0.9em; }
            th, td { padding: 8px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐾 Gestión de Citas Veterinarias</h1>
        <a href="create.php" class="btn">+ Nueva Cita</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dueño</th>
                    <th>Mascota</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($citas)): ?>
                    <tr><td colspan="9" style="text-align:center;">No hay citas registradas</td></tr>
                <?php else: ?>
                    <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?= htmlspecialchars($cita['id']) ?></td>
                        <td><?= htmlspecialchars($cita['nombre_dueno']) ?></td>
                        <td><?= htmlspecialchars($cita['nombre_mascota']) ?></td>
                        <td><?= htmlspecialchars($cita['tipo_mascota']) ?></td>
                        <td><?= date('d/m/Y', strtotime($cita['fecha_cita'])) ?></td>
                        <td><?= date('H:i', strtotime($cita['hora_cita'])) ?></td>
                        <td><?= htmlspecialchars($cita['motivo_consulta']) ?></td>
                        <td><span class="estado <?= $cita['estado'] ?>"><?= ucfirst($cita['estado']) ?></span></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $cita['id'] ?>" class="btn btn-edit">✏️</a>
                            <a href="delete.php?id=<?= $cita['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar esta cita?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
