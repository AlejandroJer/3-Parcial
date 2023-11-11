SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `usr_requested` int(11) NOT NULL,
  `usr_requering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `Descripcion_producto`, `imagen`, `precio_compra`, `precio_venta`, `categoria`, `peso`, `tipo_material`, `cantidad_disponible`, `ubicacion_almacen`, `id_proveedor`) VALUES
(5, 'Anillo de Plata con Zafiro', 'Anillo de plata con un zafiro azul en la parte superior.', 'imagenes_productos/Imagen2.jpg', 75.00, 150.00, 'Anillo', 2, 'Plata', 15, 'Estante 2, Fila B', 2),
(6, 'Anillo de Compromiso de Platino', 'Elegante anillo de compromiso de platino con un diamante central.', 'imagenes_productos/Imagen3.jpg', 400.00, 800.00, 'Anillo', 4, 'Platino', 10, 'Estante 3, Fila C', 3),
(7, 'Anillo de Oro Rosa con Esmeralda', 'Anillo de oro rosa con una esmeralda verde en el centro', 'imagenes_productos/Imagen4.jpg', 150.00, 300.00, 'Anillo', 2, 'Oro', 12, 'Estante 4, Fila D', 4),
(8, 'Anillo de Oro con Rubí', 'Anillo de oro con un rubí rojo en la parte superior', 'imagenes_productos/Imagen5.jpg', 200.00, 400.00, 'Anillo', 3, 'Oro', 18, 'Estante 5, Fila E', 5),
(10, 'Collar de Perlas Blancas', 'Collar de perlas blancas con cierre de oro.', 'imagenes_productos/Imagen6.jpg', 100.00, 200.00, 'Collar', 4, 'Oro', 10, 'Estante 11, Fila K', 11),
(11, 'Colgante de Corazón de Plata', 'Colgante en forma de corazón de plata', 'imagenes_productos/Imagen7.jpg', 25.00, 50.00, 'Collar', 2, 'Plata', 25, 'Estante 12, Fila L', 12),
(13, 'Collar con Diamante y Zafiro', 'Collar de oro con un diamante y un zafiro.\r\n \r\n', 'imagenes_productos/Imagen8.jpg', 175.00, 350.00, 'Collar', 5, 'Oro', 8, 'Estante 13, Fila M', 13),
(16, 'Pulsera de Oro con Diamantes', 'Pulsera de oro con incrustaciones de diamantes.', 'imagenes_productos/Imagen11.jpg', 175.00, 350.00, 'Pulsera', 7, 'Oro', 14, 'Estante 16, Fila P', 16);

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(50) NOT NULL,
  `persona_contacto` varchar(70) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `num_telefono` int(10) UNSIGNED NOT NULL,
  `email_proveedor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `proveedores` (`id_proveedor`, `nombre_empresa`, `persona_contacto`, `direccion`, `num_telefono`, `email_proveedor`) VALUES
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
(17, 'Piedras del Mundo', 'Carlos Pérez', 'Avenida de las Perlas 456', 1415557890, 'carlos@piedrasdelmundo.com');

CREATE TABLE IF NOT EXISTS `respaldo_producto` (
  `id_producto_r` int(11) NOT NULL AUTO_INCREMENT,
  `nom_producto_r` varchar(50) NOT NULL,
  `desc_producto_r` text NOT NULL,
  `img_r` varchar(50) DEFAULT NULL,
  `precio_compra_r` decimal(10,0) UNSIGNED NOT NULL,
  `precio_venta_r` decimal(10,0) UNSIGNED NOT NULL,
  `categoria_r` varchar(40) NOT NULL,
  `peso_r` int(4) UNSIGNED NOT NULL,
  `tipo_material_r` varchar(30) NOT NULL,
  `cantidad_r` int(5) UNSIGNED NOT NULL,
  `ubicacion_r` varchar(50) NOT NULL,
  `id_proveedor_r` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto_r`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `respaldo_producto` (`id_producto_r`, `nom_producto_r`, `desc_producto_r`, `img_r`, `precio_compra_r`, `precio_venta_r`, `categoria_r`, `peso_r`, `tipo_material_r`, `cantidad_r`, `ubicacion_r`, `id_proveedor_r`) VALUES
(1, 'Pulsera de Plata con Zafiros', 'Pulsera de plata con zafiros azules', 'imagenes_respaldo/Imagen14.jpg', 90, 180, 'Pulsera', 7, 'Plata', 16, '0', 19),
(2, 'Pulsera de Oro Amarillo con Perlas', 'Pulsera de oro amarillo con perlas blancas.', 'imagenes_respaldo/Imagen13.jpg', 125, 250, 'Pulsera', 8, 'Oro', 8, '0', 18),
(3, 'Pulsera de Plata Elegante', 'Pulsera de plata con un diseño elegante.', 'imagenes_respaldo/Imagen12.jpg', 60, 120, 'Pulsera', 6, 'Plata', 20, '0', 17),
(4, 'Colgante de Cruz de Oro', 'Colgante en forma de cruz de oro.', 'imagenes_respaldo/Imagen9.jpg', 35, 70, 'Collar', 2, 'Oro', 18, 'Estante 14, Fila N', 14),
(5, 'Collar de Platino con Diamante', 'Collar de platino con un diamante en el colgante', 'imagenes_respaldo/Imagen10.jpg', 300, 600, 'Collar', 4, 'Platino', 12, 'Estante 15, Fila O', 15),
(6, 'Anillo de Diamante Clásico', 'Anillo de oro con un hermoso diamante en el centro.', 'imagenes_respaldo/Imagen1.jpg', 250, 500, 'Anillo', 3, 'Oro', 20, 'Estante 1, Fila A', 1);

CREATE TABLE IF NOT EXISTS `respaldo_proveedor` (
  `id_proveedor_r` int(11) NOT NULL AUTO_INCREMENT,
  `nom_empresa_r` varchar(50) NOT NULL,
  `p_contacto_r` varchar(70) NOT NULL,
  `dir_r` varchar(100) NOT NULL,
  `tel_r` int(10) UNSIGNED NOT NULL,
  `email_r` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proveedor_r`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `respaldo_proveedor` (`id_proveedor_r`, `nom_empresa_r`, `p_contacto_r`, `dir_r`, `tel_r`, `email_r`) VALUES
(1, 'Brillantes y Más', ' Ana Martínez', 'Calle de los Zafiros 789', 1515551234, 'ana@brillantesymas.com');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usr` varchar(30) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `apellido_usr` varchar(30) NOT NULL,
  `email_usr` varchar(60) NOT NULL,
  `sexo` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id_usr`, `nombre_usr`, `contraseña`, `apellido_usr`, `email_usr`, `sexo`, `id_perfil`) VALUES
