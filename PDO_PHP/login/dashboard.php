<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0    ">
    <title>Dashboard</title>
</head> 
<body>
    <h1>Bienvenido al Dashboard</h1>
    <p>Usuario: <?php echo $_SESSION['usuario']; ?></p>
    <a href="Logica/logout.php">Cerrar sesión</a>
</body>                