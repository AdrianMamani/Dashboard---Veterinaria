CREATE DATABASE veterinaria;
USE veterinaria;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password TEXT,
    cargo VARCHAR(50),
    fyh_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fyh_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE mascotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raza VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    id_usuario INT,  -- Relación con el usuario
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)  -- Relación con la tabla usuarios
);
-- Agregrar dos columnas a la tabla mascotas
ALTER TABLE mascotas ADD COLUMN nivel_alimentacion INT DEFAULT 100;
ALTER TABLE mascotas ADD COLUMN nivel_paseo INT DEFAULT 0;

-- insertamos datos de usuario y de mascota (cada mascota se le debe asignar el id_usuario que corresponda)
INSERT INTO usuarios (nombre_completo, email, password, cargo) VALUES ('Adrian Mamani', 'adrian@gmail.com', '121830', 'usuario');
INSERT INTO usuarios (nombre_completo, email, password, cargo) VALUES ('Sebastian Carcausto', 'sebastian@gmail.com', '121830', 'usuario');
INSERT INTO mascotas (nombre, especie, raza, edad, id_usuario) VALUES
('Firulais', 'Perro', 'Labrador', 3, 1),
('Michi', 'Gato', 'Siames', 2, 2),
('Goldie', 'Pez', 'Goldfish', 1, 1),
('Pelusa', 'Conejo', 'Holland Lop', 1, 2),
('Max', 'Perro', 'Pastor Alemán', 4, 1),
('Milo', 'Gato', 'Persa', 3, 2),
('Dory', 'Pez', 'Dory', 2, 1),
('Bunny', 'Conejo', 'Mini Rex', 2, 2),
('Rocky', 'Perro', 'Bulldog Francés', 5, 1),
('Socks', 'Gato', 'Maine Coon', 4, 2),
('Nemo', 'Pez', 'Clownfish', 1, 1),
('Coco', 'Conejo', 'Himalayo', 3, 2),
('Toby', 'Perro', 'Beagle', 2, 1),
('Luna', 'Gato', 'Bengal', 1, 2),
('Floyd', 'Pez', 'Betta', 1, 1),
('Zeus', 'Perro', 'Rottweiler', 4, 2),
('Bella', 'Gato', 'Sphynx', 2, 1),
('Cleo', 'Pez', 'Guppy', 1, 2),
('Harley', 'Conejo', 'Himalayo', 3, 1),
('Michi', 'Gato', 'Siames', 2, 1),
('Luna', 'Gato', 'Bengal', 3, 1),
('Socks', 'Gato', 'Maine Coon', 4, 1),
('Bella', 'Gato', 'Sphynx', 1, 1),
('Nina', 'Gato', 'Persa', 2, 1),
('Toby', 'Gato', 'Ragdoll', 3, 1),
('Max', 'Perro', 'Labrador', 5, 2),
('Rocky', 'Perro', 'Pastor Alemán', 4, 2),
('Zeus', 'Perro', 'Beagle', 2, 2),
('Nemo', 'Pez', 'Clownfish', 1, 2),
('Dory', 'Pez', 'Goldfish', 2, 2);
--
SELECT * FROM mascotas;


