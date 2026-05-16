<?php
/** Configuracion general del proyecto */
// Configuracion general del proyecto
// Aqui almacenamos las variables de configuracion del proyecto
// Esto evita que tengamos que modificar el codigo fuente para cambiar la configuracion
// y poner las credenciales directamente en el codigo fuente, lo que es una mala practica de seguridad

return[
    "DB_HOST" => "localhost:3306",
    "DB_NAME" => "crud_pdo",
    "DB_USER" => "root",
    "DB_PASSWORD" => "Aaron123",
    "DB_CHARSET" => "utf8mb4",
];