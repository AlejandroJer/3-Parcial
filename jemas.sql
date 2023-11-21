SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Anillos'),
(2, 'Collares y Colgantes'),
(3, 'Pulseras'),
(4, 'Pendientes'),
(5, 'Relojes');

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `material` (`id`, `material`) VALUES
(1, 'Oro'),
(2, 'Plata'),
(3, 'Platino');

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
  `tabla` varchar(20) NOT NULL,
  `id_tabla_PK` int(11) NOT NULL,
  `id_tabla_r_PK` int(11) DEFAULT NULL,
  `tipo_movimiento` varchar(20) NOT NULL,
  `id_usr` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `movimientos` (`id_movimiento`, `fecha_movimiento`, `tabla`, `id_tabla_PK`, `id_tabla_r_PK`, `tipo_movimiento`, `id_usr`) VALUES
(92, '2023-11-20 23:48:52', 'proveedores', 41, 17, '1', 43),
(112, '2023-11-21 01:00:20', 'proveedores', 43, 18, '0', 43),
(113, '2023-11-21 01:06:17', 'proveedores', 49, 0, '2', 43),
(114, '2023-11-21 01:35:19', 'proveedores', 49, 19, '0', 64),
(115, '2023-11-21 01:35:22', 'proveedores', 48, 20, '0', 64),
(116, '2023-11-21 01:35:25', 'proveedores', 47, 21, '0', 64),
(117, '2023-11-21 01:35:27', 'proveedores', 46, 22, '0', 64),
(118, '2023-11-21 01:35:30', 'proveedores', 45, 23, '0', 64),
(119, '2023-11-21 01:35:34', 'proveedores', 44, 24, '0', 64),
(120, '2023-11-21 02:27:09', 'productos', 42, 0, '2', 64),
(121, '2023-11-21 02:48:02', 'productos', 43, 0, '2', 64),
(122, '2023-11-21 02:48:17', 'productos', 43, 35, '1', 64),
(123, '2023-11-21 02:50:08', 'productos', 44, 0, '2', 64),
(124, '2023-11-21 02:50:32', 'productos', 44, 36, '1', 64),
(125, '2023-11-21 02:50:53', 'productos', 44, 37, '1', 64),
(126, '2023-11-21 02:53:13', 'productos', 44, 38, '1', 64),
(127, '2023-11-21 02:55:01', 'productos', 44, 39, '1', 64),
(128, '2023-11-21 02:55:31', 'productos', 43, 40, '1', 64),
(129, '2023-11-21 02:56:24', 'productos', 45, 0, '2', 64),
(130, '2023-11-21 02:56:50', 'productos', 45, 41, '1', 64),
(131, '2023-11-21 02:57:17', 'productos', 45, 42, '1', 64),
(132, '2023-11-21 02:58:35', 'productos', 46, 0, '2', 64),
(133, '2023-11-21 02:59:35', 'productos', 47, 0, '2', 64),
(134, '2023-11-21 03:00:49', 'productos', 42, 43, '1', 64),
(135, '2023-11-21 03:01:26', 'productos', 43, 44, '1', 64),
(136, '2023-11-21 03:02:40', 'productos', 48, 0, '2', 64),
(137, '2023-11-21 03:02:53', 'productos', 48, 45, '1', 64),
(138, '2023-11-21 03:03:49', 'productos', 49, 0, '2', 64),
(139, '2023-11-21 03:04:00', 'productos', 49, 46, '1', 64),
(140, '2023-11-21 03:22:00', 'productos', 45, 47, '1', 64),
(141, '2023-11-21 03:25:10', 'productos', 45, 48, '1', 64),
(142, '2023-11-21 03:26:32', 'productos', 45, 49, '1', 64),
(143, '2023-11-21 03:28:07', 'productos', 45, 50, '1', 64),
(144, '2023-11-21 03:34:59', 'productos', 45, 51, '1', 64),
(145, '2023-11-21 03:40:48', 'productos', 50, 0, '2', 64),
(146, '2023-11-21 03:40:59', 'productos', 50, 52, '1', 64),
(147, '2023-11-21 03:41:19', 'productos', 50, 53, '1', 64),
(148, '2023-11-21 03:41:40', 'productos', 50, 54, '0', 64),
(165, '2023-11-21 05:37:53', 'usuarios', 81, 27, '1', 64),
(166, '2023-11-21 05:38:01', 'usuarios', 80, 28, '1', 64),
(167, '2023-11-21 05:38:10', 'usuarios', 76, 29, '1', 64),
(168, '2023-11-21 05:38:19', 'usuarios', 78, 30, '1', 64);

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
  `imagen` varchar(120) DEFAULT NULL,
  `precio_compra` decimal(10,2) UNSIGNED NOT NULL,
  `precio_venta` decimal(10,2) UNSIGNED NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `peso` decimal(10,2) UNSIGNED NOT NULL,
  `id_material` int(11) NOT NULL,
  `cantidad_disponible` int(4) UNSIGNED NOT NULL,
  `ubicacion_almacen` varchar(50) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_material` (`id_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `productos` (`id_producto`, `nombre_producto`, `Descripcion_producto`, `imagen`, `precio_compra`, `precio_venta`, `id_categoria`, `peso`, `id_material`, `cantidad_disponible`, `ubicacion_almacen`, `id_proveedor`) VALUES
