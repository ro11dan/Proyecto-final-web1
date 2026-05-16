-- 1) Crear base de datos
CREATE DATABASE IF NOT EXISTS crud_pdo
 CHARACTER SET utf8mb4
 COLLATE utf8mb4_unicode_ci;

-- 2) Usar la base
USE crud_pdo;

-- 3) Crear tabla de citas veterinarias
CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_dueno VARCHAR(150) NOT NULL,
    nombre_mascota VARCHAR(100) NOT NULL,
    tipo_mascota ENUM('Perro', 'Gato', 'Ave', 'Roedor', 'Reptil', 'Otro') NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    motivo_consulta TEXT NOT NULL,
    estado ENUM('pendiente', 'atendida', 'cancelada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4) Insertar datos de prueba (opcional)
INSERT INTO citas (nombre_dueno, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo_consulta, estado) VALUES
('María López', 'Firulais', 'Perro', '2026-05-20', '10:00:00', 'Vacunación anual', 'pendiente'),
('Carlos Ramírez', 'Michi', 'Gato', '2026-05-21', '15:30:00', 'Revisión general', 'atendida'),
('Ana Torres', 'Piolín', 'Ave', '2026-05-22', '09:15:00', 'Corte de uñas', 'pendiente');
