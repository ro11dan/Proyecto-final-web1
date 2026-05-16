<?php
$host = "localhost:3306";
$user = "root";
$password = "Aaron123";
$database = "crud_app";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>