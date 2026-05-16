<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registro usuarios</h1>
    <a href="listar.php">Ver usuarios</a>
    <form action="registraUsuario.php" method="get">
        <label for="">Nombre</label>
            <input type="text" name="nombre" id="">
        
        <br>    
        <label for="">Apellido</label>
            <input type="text" name="apellido" id="">    
        <br>    
        <label for="">Correo</label>
            <input type="email" name="correo" id="">
        <br>
        <label for="">Telefono</label>
            <input type="text" name="telefono" id="">
        <br>
        <button type="submit">Enviar registro</button>
    </form>
</body>
</html>