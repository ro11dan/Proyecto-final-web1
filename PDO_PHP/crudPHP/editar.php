<?php
    include 'conexion.php';

    if(isset($_GET['id'])) {

        $id = $_GET['id'];
        
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['nombre'];
            $email = $row['email'];
            $telefono = $row['telefono'];
            // echo "Usuario encontrado: $nombre, $email, $telefono";
        } else {
            echo "Usuario no encontrado.";
            exit;
        }
    } else {
        echo "ID de usuario no proporcionado.";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="<?php echo $row['apellido']; ?>" required><br><br>

        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br><br>
        
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required><br><br>
        
        <button type="submit">Actualizar</button>

</body>
</html>