(5, 'Anillo de Plata con Zafiro', 'Anillo de plata con un zafiro azul en la parte superior.', 'imagenes_productos/Imagen2.jpg', 150.00, 150.00, 1, 2.00, 2, 15, 'Estante 2, Fila B', 2),
(6, 'Anillo de Compromiso de Platino', 'Elegante anillo de compromiso de platino con un diamante central.', 'imagenes_productos/Imagen3.jpg', 800.00, 800.00, 1, 4.00, 3, 10, 'Estante 3, Fila C', 3),
(7, 'Anillo de Oro Rosa con Esmeralda', 'Anillo de oro rosa con una esmeralda verde en el centro', 'imagenes_productos/Imagen4.jpg', 300.00, 300.00, 1, 2.00, 1, 12, 'Estante 4, Fila D', 4),
(8, 'Anillo de Oro con Rubí', 'Anillo de oro con un rubí rojo en la parte superior. adornado de hojas a pie del ruby', 'imagenes_productos/Imagen5.jpg', 400.00, 400.00, 1, 3.00, 1, 18, 'Estante 5, Fila E', 5),
(10, 'Collar de Perlas Blancas', 'Collar de perlas blancas con cierre de oro.', 'imagenes_productos/Imagen6.jpg', 200.00, 200.00, 2, 4.00, 1, 10, 'Estante 11, Fila K', 11),
(11, 'Colgante de Corazón de Plata', 'Colgante en forma de corazón de plata', 'imagenes_productos/Imagen7.jpg', 50.00, 50.00, 2, 2.00, 2, 25, 'Estante 12, Fila L', 12),
(13, 'Collar con Diamante y Zafiro', 'Collar de oro con un diamante y un zafiro.\r\n \r\n', 'imagenes_productos/Imagen8.jpg', 350.00, 350.00, 2, 5.00, 1, 8, 'Estante 13, Fila M', 13),
(16, 'Pulsera de Oro con Diamantes', 'Pulsera de oro con incrustaciones de diamantes, con diseño de laureles.', 'imagenes_productos/Imagen11.jpg', 350.00, 350.00, 3, 7.00, 1, 14, 'Estante 16, Fila P', 16),
(42, 'Pulsera de Plata con Granates', 'Pulsera de plata con granates rojos en forma de corazón.', 'imagenes_productos/PulseradePlataconGranates2023-11-21_09-27-09.jpeg', 110.00, 110.00, 3, 4.00, 2, 3, 'Estante 4, Fila A', 30),
(43, 'Pendientes de Oro con Perlas', 'Pendientes de oro con perlas negras y blancas.', 'imagenes_productos/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg', 210.00, 210.00, 4, 2.40, 1, 3, 'Estante 5, Fila C', 14),
(44, 'Reloj de Plata con Rubíes', 'Reloj de plata con rubíes rojos en la esfera y la correa.', 'imagenes_productos/RelojdePlataconRubíes2023-11-21_09-50-08.jpeg', 350.00, 350.00, 5, 8.20, 2, 2, 'Estante 6, Fila B', 35),
(45, 'Anillo de Platino con Esmeralda', 'Anillo de platino con una esmeralda verde en el centro.', 'imagenes_productos/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg', 400.00, 400.00, 1, 3.60, 3, 3, 'Estante 2, Fila K', 17),
(46, 'Collar de Oro con Rubíes', 'Collar de oro con rubíes rojos en forma de flor', 'imagenes_productos/CollardeOroconRubíes2023-11-21_09-58-35.jpeg', 220.00, 260.00, 2, 5.20, 1, 4, 'Estante 3, Fila D', 29),
(47, 'Pulsera de Platino con Zafiros', 'Pulsera de platino con zafiros azules en forma de estrella.', 'imagenes_productos/PulseradePlatinoconZafiros2023-11-21_09-59-35.jpeg', 200.00, 240.00, 3, 4.90, 3, 3, 'Estante 4, Fila B', 27),
(48, 'Pendientes de Plata con Amatistas', 'Pendientes de plata con amatistas moradas en forma de mariposa', 'imagenes_productos/PendientesdePlataconAmatistas2023-11-21_10-02-53.jpeg', 120.00, 120.00, 4, 1.90, 2, 3, 'Estante 5, Fila D', 7),
(49, 'Reloj de Oro con Esmeraldas', 'Reloj de oro con esmeraldas verdes en la esfera y la correa.', 'imagenes_productos/RelojdeOroconEsmeraldas2023-11-21_10-04-00.jpeg', 450.00, 450.00, 5, 9.20, 1, 5, 'Estante 6, Fila D', 11);

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(50) NOT NULL,
  `persona_contacto` varchar(70) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `num_telefono` bigint(10) UNSIGNED NOT NULL,
  `email_proveedor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `proveedores` (`id_proveedor`, `nombre_empresa`, `persona_contacto`, `direccion`, `num_telefono`, `email_proveedor`) VALUES
(2, 'Joyería Elegante', 'Ana Pérez', 'Calle de las gemas 123', 3147541278, 'ana@joyeriaelegante.com'),
(3, 'Diamantes Brillantes', 'Juan Rodríguez', 'Avenida de los Zafiros 456', 3145555678, 'juan@diamantesbrillantes.com'),
(4, 'Oro Fino Joyería', 'María López', 'Plaza de las Joyas 789', 3145556789, 'maria@orofinojoyeria.com'),
(5, 'Gemas Preciosas S.A.', 'Carlos Martínez', 'Calle de las Perlas 101', 3145557890, 'carlos@gemaspreciosas.com'),
(6, 'Plata y Brillantes', 'Laura González', 'Avenida de los Diamantes 222', 3145558901, 'laura@plataYbrillantes.com'),
(7, 'Zafiros Elegantes', 'Pedro Sánchez', 'Calle de las joyas 333', 3145559012, 'pedro@zafirosElegantes.com'),
(8, 'Joyería Brillante', 'Marta Pérez', 'Avenida de los Rubíes 444', 3145550123, 'marta@joyeriaBrillante.com'),
(9, 'Perlas Finas', 'Juanita Rodríguez', 'Calle de las Perlas 555', 3145551234, 'juanita@perlasFinas.com'),
(10, 'Diamantes y Rubíes', 'Pablo Gómez', 'Avenida de las Gemas 666', 2793632345, 'pablo@diamantesYrubies.com'),
(11, ' Plata Elegante S.A.', 'Elena Torres', 'Calle de los Zafiros 777', 3145553456, 'elena@plataElegante.com'),
(12, ' Gemas Exclusivas', 'Marta González', 'Calle de los Zafiros 789', 4294967295, 'marta@gemasexclusivas.com'),
(13, 'Orfebrería Fina', 'David Martínez', 'Paseo de los Rubíes 567', 4294967295, 'david@orfebreriafina.com'),
(14, 'Piedras Preciosas S.A.', 'Laura Sánchez', 'Avenida de las Esmeraldas 890', 4294967295, 'laura@piedraspreciosas.com'),
(15, ' Anillos de Plata', 'Andrés López', ' Calle de los Diamantes 123', 4294967295, 'andres@anillosdeplata.com'),
(16, 'Bisutería Creativa', 'Patricio Fernández', ' Avenida de las Perlas 456', 4294967295, 'patricio@bisuteriacreativa.com'),
(17, 'Piedras del Mundo', 'Carlos Pérez', 'Avenida de las Perlas 456', 1415557890, 'carlos@piedrasdelmundo.com'),
(19, 'Joyería Feliz', 'Fernando Espinoza', 'Boulevard Naranjo de las Hadas', 3144569812, 'fernando.espinoza@hotmail.com'),
(22, 'Joyería Elegante', 'Ana Pérez', 'Calle de las gemas 123', 3145554567, 'ana@joyeriaelegante.com'),
(23, 'Joyería Brillante', 'Carlos López', 'Avenida de los diamantes 456', 3145556789, 'carlos@joyeriabrillante.com'),
(24, 'Joyería Fina', 'María García', 'Plaza de las perlas 789', 3145557890, 'maria@joyeriafina.com'),
(25, 'Joyería Moderna', 'Pedro Sánchez', 'Boulevard de los zafiros 101', 3145558901, 'pedro@joyeriamoderna.com'),
(26, 'Joyería Clásica', 'Laura Rodríguez', 'Callejón de los rubíes 202', 3145559012, 'laura@joyeriaclasica.com'),
(27, 'Joyería Exótica', 'José Martínez', 'Paseo de las turquesas 303', 3145550123, 'jose@joyeriaexotica.com'),
(28, 'Joyería Natural', 'Sofía González', 'Camino de las esmeraldas 404', 3145551234, 'sofia@joyerianatural.com'),
(29, 'Joyería Creativa', 'Luis Hernández', 'Carretera de los ópalos 505', 3145552345, 'luis@joyeriacreativa.com'),
(30, 'Joyería Elegante', 'Miguel Pérez', 'Calle de las gemas 124', 3145553456, 'miguel@joyeriaelegante.com'),
(31, 'Joyería Brillante', 'Sara López', 'Avenida de los diamantes 457', 3145554568, 'sara@joyeriabrillante.com'),
(32, 'Joyería Fina', 'Jorge García', 'Plaza de las perlas 790', 3145555679, 'jorge@joyeriafina.com'),
(33, 'Joyería Moderna', 'Elena Sánchez', 'Boulevard de los zafiros 102', 3145556780, 'elena@joyeriamoderna.com'),
(34, 'Joyería Clásica', 'David Rodríguez', 'Callejón de los rubíes 203', 3145557891, 'david@joyeriaclasica.com'),
(35, 'Joyería Exótica', 'Ana Martínez', 'Paseo de las turquesas 304', 3145558902, 'ana@joyeriaexotica.com'),
(37, 'Joyería Creativa', 'María Hernández', 'Carretera de los ópalos 506', 3145550124, 'maria@joyeriacreativa.com'),
(38, 'Joyería Elegante', 'Pedro Pérez', 'Calle de las gemas 125', 3145551235, 'pedro@joyeriaelegante.com'),
(39, 'Joyería Brillante', 'Laura López', 'Avenida de los diamantes 458', 3145552346, 'laura@joyeriabrillante.com'),
(40, 'Joyería Fina', 'Luis García', 'Plaza de las perlas 791', 3145553457, 'luis@joyeriafina.com'),
(41, 'Iluminados de Minerales', 'Sofía Sánchez', 'Boulevard de los zafiros 103', 6672393823, 'sofia@joyeriamoderna.com');

CREATE TABLE IF NOT EXISTS `respaldo_producto` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_producto_r` int(11) UNSIGNED NOT NULL,
  `nom_producto_r` varchar(300) NOT NULL,
  `desc_producto_r` text NOT NULL,
  `img_r` varchar(300) DEFAULT NULL,
  `precio_compra_r` varchar(100) NOT NULL,
  `precio_venta_r` varchar(100) NOT NULL,
  `categoria_r` varchar(30) NOT NULL,
  `peso_r` varchar(30) NOT NULL,
  `tipo_material_r` varchar(30) NOT NULL,
  `cantidad_r` varchar(30) NOT NULL,
  `ubicacion_r` varchar(50) NOT NULL,
  `id_proveedor_r` varchar(33) DEFAULT NULL,
  `mov` int(1) UNSIGNED NOT NULL,
  `MovByUsr` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `respaldo_producto` (`id`, `id_producto_r`, `nom_producto_r`, `desc_producto_r`, `img_r`, `precio_compra_r`, `precio_venta_r`, `categoria_r`, `peso_r`, `tipo_material_r`, `cantidad_r`, `ubicacion_r`, `id_proveedor_r`, `mov`, `MovByUsr`) VALUES
