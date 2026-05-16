<?php
/** Configuracion general del proyecto */
// Configuracion general del proyecto
// Aqui almacenamos las variables de configuracion del proyecto
// Esto evita que tengamos que modificar el codigo fuente para cambiar la configuracion
// y poner las credenciales directamente en el codigo fuente, lo que es una mala practica de seguridad

return[
<<<<<<< HEAD
    "DB_HOST" => getenv("DB_HOST") ?: "localhost:3306",
=======
    "DB_HOST" => getenv("DB_HOST") ?: "localhost",
    "DB_PORT" => getenv("DB_PORT") ?: "3306",
>>>>>>> d8e9aa004f8b8f856a8e4524a8e68a9393210ce5
    "DB_NAME" => getenv("DB_NAME") ?: "crud_pdo",
    "DB_USER" => getenv("DB_USER") ?: "root",
    "DB_PASSWORD" => getenv("DB_PASSWORD") ?: "Aaron123",
    "DB_CHARSET" => getenv("DB_CHARSET") ?: "utf8mb4",
];