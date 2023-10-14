SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_movimiento` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(30) NOT NULL,
  `descripcion_perfil` text NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(50) NOT NULL,
  `Descripcion_producto` text NOT NULL,
  `imagen` varchar(60) DEFAULT NULL,
  `precio_compra` decimal(10,2) UNSIGNED NOT NULL,
  `precio_venta` decimal(10,2) UNSIGNED NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `peso` int(4) UNSIGNED NOT NULL,
  `tipo_material` varchar(50) NOT NULL,
  `cantidad_disponible` int(4) UNSIGNED NOT NULL,
  `ubicacion_almacen` varchar(50) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `productos` (`id_producto`, `nombre_producto`, `Descripcion_producto`, `imagen`, `precio_compra`, `precio_venta`, `categoria`, `peso`, `tipo_material`, `cantidad_disponible`, `ubicacion_almacen`, `id_proveedor`) VALUES
(4, 'Anillo de Diamante Clásico', 'Anillo de oro con un hermoso diamante en el centro.', 'imagenes_productos/Imagen1.jpg', 250.00, 500.00, 'Anillo', 3, 'Oro', 20, 'Estante 1, Fila A', 1),
(5, 'Anillo de Plata con Zafiro', 'Anillo de plata con un zafiro azul en la parte superior.', 'imagenes_productos/Imagen2.jpg', 75.00, 150.00, 'Anillo', 2, 'Plata', 15, 'Estante 2, Fila B', 2),
(6, 'Anillo de Compromiso de Platino', 'Elegante anillo de compromiso de platino con un diamante central.', 'imagenes_productos/Imagen3.jpg', 400.00, 800.00, 'Anillo', 4, 'Platino', 10, 'Estante 3, Fila C', 3),
(7, 'Anillo de Oro Rosa con Esmeralda', 'Anillo de oro rosa con una esmeralda verde en el centro', 'imagenes_productos/Imagen4.jpg', 150.00, 300.00, 'Anillo', 2, 'Oro', 12, 'Estante 4, Fila D', 4),
(8, 'Anillo de Oro con Rubí', 'Anillo de oro con un rubí rojo en la parte superior', 'imagenes_productos/Imagen5.jpg', 200.00, 400.00, 'Anillo', 3, 'Oro', 18, 'Estante 5, Fila E', 5),
(10, 'Collar de Perlas Blancas', 'Collar de perlas blancas con cierre de oro.', 'imagenes_productos/Imagen6.jpg', 100.00, 200.00, 'Collar', 4, 'Oro', 10, 'Estante 11, Fila K', 11),
(11, 'Colgante de Corazón de Plata', 'Colgante en forma de corazón de plata', 'imagenes_productos/Imagen7.jpg', 25.00, 50.00, 'Collar', 2, 'Plata', 25, 'Estante 12, Fila L', 12),
(13, 'Collar con Diamante y Zafiro', 'Collar de oro con un diamante y un zafiro.\r\n \r\n', 'imagenes_productos/Imagen8.jpg', 175.00, 350.00, 'Collar', 5, 'Oro', 8, 'Estante 13, Fila M', 13),
(14, 'Colgante de Cruz de Oro', 'Colgante en forma de cruz de oro.', 'imagenes_productos/Imagen9.jpg', 35.00, 70.00, 'Collar', 2, 'Oro', 18, 'Estante 14, Fila N', 14),
(15, 'Collar de Platino con Diamante', 'Collar de platino con un diamante en el colgante', 'imagenes_productos/Imagen10.jpg', 300.00, 600.00, 'Collar', 4, 'Platino', 12, 'Estante 15, Fila O', 15),
(16, 'Pulsera de Oro con Diamantes', 'Pulsera de oro con incrustaciones de diamantes.', 'imagenes_productos/Imagen11.jpg', 175.00, 350.00, 'Pulsera', 7, 'Oro', 14, 'Estante 16, Fila P', 16),
(17, 'Pulsera de Plata Elegante', 'Pulsera de plata con un diseño elegante.', 'imagenes_productos/Imagen12.jpg', 60.00, 120.00, 'Pulsera', 6, 'Plata', 20, 'Estante 17, Fila Q', 17),
(18, 'Pulsera de Oro Amarillo con Perlas', 'Pulsera de oro amarillo con perlas blancas.', 'imagenes_productos/Imagen13.jpg', 125.00, 250.00, 'Pulsera', 8, 'Oro', 8, 'Estante 18, Fila R', 18),
(20, 'Pulsera de Plata con Zafiros', 'Pulsera de plata con zafiros azules', 'imagenes_productos/Imagen14.jpg', 90.00, 180.00, 'Pulsera', 7, 'Plata', 16, 'Estante 19, Fila S', 19),
(21, 'Pulsera de Oro Rosa con Diamantes', 'Pulsera de oro rosa con diamantes en el cierre', 'imagenes_productos/Imagen15.jpg', 140.00, 280.00, 'Pulsera', 6, 'Oro', 12, 'Estante 20, Fila T', 20),
(22, 'Pendientes de Diamante Brillante', 'Pendientes de oro con diamantes brillantes', 'imagenes_productos/Imagen16.jpg', 150.00, 300.00, 'Pulsera', 2, 'Oro', 12, 'Estante 21, Fila U', 21),
(23, 'Pendientes de Plata con Perlas', 'Pendientes de plata con perlas blancas.', 'imagenes_productos/Imagen17.jpg', 40.00, 80.00, 'Pulsera', 1, 'Plata', 20, 'Estante 22, Fila V', 22),
(24, 'Pendientes de Oro Rosa con Zafiros', 'Pendientes de oro rosa con zafiros azules.', 'imagenes_productos/Imagen18.jpg', 110.00, 220.00, 'Pulsera', 2, 'Oro', 15, 'Estante 23, Fila W', 23),
(25, 'Pendientes de Platino con Esmeraldas', 'Pendientes de platino con esmeraldas verdes', 'imagenes_productos/Imagen19.jpg', 200.00, 400.00, 'Pulsera', 3, 'Platino', 8, 'Estante 24, Fila X', 24),
(26, 'Pendientes de Oro con Rubíes', 'Pendientes de oro con rubíes rojos.', 'imagenes_productos/Imagen20.jpg', 130.00, 260.00, 'Pulsera', 2, 'Oro', 14, 'Estante 25, Fila Y', 25);

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(50) NOT NULL,
  `persona_contacto` varchar(70) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `num_telefono` int(10) UNSIGNED NOT NULL,
  `email_proveedor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `proveedores` (`id_proveedor`, `nombre_empresa`, `persona_contacto`, `direccion`, `num_telefono`, `email_proveedor`) VALUES