(35, 43, '[\"Pendientes de Oro con Perlas\",\"Pendientes de Oro con Perlas\"]', '[\"Pendientes de oro con perlas negras y blancas.\",\"Pendientes de oro con perlas negras y blancas.\"]', '[null,\"imagenes_productos\\/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg\"]', '[\"180.00\",210]', '[\"210.00\",210]', '[4,\"4\"]', '[\"2.40\",240]', '[1,\"1\"]', '[3,3]', '[\"5\",\"5\"]', '[14,14]', 1, 64),
(36, 44, '[\"Reloj de Plata con Rub\\u00edes\",\"Reloj de Plata con Rub\\u00edes\"]', '[\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\",\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\"]', '[\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\",\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\"]', '[\"300.00\",350]', '[\"350.00\",350]', '[5,\"5\"]', '[\"8.20\",820]', '[2,\"2\"]', '[2,2]', '[\"6\",\"Estante 6, Fila B\"]', '[35,35]', 1, 64),
(37, 44, '[\"Reloj de Plata con Rub\\u00edes\",\"Reloj de Plata con Rub\\u00edes\"]', '[\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\",\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\"]', '[\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\",\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\"]', '[\"350.00\",350]', '[\"350.00\",350]', '[5,\"5\"]', '[\"820.00\",82]', '[2,\"2\"]', '[2,2]', '[\"Estante 6, Fila B\",\"Estante 6, Fila B\"]', '[35,35]', 1, 64),
(38, 44, '[\"Reloj de Plata con Rub\\u00edes\",\"Reloj de Plata con Rub\\u00edes\"]', '[\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\",\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\"]', '[\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\",\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\"]', '[\"350.00\",350]', '[\"350.00\",350]', '[5,\"5\"]', '[\"82.00\",820]', '[2,\"2\"]', '[2,2]', '[\"Estante 6, Fila B\",\"Estante 6, Fila B\"]', '[35,35]', 1, 64),
(39, 44, '[\"Reloj de Plata con Rub\\u00edes\",\"Reloj de Plata con Rub\\u00edes\"]', '[\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\",\"Reloj de plata con rub\\u00edes rojos en la esfera y la correa.\"]', '[\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\",\"imagenes_productos\\/RelojdePlataconRub\\u00edes2023-11-21_09-50-08.jpeg\"]', '[\"350.00\",350]', '[\"350.00\",350]', '[5,\"5\"]', '[\"820.00\",8.2]', '[2,\"2\"]', '[2,2]', '[\"Estante 6, Fila B\",\"Estante 6, Fila B\"]', '[35,35]', 1, 64),
(40, 43, '[\"Pendientes de Oro con Perlas\",\"Pendientes de Oro con Perlas\"]', '[\"Pendientes de oro con perlas negras y blancas.\",\"Pendientes de oro con perlas negras y blancas.\"]', '[\"imagenes_productos\\/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg\",\"imagenes_productos\\/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg\"]', '[\"210.00\",210]', '[\"210.00\",210]', '[4,\"4\"]', '[\"240.00\",2.4]', '[1,\"1\"]', '[3,3]', '[\"5\",\"5\"]', '[14,14]', 1, 64),
(41, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.&#39;,\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[null,null]', '[\"350.00\",400]', '[\"400.00\",400]', '[1,\"1\"]', '[\"3.60\",3.6]', '[3,\"3\"]', '[2,2]', '[\"2\",\"Estante 2, Fila C\"]', '[28,28]', 1, 64),
(42, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[null,\"imagenes_productos/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,\"1\"]', '[\"3.60\",3.6]', '[3,\"3\"]', '[2,2]', '[\"Estante 2, Fila C\",\"Estante 2, Fila C\"]', '[28,28]', 1, 64),
(43, 42, '[\"Pulsera de Plata con Granates\",\"Pulsera de Plata con Granates\"]', '[\"Pulsera de plata con granates rojos en forma de coraz\\u00f3n.\",\"Pulsera de plata con granates rojos en forma de coraz\\u00f3n.\"]', '[\"imagenes_productos\\/PulseradePlataconGranates2023-11-21_09-27-09.jpeg\",\"imagenes_productos\\/PulseradePlataconGranates2023-11-21_09-27-09.jpeg\"]', '[\"90.00\",110]', '[\"110.00\",110]', '[3,\"3\"]', '[\"4.00\",4]', '[2,\"2\"]', '[3,3]', '[\"4\",\"Estante 4, Fila A\"]', '[30,30]', 1, 64),
(44, 43, '[\"Pendientes de Oro con Perlas\",\"Pendientes de Oro con Perlas\"]', '[\"Pendientes de oro con perlas negras y blancas.\",\"Pendientes de oro con perlas negras y blancas.\"]', '[\"imagenes_productos\\/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg\",\"imagenes_productos\\/PendientesdeOroconPerlas2023-11-21_09-48-17.jpeg\"]', '[\"210.00\",210]', '[\"210.00\",210]', '[4,\"4\"]', '[\"2.40\",2.4]', '[1,\"1\"]', '[3,3]', '[\"5\",\"Estante 5, Fila C\"]', '[14,14]', 1, 64),
(45, 48, '[\"Pendientes de Plata con Amatistas\",\"Pendientes de Plata con Amatistas\"]', '[\"Pendientes de plata con amatistas moradas en forma de mariposa\",\"Pendientes de plata con amatistas moradas en forma de mariposa\"]', '[null,\"imagenes_productos\\/PendientesdePlataconAmatistas2023-11-21_10-02-53.jpeg\"]', '[\"100.00\",120]', '[\"120.00\",120]', '[4,\"4\"]', '[\"1.90\",1.9]', '[2,\"2\"]', '[3,3]', '[\"Estante 5, Fila D\",\"Estante 5, Fila D\"]', '[7,7]', 1, 64),
(46, 49, '[\"Reloj de Oro con Esmeraldas\",\"Reloj de Oro con Esmeraldas\"]', '[\"Reloj de oro con esmeraldas verdes en la esfera y la correa.\",\"Reloj de oro con esmeraldas verdes en la esfera y la correa.\"]', '[null,\"imagenes_productos\\/RelojdeOroconEsmeraldas2023-11-21_10-04-00.jpeg\"]', '[\"400.00\",450]', '[\"450.00\",450]', '[5,\"5\"]', '[\"9.20\",9.2]', '[1,\"1\"]', '[5,5]', '[\"Estante 6, Fila D\",\"Estante 6, Fila D\"]', '[11,11]', 1, 64),
(47, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\",\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,\"1\"]', '[\"3.60\",3.6]', '[3,\"3\"]', '[2,1]', '[\"Estante 2, Fila C\",\"Estante 2, Fila C\"]', '[28,28]', 1, 64),
(48, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\",\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,\"1\"]', '[\"3.60\",3.6]', '[3,\"3\"]', '[1,1]', '[\"Estante 2, Fila C\",\"Estante 2, Fila C\"]', '[28,28]', 1, 64),
(49, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\",\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,\"1\"]', '[\"3.60\",3.6]', '[3,\"3\"]', '[1,3]', '[\"Estante 2, Fila C\",\"Estante 2, Fila C\"]', '[28,28]', 1, 64),
(50, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\",\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,1]', '[\"3.60\",3.6]', '[3,3]', '[3,3]', '[\"Estante 2, Fila C\",\"Estante 2, Fila C\"]', '[28,17]', 1, 64),
(51, 45, '[\"Anillo de Platino con Esmeralda\",\"Anillo de Platino con Esmeralda\"]', '[\"Anillo de platino con una esmeralda verde en el centro.\",\"Anillo de platino con una esmeralda verde en el centro.\"]', '[\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\",\"imagenes_productos\\/AnillodePlatinoconEsmeralda2023-11-21_09-57-17.jpeg\"]', '[\"400.00\",400]', '[\"400.00\",400]', '[1,1]', '[\"3.60\",3.6]', '[3,3]', '[3,3]', '[\"Estante 2, Fila C\",\"Estante 2, Fila K\"]', '[17,17]', 1, 64),
(52, 50, '[\"Anillo de Plata con \\u00d3palo\",\"Anillo de Plata con \\u00d3palo\"]', '[\"Anillo de plata con un \\u00f3palo multicolor en el centro\",\"Anillo de plata con un \\u00f3palo multicolor en el centro\"]', '[null,\"imagenes_productos\\/AnillodePlatacon\\u00d3palo2023-11-21_10-40-59.jpeg\"]', '[\"60.00\",70]', '[\"70.00\",70]', '[1,1]', '[\"2.50\",2.5]', '[2,2]', '[1,1]', '[\"Estante 2, Fila B\",\"Estante 2, Fila B\"]', '[34,34]', 1, 64),
(53, 50, '[\"Anillo de Plata con \\u00d3palo\",\"Anillo de Plata con \\u00d3palo\"]', '[\"Anillo de plata con un \\u00f3palo multicolor en el centro\",\"Anillo de plata con un \\u00f3palo multicolor en el centro\"]', '[\"imagenes_productos\\/AnillodePlatacon\\u00d3palo2023-11-21_10-40-59.jpeg\",\"imagenes_productos\\/AnillodePlatacon\\u00d3palo2023-11-21_10-41-19.jpeg\"]', '[\"70.00\",70]', '[\"70.00\",70]', '[1,1]', '[\"2.50\",2.5]', '[2,2]', '[1,1]', '[\"Estante 2, Fila B\",\"Estante 2, Fila B\"]', '[34,34]', 1, 64),
(54, 50, '[\"Anillo de Plata con \\u00d3palo\",\"Anillo de Plata con \\u00d3palo\"]', '[\"Anillo de plata con un \\u00f3palo multicolor en el centro\",\"Anillo de plata con un \\u00f3palo multicolor en el centro\"]', '[\"imagenes_productos\\/AnillodePlatacon\\u00d3palo2023-11-21_10-41-19.jpeg\",\"imagenes_respaldo\\/AnillodePlatacon\\u00d3palo2023-11-21_10-41-19.jpeg\"]', '[\"70.00\",70]', '[\"70.00\",70]', '[1,1]', '[\"2.50\",2.5]', '[2,2]', '[1,1]', '[\"Estante 2, Fila B\",\"Estante 2, Fila B\"]', '[34,34]', 0, 64);
DELIMITER $$
CREATE TRIGGER `backup_insert_prdct` AFTER INSERT ON `respaldo_producto` FOR EACH ROW BEGIN
    INSERT INTO movimientos (fecha_movimiento, tabla, id_tabla_PK, id_tabla_r_PK, tipo_movimiento, id_usr)
    VALUES (NOW(), 'productos', NEW.id_producto_r, NEW.id, NEW.mov, NEW.MovByUsr);
END
$$
DELIMITER ;

CREATE TABLE IF NOT EXISTS `respaldo_proveedor` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_proveedor_r` int(11) UNSIGNED NOT NULL,
  `nom_empresa_r` varchar(150) NOT NULL,
  `p_contacto_r` varchar(210) NOT NULL,
  `dir_r` varchar(300) NOT NULL,
  `tel_r` varchar(30) NOT NULL,
  `email_r` varchar(150) NOT NULL,
  `mov` int(1) UNSIGNED NOT NULL,
  `MovByUsr` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `respaldo_proveedor` (`id`, `id_proveedor_r`, `nom_empresa_r`, `p_contacto_r`, `dir_r`, `tel_r`, `email_r`, `mov`, `MovByUsr`) VALUES
(17, 41, '[\"Joyer\\u00eda Moderna\",\"Iluminados de Minerales\"]', '[\"Sof\\u00eda S\\u00e1nchez\",\"Sof\\u00eda S\\u00e1nchez\"]', '[\"Boulevard de los zafiros 103\",\"Boulevard de los zafiros 103\"]', '[6672393823,6672393823]', '[\"sofia@joyeriamoderna.com\",\"sofia@joyeriamoderna.com\"]', 1, 43),
(18, 43, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 43),
(19, 49, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64),
(20, 48, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64),
(21, 47, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64),
(22, 46, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64),
(23, 45, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64),
(24, 44, '[\"prueba de pruebas pruebinas\",\"prueba de pruebas pruebinas\"]', '[\"PruebaPruebaPrueba\",\"PruebaPruebaPrueba\"]', '[\"blvd prueba av prueba\",\"blvd prueba av prueba\"]', '[1112223344,1112223344]', '[\"prueba.prueba@prueba.com\",\"prueba.prueba@prueba.com\"]', 0, 64);
DELIMITER $$
CREATE TRIGGER `backup_insert_prvr` AFTER INSERT ON `respaldo_proveedor` FOR EACH ROW BEGIN
    		INSERT INTO movimientos (fecha_movimiento, tabla, id_tabla_PK, id_tabla_r_PK, tipo_movimiento, id_usr)
    		VALUES (NOW(), 'proveedores', NEW.id_proveedor_r, NEW.id, NEW.mov, NEW.MovByUsr);
END
$$
DELIMITER ;

CREATE TABLE IF NOT EXISTS `respaldo_usuario` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_r` int(11) NOT NULL,
  `nombre_r` varchar(90) NOT NULL,
  `imagen_r` varchar(360) DEFAULT NULL,
  `pass_r` varchar(765) NOT NULL,
  `apellido_r` varchar(180) NOT NULL,
  `email_r` varchar(180) NOT NULL,
  `tel_r` varchar(30) NOT NULL,
  `sexo_r` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_perfil_r` varchar(33) NOT NULL,
  `mov` int(1) UNSIGNED NOT NULL,
  `MovByUsr` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `respaldo_usuario` (`id`, `id_r`, `nombre_r`, `imagen_r`, `pass_r`, `apellido_r`, `email_r`, `tel_r`, `sexo_r`, `id_perfil_r`, `mov`, `MovByUsr`) VALUES
(27, 81, '[\"Luis\",\"Luis\"]', '[null,\"imagen_usr\\/Luis2023-11-21_12-37-53.jpeg\"]', '[\"$2y$10$v2mqZL27i5n\\/KnH\\/0P6TBeOYOS.wzDkQUZfmJaXhsXUsVok58KdpK\",\"$2y$10$v2mqZL27i5n\\/KnH\\/0P6TBeOYOS.wzDkQUZfmJaXhsXUsVok58KdpK\"]', '[\"Mart\\u00ednez\",\"Mart\\u00ednez\"]', '[\"luis.martinez@email.com\",\"luis.martinez@email.com\"]', '[7652378744,7652378744]', '[\"m\",\"m\"]', '[0,0]', 1, 64),
(28, 80, '[\"Luis\",\"Luis\"]', '[null,\"imagen_usr\\/Luis2023-11-21_12-38-01.jpeg\"]', '[\"$2y$10$wU4ljW.kZuT1VMC2v6jrkO1kFKnT5ZyrP1X8WSeRPc5l7.aYbxjE6\",\"$2y$10$wU4ljW.kZuT1VMC2v6jrkO1kFKnT5ZyrP1X8WSeRPc5l7.aYbxjE6\"]', '[\"Hern\\u00e1ndez\",\"Hern\\u00e1ndez\"]', '[\"sofia.hernandez@email.com\",\"sofia.hernandez@email.com\"]', '[7652378743,7652378743]', '[\"m\",\"m\"]', '[0,0]', 1, 64),
(29, 76, '[\"Jos\\u00e9\",\"Jos\\u00e9\"]', '[null,\"imagen_usr\\/Jos\\u00e92023-11-21_12-38-10.jpeg\"]', '[\"$2y$10$T1.oNV3sx\\/R3oBlgBY5QyO4xe7EKlgBJoVrosjgeeMcjjY4s08OMm\",\"$2y$10$T1.oNV3sx\\/R3oBlgBY5QyO4xe7EKlgBJoVrosjgeeMcjjY4s08OMm\"]', '[\"Rodr\\u00edguez\",\"Rodr\\u00edguez\"]', '[\"jose.rodriguez@email.com\",\"jose.rodriguez@email.com\"]', '[7652378740,7652378740]', '[\"m\",\"m\"]', '[0,0]', 1, 64),
(30, 78, '[\"Carlos\",\"Carlos\"]', '[null,\"imagen_usr\\/Carlos2023-11-21_12-38-19.jpeg\"]', '[\"$2y$10$QBK5z.Xzv77JrsbbKd7zpOpAKXCjpawjCDKE7zmED\\/pfwNLaTt02m\",\"$2y$10$QBK5z.Xzv77JrsbbKd7zpOpAKXCjpawjCDKE7zmED\\/pfwNLaTt02m\"]', '[\"Gonz\\u00e1lez\",\"Gonz\\u00e1lez\"]', '[\"carlos.gonzalez@email.com\",\"carlos.gonzalez@email.com\"]', '[7652378742,7652378742]', '[\"m\",\"m\"]', '[0,0]', 1, 64);
DELIMITER $$
CREATE TRIGGER `backup_insert_usr` AFTER INSERT ON `respaldo_usuario` FOR EACH ROW BEGIN
    		INSERT INTO movimientos (fecha_movimiento, tabla, id_tabla_PK, id_tabla_r_PK, tipo_movimiento, id_usr)
    		VALUES (NOW(), 'usuarios', NEW.id_r, NEW.id, NEW.mov, NEW.MovByUsr);
END
$$
DELIMITER ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usr` varchar(30) NOT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `apellido_usr` varchar(30) NOT NULL,
  `email_usr` varchar(60) NOT NULL,
  `tel` bigint(10) UNSIGNED NOT NULL,
  `sexo` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `usuarios` (`id_usr`, `nombre_usr`, `imagen`, `contraseña`, `apellido_usr`, `email_usr`, `tel`, `sexo`, `id_perfil`) VALUES
(43, 'Juan', NULL, '$2y$10$SdskA0a/3hVA7cn75Ax0FOanRGaImfyhx8fm8zLhnRBe5nObADX0i', 'López', 'juan.lopez@email.com', 1234567890, 'm', 0),
(44, 'María', NULL, '$2y$10$QdtyqtgcJEQnfcAsVQckkO5oXA7JZFLb9UuwsKTqPTDD2QuCwSPEK', 'Rodríguez', 'maria.rodriguez@email.com', 2345678901, 'f', 0),
(45, 'Carlos', NULL, '$2y$10$1ccpXll7zny8BPyHzrGT6OLpSqQyX6AuvYtH/IbFWXlA5Fagp6Qky', 'Sánchez', 'carlos.sanchez@email.com', 3456789012, 'm', 0),
(46, 'Laura', NULL, '$2y$10$6M04SWJoRBrOL6krTPdW.OcntmbcwysrmajzmHYEbJ9QAwKVt5VeS', 'Martínez', 'laura.martinez@email.com', 4567890123, 'f', 0),
(47, 'Pedro', NULL, '$2y$10$w6mQKHdqL.3DKJpaoYhB.uTur/GZdl6KLSfD.KXzRcpHTVNC5Owtu', 'Gómez', 'pedro.gomez@email.com', 5678901234, 'm', 0),
(48, 'Ana', NULL, '$2y$10$gjRLv4dtGZSS8f5CF8Sa4uey4GFfHgC4gKgg0n8.wnjv68gBQkeUC', 'Pérez', 'ana.perez@email.com', 6789012345, 'f', 0),
(49, 'David', NULL, '$2y$10$mHZLgccoZ32VXIAd/Bhj.uc4WgqXjTTEK4JzNKtktdSO7VDL.0OVe', 'García', 'david.garcia@email.com', 7890123456, 'f', 0),
(50, 'Carmen', NULL, '$2y$10$ECxN3yRynm2p28ckNbgjoepUUw0DA/5ejhcSNn2sYr1sUQ.zIefZ6', 'López', 'carmen.lopez@email.com', 8901234567, 'f', 0),
(51, 'José', NULL, '$2y$10$7jUB/RhggKgSja26Tji2v.hxlRbDKWMR3dUWHceDjz/kV0250QUmq', 'Torres', 'jose.torres@email.com', 9012345678, 'm', 0),
(52, 'Marta', NULL, '$2y$10$e.3aWQLu5x/uQ.srwB/jNOY3MOLbGIW7hKZNKQ5ydktMLID.qvQUe', 'Rodríguez', 'marta.rodriguez@email.com', 1357924680, 'f', 1),
(53, 'Miguel', NULL, '$2y$10$wMMYggtuu9/iZOLgh2qViOD6RkhgTkYQ2F3pfqVaG8./ZABWGdBtq', 'Fernández', 'miguel.fernandez@email.com', 2468135790, 'm', 0),
(54, 'Elena', NULL, '$2y$10$B3mrVSHWUidhNg/5BonrCuLXXpLc/08wdW88/F5eXV.YqHMMuf7Dy', 'Ramírez', 'elena.ramirez@email.com', 8642097531, 'f', 0),
(55, 'Javier', NULL, '$2y$10$PM3Zm59a1YQDd7qaJhtya.pZUBL5I5wG5ChPTZXrbV6bgb4f5A4Ci', 'Soto', 'javier.soto@email.com', 9753108642, 'm', 0),
(56, 'Silvia', NULL, '$2y$10$2A/bjFRqqk0m36G6Y2urwe3Cfq.q7tVivj5J5Jy73qX.GnfAkokq2', 'Castro', 'silvia.castro@email.com', 1975320864, 'm', 0),
(57, 'Raúl', NULL, '$2y$10$V1vQa.5l8Quqam76Y4ETReFdmGsolC4x9/Ve.pkYQ8vOaiqDPqueK', 'Herrera', 'raul.herrera@email.com', 2097531086, 'm', 0),
(60, 'Juan', NULL, '$2y$10$DRkya2UoYSXToe3SUO0kw.aD4yKqly2fPeXh1W0c70crOmLNrG3tK', 'Vazquez', 'juan.vazquez@email.com', 9234561278, 'm', 0),
(63, 'Ana', NULL, '$2y$10$Zf6vmptP9nlvvmBha6tJ2.4.v.J/Elmxqjp2VBRHEhZgcGOWfOZ9u', 'Pérez', 'ana.perez@email.com', 7652378727, 'f', 1),
(64, 'Pedro', NULL, '$2y$10$9yqI0DYGEfR3iZb.8m6.k.hsT14Y0ntWpCjdCezCuAs7ylGQZNgq.', 'Sánchez', 'pedro.sanchez@email.com', 7652378728, 'm', 0),
(65, 'Laura', NULL, '$2y$10$mipmFJMXFh86ZynNo/iFrOhO4cKZ60xbxliZg0qjyGH73JorD.eom', 'Rodríguez', 'laura.rodriguez@email.com', 7652378729, 'f', 0),
(66, 'Carlos', NULL, '$2y$10$XQLfr460yoWGw/IzArtd/.sD3kC60QsnfFI5zhQD7/ahvQXgSg9vW', 'García', 'carlos.garcia@email.com', 7652378730, 'm', 0),
(67, 'Sofía', NULL, '$2y$10$Gl4aqokr0YkiRa9f/cVGueYIrNcFsguUg06ZCeIXSqFG9/VUe8SRe', 'González', 'sofia.gonzalez@email.com', 7652378731, 'f', 0),
(68, 'Luis', NULL, '$2y$10$ggyR7uriH2.dP7tE.IiIRuaU5E8wPeJ7Csr55gNADj.uUrVjJPAS6', 'Hernández', 'luis.hernandez@email.com', 7652378732, 'm', 0),
(69, 'Elena', NULL, '$2y$10$D2/6nyCG27cQK7hQVZbV..QdlbyGplt/Z7H9iE66tROHer7dNBbCS', 'Martínez', 'elena.martinez@email.com', 7652378733, 'f', 1),
(70, 'David', NULL, '$2y$10$LtffwBQeAEyyGr4DR7e5p.Sq6aEtVzvePJhwrz1QJyPhAUHV4tSou', 'Fernández', 'david.fernandez@email.com', 7652378734, 'm', 0),
(71, 'Sara', NULL, '$2y$10$yFCO3b8i74J4K7Aw3a6DP.y4tqjYIH6p0oGL0LNj6fBOB4b7iPYTm', 'López', 'sara.lopez@email.com', 7652378735, 'f', 0),
(72, 'Miguel', NULL, '$2y$10$vDTlGbMlj/SSXNPDCP3o3.cG5/m3sH4vwu2w2y2G8M/mA4KNbXQ9u', 'Gómez', 'miguel.gomez@email.com', 7652378736, 'm', 0),
(73, 'Jorge', NULL, '$2y$10$A.0fRNH59vKyUqde6H7IhOQZ64sIGbeQC1hrHoBzwPO1LjVqQyZTa', 'Sánchez', 'jorge.sanchez@email.com', 7652378737, 'm', 0),
(74, 'Ana', NULL, '$2y$10$nYHYLJCUohp5pDPbkz4ZtOvX/hlUei6oQ4RUmu3uc3nKx5qRrBjfC', 'García', 'ana.garcia@email.com', 7652378738, 'f', 0),
(75, 'María', NULL, '$2y$10$obNfMLd/qi1QwF23IXMiJe0sh77Gh0ta2C29cu/IOJ7YhVLjznRnS', 'López', 'maria.lopez@email.com', 7652378739, 'f', 0),
(76, 'José', 'imagen_usr/José2023-11-21_12-38-10.jpeg', '$2y$10$T1.oNV3sx/R3oBlgBY5QyO4xe7EKlgBJoVrosjgeeMcjjY4s08OMm', 'Rodríguez', 'jose.rodriguez@email.com', 7652378740, 'm', 0),
(77, 'Laura', NULL, '$2y$10$NPEGwskati5DD4Z1Yj7nTuQ.DaqbLSqrxq7GwLe542VIChzxubZOG', 'Pérez', 'laura.perez@email.com', 7652378741, 'f', 0),
(78, 'Carlos', 'imagen_usr/Carlos2023-11-21_12-38-19.jpeg', '$2y$10$QBK5z.Xzv77JrsbbKd7zpOpAKXCjpawjCDKE7zmED/pfwNLaTt02m', 'González', 'carlos.gonzalez@email.com', 7652378742, 'm', 0),
(79, 'Sofía', NULL, '$2y$10$zHeA3onSwM8h/iCBGaCqs.wLr4EVwkw7lT7aaINDTjkrL1Gv3q5t.', 'Hernández', 'sofia.hernandez@email.com', 7652378743, 'f', 0),
(80, 'Luis', 'imagen_usr/Luis2023-11-21_12-38-01.jpeg', '$2y$10$wU4ljW.kZuT1VMC2v6jrkO1kFKnT5ZyrP1X8WSeRPc5l7.aYbxjE6', 'Hernández', 'sofia.hernandez@email.com', 7652378743, 'm', 0),
(81, 'Luis', 'imagen_usr/Luis2023-11-21_12-37-53.jpeg', '$2y$10$v2mqZL27i5n/KnH/0P6TBeOYOS.wzDkQUZfmJaXhsXUsVok58KdpK', 'Martínez', 'luis.martinez@email.com', 7652378744, 'm', 0),
(82, 'Elena', NULL, '$2y$10$AlwQ4CLCvtyJOf9haFKeAuLDewpWGn4NcPqx2Hnd1mC8vOTjheplq', 'Fernández', 'elena.fernandez@email.com', 7652378745, 'f', 0);


ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
