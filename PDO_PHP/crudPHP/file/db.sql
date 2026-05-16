-- files/db.sql
-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS crud_pdo;
USE crud_pdo;

-- Crear la tabla de citas
CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_dueno VARCHAR(100) NOT NULL,
    nombre_mascota VARCHAR(100) NOT NULL,
    tipo_mascota VARCHAR(50) NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    motivo TEXT NOT NULL,
    estado ENUM('pendiente', 'atendida', 'cancelada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar algunos datos de ejemplo (opcional, pero útil para pruebas)
INSERT INTO citas (nombre_dueno, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo, estado) VALUES
('Ana López', 'Luna', 'Perro', CURDATE(), '10:00:00', 'Vacunación anual', 'pendiente'),
('Carlos Pérez', 'Milo', 'Gato', CURDATE(), '11:30:00', 'Revisión general', 'pendiente'),
('María García', 'Max', 'Perro', CURDATE() + INTERVAL 1 DAY, '09:00:00', 'Desparasitación', 'pendiente');
