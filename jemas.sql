-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 04:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jemas`
--

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre_perfil` varchar(30) NOT NULL,
  `descripcion_perfil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
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
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `Descripcion_producto`, `imagen`, `precio_compra`, `precio_venta`, `categoria`, `peso`, `tipo_material`, `cantidad_disponible`, `ubicacion_almacen`, `id_proveedor`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_empresa` varchar(50) NOT NULL,
  `persona_contacto` varchar(70) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `num_telefono` int(10) UNSIGNED NOT NULL,
  `email_proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usr` int(11) NOT NULL,
  `nombre_usr` varchar(30) NOT NULL,
  `contraseña` varchar(40) NOT NULL,
  `apellido_usr` varchar(30) NOT NULL,
  `email_usr` varchar(60) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