(43, 'Juan', '$2y$10$SdskA0a/3hVA7cn75Ax0FOanRGaImfyhx8fm8zLhnRBe5nObADX0i', 'López', 'juan.lopez@email.com', 'm', 0),
(44, 'María', '$2y$10$QdtyqtgcJEQnfcAsVQckkO5oXA7JZFLb9UuwsKTqPTDD2QuCwSPEK', 'Rodríguez', 'maria.rodriguez@email.com', 'f', 0),
(45, 'Carlos', '$2y$10$1ccpXll7zny8BPyHzrGT6OLpSqQyX6AuvYtH/IbFWXlA5Fagp6Qky', 'Sánchez', 'carlos.sanchez@email.com', 'm', 0),
(46, 'Laura', '$2y$10$6M04SWJoRBrOL6krTPdW.OcntmbcwysrmajzmHYEbJ9QAwKVt5VeS', 'Martínez', 'laura.martinez@email.com', 'f', 0),
(47, 'Pedro', '$2y$10$w6mQKHdqL.3DKJpaoYhB.uTur/GZdl6KLSfD.KXzRcpHTVNC5Owtu', 'Gómez', 'pedro.gomez@email.com', 'm', 0),
(48, 'Ana', '$2y$10$gjRLv4dtGZSS8f5CF8Sa4uey4GFfHgC4gKgg0n8.wnjv68gBQkeUC', 'Pérez', 'ana.perez@email.com', 'f', 0),
(49, 'David', '$2y$10$mHZLgccoZ32VXIAd/Bhj.uc4WgqXjTTEK4JzNKtktdSO7VDL.0OVe', 'García', 'david.garcia@email.com', 'f', 0),
(50, 'Carmen', '$2y$10$ECxN3yRynm2p28ckNbgjoepUUw0DA/5ejhcSNn2sYr1sUQ.zIefZ6', 'López', 'carmen.lopez@email.com', 'f', 0),
(51, 'José', '$2y$10$7jUB/RhggKgSja26Tji2v.hxlRbDKWMR3dUWHceDjz/kV0250QUmq', 'Torres', 'jose.torres@email.com', 'm', 0),
(52, 'Marta', '$2y$10$e.3aWQLu5x/uQ.srwB/jNOY3MOLbGIW7hKZNKQ5ydktMLID.qvQUe', 'Rodríguez', 'marta.rodriguez@email.com', 'f', 0),
(53, 'Miguel', '$2y$10$wMMYggtuu9/iZOLgh2qViOD6RkhgTkYQ2F3pfqVaG8./ZABWGdBtq', 'Fernández', 'miguel.fernandez@email.com', 'm', 0),
(54, 'Elena', '$2y$10$B3mrVSHWUidhNg/5BonrCuLXXpLc/08wdW88/F5eXV.YqHMMuf7Dy', 'Ramírez', 'elena.ramirez@email.com', 'f', 0),
(55, 'Javier', '$2y$10$PM3Zm59a1YQDd7qaJhtya.pZUBL5I5wG5ChPTZXrbV6bgb4f5A4Ci', 'Soto', 'javier.soto@email.com', 'm', 0),
(56, 'Silvia', '$2y$10$2A/bjFRqqk0m36G6Y2urwe3Cfq.q7tVivj5J5Jy73qX.GnfAkokq2', 'Castro', 'silvia.castro@email.com', 'm', 0),
(57, 'Raúl', '$2y$10$V1vQa.5l8Quqam76Y4ETReFdmGsolC4x9/Ve.pkYQ8vOaiqDPqueK', 'Herrera', 'raul.herrera@email.com', 'm', 0);

CREATE TABLE IF NOT EXISTS `usuarios_respaldo` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_r` varchar(30) NOT NULL,
  `pass_r` varchar(40) NOT NULL,
  `apellido_r` varchar(30) NOT NULL,
  `email_r` varchar(60) NOT NULL,
  `sexo_r` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_perfil_r` int(11) NOT NULL,
  PRIMARY KEY (`id_r`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
