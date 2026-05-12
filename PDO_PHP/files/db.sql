-- 1) Crear base de datos
CREATE DATABASE IF NOT EXISTS crud_pdo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- 2) Usar la base
USE crud_pdo;

-- 3) Crear tabla de ejemplo
CREATE TABLE IF NOT EXISTS alumnos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
