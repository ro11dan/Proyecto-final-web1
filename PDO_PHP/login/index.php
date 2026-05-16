<?php
include 'header.php';
?>

<form action="./Logica/ValidaLogin.php" method="post">
    <label for="">Nombre de usuario</label>
    <input type="text" name="user">
    <br>
    <label for="">Contraseña</label>
    <input type="password" name="pass">
    <br>
    <button type="submit">Iniciar sesión</button>
    <button type="reset">Limpiar</button>

</form>

<?php
include 'footer.php';
?>