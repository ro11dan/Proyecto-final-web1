<?php
session_start();
echo "Bienvenido " . $_SESSION["usuario"];
echo "<br>";
echo "Tu contraseña es: " . $_SESSION["password"];