(2, 'Joyería Elegante', 'Ana Pérez', 'Calle de las gemas 123', 3145554567, 'ana@joyeriaelegante.com'),
(3, 'Diamantes Brillantes', 'Juan Rodríguez', 'Avenida de los Zafiros 456', 3145555678, 'juan@diamantesbrillantes.com'),
(4, 'Oro Fino Joyería', 'María López', 'Plaza de las Joyas 789', 3145556789, 'maria@orofinojoyeria.com'),
(5, 'Gemas Preciosas S.A.', 'Carlos Martínez', 'Calle de las Perlas 101', 3145557890, 'carlos@gemaspreciosas.com'),
(6, 'Plata y Brillantes', 'Laura González', 'Avenida de los Diamantes 222', 3145558901, 'laura@plataYbrillantes.com'),
(7, 'Zafiros Elegantes', 'Pedro Sánchez', 'Calle de las joyas 333', 3145559012, 'pedro@zafirosElegantes.com'),
(8, 'Joyería Brillante', 'Marta Pérez', 'Avenida de los Rubíes 444', 3145550123, 'marta@joyeriaBrillante.com'),
(9, 'Perlas Finas', 'Juanita Rodríguez', 'Calle de las Perlas 555', 3145551234, 'juanita@perlasFinas.com'),
(10, 'Diamantes y Rubíes', 'Pablo Gómez', 'Avenida de las Gemas 666', 3145552345, 'pablo@diamantesYrubies.com'),
(11, ' Plata Elegante S.A.', 'Elena Torres', 'Calle de los Zafiros 777', 3145553456, 'elena@plataElegante.com'),
(12, ' Gemas Exclusivas', 'Marta González', 'Calle de los Zafiros 789', 4294967295, 'marta@gemasexclusivas.com'),
(13, 'Orfebrería Fina', 'David Martínez', 'Paseo de los Rubíes 567', 4294967295, 'david@orfebreriafina.com'),
(14, 'Piedras Preciosas S.A.', 'Laura Sánchez', 'Avenida de las Esmeraldas 890', 4294967295, 'laura@piedraspreciosas.com'),
(15, ' Anillos de Plata', 'Andrés López', ' Calle de los Diamantes 123', 4294967295, 'andres@anillosdeplata.com'),
(16, 'Bisutería Creativa', 'Patricio Fernández', ' Avenida de las Perlas 456', 4294967295, 'patricio@bisuteriacreativa.com'),
(17, 'Piedras del Mundo', 'Carlos Pérez', 'Avenida de las Perlas 456', 1415557890, 'carlos@piedrasdelmundo.com'),
(18, 'Brillantes y Más', ' Ana Martínez', 'Calle de los Zafiros 789', 1515551234, 'ana@brillantesymas.com');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usr` varchar(30) NOT NULL,
  `contraseña` varchar(40) NOT NULL,
  `apellido_usr` varchar(30) NOT NULL,
  `email_usr` varchar(60) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `usuarios` (`id_usr`, `nombre_usr`, `contraseña`, `apellido_usr`, `email_usr`, `id_perfil`) VALUES
(3, 'Juan', '$2y$10$tJEpiFiWkg7XVC70jx/PAOv6JXem4Bp/C', 'Lopez', 'juan.lopez@email.com', 0),
(4, 'María ', '$2y$10$96D0flU99PVmDaA6hy8qiuV2ywlBgptmb', 'Rodríguez', 'maria.rodriguez@email.com', 0),
(5, 'Carlos', '$2y$10$jK3nwXN1cIc3/iWOC9.66OX1sz5Y1arIC', 'Sánchez', 'carlos.sanchez@email.com', 0),
(6, 'Laura', '$2y$10$M4gU/i64wqd/qfzxlLjsQ.3TcFm7oeJSj', 'Martínez', 'laura.martinez@email.com', 0),
(7, 'Pedro', '$2y$10$5y0DfQR6bXENZWrFW5JoRefS/AFBf.Nkk', 'Gómez', 'pedro.gomez@email.com', 0),
(8, 'Ana', '$2y$10$02LUqGM2TD3AyNhQKXoz2uBnbzfR63qJC', 'Pérez', 'ana.perez@email.com', 0),
(9, 'David', '$2y$10$PTpx0XQNyQMAP0AuWTCTruktyb3KGv0KF', 'García', 'david.garcia@email.com', 0),
(10, 'Carmen', '$2y$10$7PtwXOLBtKYO.IkqdP6icuz88v.EmwZtN', 'López', 'carmen.lopez@email.com', 0),
(11, 'José', '$2y$10$2t5n7tRDe0dhGBVo2eZfGOudVw0pU7RLE', 'Torres', 'jose.torres@email.com', 0),
(12, 'Marta', '$2y$10$7aGyQXdXzEX3WyyHwsrp2OI3GWsBVnYqu', 'Rodríguez', 'marta.rodriguez@email.com', 0),
(13, 'Miguel', '$2y$10$iR1nJDlswigZDXIKEjhIzeTTvE4gO0foC', 'Fernández', 'miguel.fernandez@email.com', 0),
(14, 'Elena', '$2y$10$Doxfe2A95zMYz9r.Nob5wudlsVKAWnx0G', 'Ramírez', 'elena.ramirez@email.com', 0),
(15, 'Javier ', '$2y$10$X4AlnF5SAN4UvFJwY7nEXu8sa9T8n6Kts', 'Soto', 'javier.soto@email.com', 0),
(16, 'Silvia', '$2y$10$yWZemxe2XBzjd1Q94vOJtOZaoMOirk4/W', 'Castro', 'silvia.castro@email.com', 0),
(17, 'Raúl', '$2y$10$27OwtHOt3qQT7N6Sk0Uv1.QJrFsLxNYqD', 'Herrera', 'raul.herrera@email.com', 0),
(18, 'Alejandro', '$2y$10$t1c3whli0buHPPmas1CYfu0QSI8GPST4k', 'García', 'alejandro.garcia@email.com', 0),
(19, 'Andrés', '$2y$10$m3kiQK90XZR.buKy6PK1auj49fqw18GDs', 'Torres', 'andres.torres@email.com', 0),
(20, 'Patricia', '$2y$10$95QRJOwrGAGm6cFw1LbqmOfLHQx2klC0b', 'Silva', 'patricia.silva@email.com', 0),
(21, 'Luis', '$2y$10$y0fACFrpHf9ny8qyfXu7vu2A0QTO3ovHt', 'Ortega', 'luis.ortega@email.com', 0),
(22, 'Isabel', '$2y$10$EuI22iCShBSdpbtlexwE9OYP7uPnBe3WH', 'Vargas', 'isabel.vargas@email.com', 0),
(23, 'Daniel', '$2y$10$qYEli1epEnyblf6mFBOUmefa/iRQAaNgv', 'Molina', 'daniel.molina@email.com', 0),
(24, 'Sonia', '$2y$10$b24pEYnWokJCrI/hAoA2/uPnJXZ26ahns', 'Castillo', 'sonia.castillo@email.com', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
