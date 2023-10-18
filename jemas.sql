SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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
  `id_proveedor` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `productos` (`id_producto`, `nombre_producto`, `Descripcion_producto`, `imagen`, `precio_compra`, `precio_venta`, `categoria`, `peso`, `tipo_material`, `cantidad_disponible`, `ubicacion_almacen`, `id_proveedor`) VALUES
(4, 'Anillo de Diamante Clásico', 'Anillo de oro con un hermoso diamante en el centro.', 'imagenes_productos/Imagen1.jpg', 500.00, 500.00, 'Anillo', 3, 'Oro', 20, 'Estante 1, Fila A', 5),
(5, 'Anillo de Plata con Zafiro', 'Anillo de plata con un zafiro azul en la parte superior.', 'imagenes_productos/Imagen2.jpg', 75.00, 150.00, 'Anillo', 2, 'Plata', 15, 'Estante 2, Fila B', 0),
(6, 'Anillo de Compromiso de Platino', 'Elegante anillo de compromiso de platino con un diamante central.', 'imagenes_productos/Imagen3.jpg', 400.00, 800.00, 'Anillo', 4, 'Platino', 10, 'Estante 3, Fila C', 0),
(7, 'Anillo de Oro Rosa con Esmeralda', 'Anillo de oro rosa con una esmeralda verde en el centro', 'imagenes_productos/Imagen4.jpg', 150.00, 300.00, 'Anillo', 2, 'Oro', 12, 'Estante 4, Fila D', 0),
(8, 'Anillo de Oro con Rubí', 'Anillo de oro con un rubí rojo en la parte superior', 'imagenes_productos/Imagen5.jpg', 200.00, 400.00, 'Anillo', 3, 'Oro', 18, 'Estante 5, Fila E', 0),
(10, 'Collar de Perlas Blancas', 'Collar de perlas blancas con cierre de oro.', 'imagenes_productos/Imagen6.jpg', 100.00, 200.00, 'Collar', 4, 'Oro', 10, 'Estante 11, Fila K', 0),
(11, 'Colgante de Corazón de Plata', 'Colgante en forma de corazón de plata', 'imagenes_productos/Imagen7.jpg', 25.00, 50.00, 'Collar', 2, 'Plata', 25, 'Estante 12, Fila L', 0),
(13, 'Collar con Diamante y Zafiro', 'Collar de oro con un diamante y un zafiro.\r\n \r\n', 'imagenes_productos/Imagen8.jpg', 175.00, 350.00, 'Collar', 5, 'Oro', 8, 'Estante 13, Fila M', 0),
(14, 'Colgante de Cruz de Oro', 'Colgante en forma de cruz de oro.', 'imagenes_productos/Imagen9.jpg', 35.00, 70.00, 'Collar', 2, 'Oro', 18, 'Estante 14, Fila N', 0),
(15, 'Collar de Platino con Diamante', 'Collar de platino con un diamante en el colgante', 'imagenes_productos/Imagen10.jpg', 300.00, 600.00, 'Collar', 4, 'Platino', 12, 'Estante 15, Fila O', 0),
(16, 'Pulsera de Oro con Diamantes', 'Pulsera de oro con incrustaciones de diamantes.', 'imagenes_productos/Imagen11.jpg', 175.00, 350.00, 'Pulsera', 7, 'Oro', 14, 'Estante 16, Fila P', 0),
(17, 'Pulsera de Plata Elegante', 'Pulsera de plata con un diseño elegante.', 'imagenes_productos/Imagen12.jpg', 60.00, 120.00, 'Pulsera', 6, 'Plata', 20, 'Estante 17, Fila Q', 0),
(18, 'Pulsera de Oro Amarillo con Perlas', 'Pulsera de oro amarillo con perlas blancas.', 'imagenes_productos/Imagen13.jpg', 125.00, 250.00, 'Pulsera', 8, 'Oro', 8, 'Estante 18, Fila R', 0),
(20, 'Pulsera de Plata con Zafiros', 'Pulsera de plata con zafiros azules', 'imagenes_productos/Imagen14.jpg', 90.00, 180.00, 'Pulsera', 7, 'Plata', 16, 'Estante 19, Fila S', 0),
(21, 'Pulsera de Oro Rosa con Diamantes', 'Pulsera de oro rosa con diamantes en el cierre', 'imagenes_productos/Imagen15.jpg', 140.00, 280.00, 'Pulsera', 6, 'Oro', 12, 'Estante 20, Fila T', 0),
(22, 'Pendientes de Diamante Brillante', 'Pendientes de oro con diamantes brillantes', 'imagenes_productos/Imagen16.jpg', 150.00, 300.00, 'Pulsera', 2, 'Oro', 12, 'Estante 21, Fila U', 0),
(23, 'Pendientes de Plata con Perlas', 'Pendientes de plata con perlas blancas.', 'imagenes_productos/Imagen17.jpg', 40.00, 80.00, 'Pulsera', 1, 'Plata', 20, 'Estante 22, Fila V', 0),
(24, 'Pendientes de Oro Rosa con Zafiros', 'Pendientes de oro rosa con zafiros azules.', 'imagenes_productos/Imagen18.jpg', 110.00, 220.00, 'Pulsera', 2, 'Oro', 15, 'Estante 23, Fila W', 0),
(25, 'Pendientes de Platino con Esmeraldas', 'Pendientes de platino con esmeraldas verdes', 'imagenes_productos/Imagen19.jpg', 200.00, 400.00, 'Pulsera', 3, 'Platino', 8, 'Estante 24, Fila X', 0),
(26, 'Pendientes de Oro con Rubíes', 'Pendientes de oro con rubíes rojos.', 'imagenes_productos/Imagen20.jpg', 560.00, 560.00, 'Pulsera', 2, 'Oro', 14, 'Estante 25, Fila Y', 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
