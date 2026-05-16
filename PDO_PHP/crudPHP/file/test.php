<?php
    include 'conexion.php';
    $sql = "SELECT nombre FROM usuarios";
    
    $result = $conn->query($sql);
    // echo $result;


    while($row = $result->fetch_assoc()){
        echo "<br>".$row['nombre'];
        echo "<br>".$row['email'];
        echo "<br>".$row['telefono'];
    }
?>