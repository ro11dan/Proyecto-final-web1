-- Crear la base de datos
CREATE DATABASE crud_app;

-- Seleccionar la base de datos
USE crud_app;

-- crear un tabla
CREATE TABLE usuarios(
    id INT  AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL

);