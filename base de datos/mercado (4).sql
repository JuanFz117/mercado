-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2025 a las 18:26:26
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id_almacen` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`id_almacen`, `nombre`, `direccion`, `latitud`, `longitud`, `foto`) VALUES
(1, 'juan', 'Bogota', '99.99999999', '999.99999999', 'uploads/2016-10-03.jpg'),
(2, 'juan', '223', '99.99999999', '999.99999999', 'uploads/Roscon-dulce.webp'),
(3, 'juan', 'cr 61 A sur 6 - 71', '4.12781000', '-73.63447700', 'uploads/2016-10-03.jpg'),
(4, 'yy', 'daf', '4.12781000', '-73.63447700', 'uploads/2019-11-01.jpg'),
(5, 'darwin', '61 48', '4.12781000', '-73.63447700', 'uploads/icone-de-broche-de-localisation-verte.png'),
(6, 'juan', 'Bogota', '4.12781000', '-73.63447700', 'uploads/2017-05-09 (2).jpg'),
(7, 'Tata', 'calle 33', '4.12781000', '-73.63447700', NULL),
(8, 'Sofi', 'calle 33B', '4.14453500', '-73.63936300', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id_detalle` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total_producto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`id_detalle`, `id_orden`, `id_producto`, `cantidad`, `precio_unitario`, `total_producto`) VALUES
(1, 4, 4, 3, '0.00', '0.00'),
(2, 5, 4, 3, '0.00', '0.00'),
(3, 6, 4, 3, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra`
--

CREATE TABLE `ordenes_compra` (
  `id_orden` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Procesada','Cancelada') COLLATE utf8mb4_bin DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `ordenes_compra`
--

INSERT INTO `ordenes_compra` (`id_orden`, `id_proveedor`, `fecha`, `total`, `estado`) VALUES
(1, 1, '2025-04-09', '300.00', 'Procesada'),
(2, 1, '2025-04-09', '300.00', 'Procesada'),
(3, 1, '2025-04-09', '300.00', 'Procesada'),
(4, 1, '2025-04-09', '300.00', 'Procesada'),
(5, 1, '2025-04-09', '300.00', 'Procesada'),
(6, 1, '2025-04-09', '300.00', 'Procesada'),
(7, 1, '2025-04-09', '0.00', 'Procesada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `contacto_interno` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `telefono_contacto` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `email_contacto` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `contacto_interno`, `telefono_contacto`, `email_contacto`, `direccion`, `ciudad`, `pais`, `observaciones`) VALUES
(1, 'Juanchistos pizza', 'Juan el papi', '3015175203', 'davidvivienda2@gmail.com', 'cr 61 A sur 6-71', 'villavicencio', 'Colombia', 'muy ocupado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `detalle_orden_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes_compra` (`id_orden`),
  ADD CONSTRAINT `detalle_orden_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD CONSTRAINT `ordenes_compra_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
