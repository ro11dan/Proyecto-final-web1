<?php
$host = getenv('DB_HOST') ?: 'db';
$dbname = getenv('DB_NAME') ?: 'crud_pdo';
$username = getenv('DB_USER') ?: 'crud_user';
$password = getenv('DB_PASSWORD') ?: 'crud_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // En un entorno de producción, sería mejor loguear el error en lugar de mostrarlo
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}
?>
