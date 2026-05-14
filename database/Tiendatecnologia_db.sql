CREATE DATABASE IF NOT EXISTS Tiendatecnologia_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE Tiendatecnologia_db;

DROP DATABASE tienda_tecnologia_db;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS pagos;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS cotizaciones;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS proveedores;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuario;

SET FOREIGN_KEY_CHECKS = 1;

-- =========================
-- TABLA USUARIO
-- =========================
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(120) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    rol VARCHAR(50) NOT NULL DEFAULT 'Administrador',
    estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- TABLA CLIENTES
-- =========================
CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(30) NOT NULL,
    correo VARCHAR(120),
    direccion VARCHAR(180),
    estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- TABLA CATEGORIAS
-- =========================
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- TABLA PROVEEDORES
-- =========================
CREATE TABLE proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    razon_social VARCHAR(120) NOT NULL,
    ruc VARCHAR(20),
    telefono VARCHAR(30),
    correo VARCHAR(120),
    direccion VARCHAR(180),
    estado ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================
-- TABLA PRODUCTOS
-- =========================
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    id_proveedor INT NULL,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    imagen VARCHAR(255),
    estado ENUM('Disponible','Agotado','Inactivo') NOT NULL DEFAULT 'Disponible',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_producto_categoria 
        FOREIGN KEY (id_categoria) 
        REFERENCES categorias(id_categoria),

    CONSTRAINT fk_producto_proveedor 
        FOREIGN KEY (id_proveedor) 
        REFERENCES proveedores(id_proveedor)

) ENGINE=InnoDB;

-- =========================
-- TABLA COTIZACIONES
-- =========================
CREATE TABLE cotizaciones (
    id_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    observacion TEXT,
    estado ENUM('Pendiente','Respondido','Aprobado','Rechazado') 
        NOT NULL DEFAULT 'Pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_cotizacion_cliente 
        FOREIGN KEY (id_cliente) 
        REFERENCES clientes(id_cliente),

    CONSTRAINT fk_cotizacion_producto 
        FOREIGN KEY (id_producto) 
        REFERENCES productos(id_producto)

) ENGINE=InnoDB;

-- =========================
-- TABLA VENTAS
-- =========================
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    precio_unitario DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    fecha_venta DATE NOT NULL,
    estado ENUM('Pendiente','Pagado','Anulado') 
        NOT NULL DEFAULT 'Pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_venta_cliente 
        FOREIGN KEY (id_cliente) 
        REFERENCES clientes(id_cliente),

    CONSTRAINT fk_venta_producto 
        FOREIGN KEY (id_producto) 
        REFERENCES productos(id_producto)

) ENGINE=InnoDB;

-- =========================
-- TABLA PAGOS
-- =========================
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    metodo_pago ENUM('Efectivo','Tarjeta','Yape','Plin','Transferencia')
        NOT NULL DEFAULT 'Efectivo',
    fecha_pago DATE NOT NULL,
    estado ENUM('Pagado','Pendiente','Anulado') 
        NOT NULL DEFAULT 'Pagado',
    observacion TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_pago_venta 
        FOREIGN KEY (id_venta) 
        REFERENCES ventas(id_venta)

) ENGINE=InnoDB;
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    id_proveedor INT NULL,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    imagen VARCHAR(255),
    estado ENUM('Disponible','Agotado','Inactivo') NOT NULL DEFAULT 'Disponible',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_producto_categoria 
        FOREIGN KEY (id_categoria) 
        REFERENCES categorias(id_categoria),

    CONSTRAINT fk_producto_proveedor 
        FOREIGN KEY (id_proveedor) 
        REFERENCES proveedores(id_proveedor)

) ENGINE=InnoDB;
-- =========================
-- USUARIO ADMIN
-- =========================
INSERT INTO usuario(nombre, correo, clave, rol, estado) VALUES
('Administrador', '1590173@senati.pe', 
'2345',
'Administrador', 'Activo');

-- =========================
-- CLIENTES
-- =========================
INSERT INTO clientes(nombres, apellidos, telefono, correo, direccion, estado) VALUES
('Juan', 'Pérez', '987654321', 'juan@gmail.com', 'Av. Lima 123', 'Activo'),
('María', 'Torres', '955444333', 'maria@gmail.com', 'Jr. Central 456', 'Activo');

-- =========================
-- CATEGORIAS
-- =========================
INSERT INTO categorias(nombre, descripcion, estado) VALUES
('Laptops', 'Equipos portátiles de diferentes marcas', 'Activo'),
('Celulares', 'Smartphones y accesorios móviles', 'Activo'),
('Audífonos', 'Audífonos gamer y bluetooth', 'Activo'),
('Teclados', 'Teclados mecánicos y de oficina', 'Activo'),
('Mouse', 'Mouse gamer e inalámbricos', 'Activo'),
('Monitores', 'Pantallas LED y gamer', 'Activo');

-- =========================
-- PROVEEDORES
-- =========================
INSERT INTO proveedores(razon_social, ruc, telefono, correo, direccion, estado) VALUES
('Tech Import SAC', '20547896321', '999888777', 'ventas@techimport.com', 'Av. Industrial 456', 'Activo'),
('Digital Store Perú', '20457896325', '988777666', 'contacto@digitalstore.com', 'Jr. Comercio 789', 'Activo');

-- =========================
-- PRODUCTOS
-- =========================
INSERT INTO productos(
    id_categoria,
    id_proveedor,
    nombre,
    descripcion,
    precio,
    stock,
    imagen,
    estado
) VALUES
(1, 1, 'Laptop Lenovo IdeaPad',
'Laptop Ryzen 5 8GB RAM SSD 512GB',
2500.00, 10, 'laptop.jpg', 'Disponible'),

(2, 2, 'Samsung Galaxy A54',
'Celular 128GB color negro',
1400.00, 15, 'celular.jpg', 'Disponible'),

(3, 1, 'Audífonos Logitech G435',
'Audífonos inalámbricos gamer',
320.00, 20, 'audifonos.jpg', 'Disponible'),

(5, 2, 'Mouse Redragon',
'Mouse gamer RGB',
120.00, 25, 'mouse.jpg', 'Disponible');

-- =========================
-- COTIZACIONES
-- =========================
INSERT INTO cotizaciones(
    id_cliente,
    id_producto,
    cantidad,
    observacion,
    estado
) VALUES
(1, 1, 1, 'Desea financiamiento', 'Pendiente'),

(2, 3, 2, 'Consulta por descuento', 'Respondido');

-- =========================
-- VENTAS
-- =========================
INSERT INTO ventas(
    id_cliente,
    id_producto,
    cantidad,
    precio_unitario,
    total,
    fecha_venta,
    estado
) VALUES
(1, 1, 1, 2500.00, 2500.00, CURDATE(), 'Pagado'),

(2, 4, 2, 120.00, 240.00, CURDATE(), 'Pagado');

-- =========================
-- PAGOS
-- =========================
INSERT INTO pagos(
    id_venta,
    monto,
    metodo_pago,
    fecha_pago,
    estado,
    observacion
) VALUES
(1, 2500.00, 'Transferencia', CURDATE(),
'Pagado', 'Pago completo de laptop'),

(2, 240.00, 'Yape', CURDATE(),
'Pagado', 'Pago de mouse gamer');

-- =========================
-- CONSULTAS
-- =========================
SELECT * FROM productos;
SELECT * FROM ventas;
SELECT * FROM pagos;