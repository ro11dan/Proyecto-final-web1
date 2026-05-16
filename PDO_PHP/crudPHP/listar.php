<?php
// listar.php - Muestra todas las citas registradas
include 'conexion.php';

// Consulta para obtener todas las citas, ordenadas por fecha y hora
$sql = "SELECT * FROM citas ORDER BY fecha_cita DESC, hora_cita ASC";
$stmt = $pdo->query($sql);
$citas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Citas Veterinarias</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f5f5f5; }
        .acciones a { margin-right: 10px; text-decoration: none; padding: 4px 8px; border-radius: 4px; }
        .editar { background-color: #007bff; color: white; }
        .eliminar { background-color: #dc3545; color: white; }
        .nuevo { display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; }
        .estado-pendiente { color: #ffc107; font-weight: bold; }
        .estado-atendida { color: #28a745; font-weight: bold; }
        .estado-cancelada { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Listado de Citas</h1>
    <a href="index.php" class="nuevo">+ Nueva Cita</a>
    
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
                <tr>
                    <td colspan="9">No hay citas registradas.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cita['id']); ?></td>
                        <td><?php echo htmlspecialchars($cita['nombre_dueno']); ?></td>
                        <td><?php echo htmlspecialchars($cita['nombre_mascota']); ?></td>
                        <td><?php echo htmlspecialchars($cita['tipo_mascota']); ?></td>
                        <td><?php echo htmlspecialchars($cita['fecha_cita']); ?></td>
                        <td><?php echo htmlspecialchars($cita['hora_cita']); ?></td>
                        <td><?php echo htmlspecialchars($cita['motivo']); ?></td>
                        <td class="estado-<?php echo htmlspecialchars($cita['estado']); ?>"><?php echo ucfirst(htmlspecialchars($cita['estado'])); ?></td>
                        <td class="acciones">
                            <a href="editar.php?id=<?php echo $cita['id']; ?>" class="editar">Editar</a>
                            <a href="eliminar.php?id=<?php echo $cita['id']; ?>" class="eliminar" onclick="return confirm('¿Estás seguro de eliminar esta cita?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
