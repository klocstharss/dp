-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2025 a las 15:24:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `detalle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `detalle`) VALUES
(1, 'Electrónicos', 'Productos electrónicos y gadgets'),
(2, 'Ropa', 'Prendas de vestir variadas'),
(3, 'Alimentos', 'Productos alimenticios envasados'),
(4, 'Hogar', 'Artículos para el hogar'),
(5, 'Juguetes', 'Juguetes para niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `id_trabajador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_producto`, `cantidad`, `precio`, `id_trabajador`) VALUES
(1, 1, 10, 900.00, 7),
(2, 2, 50, 25.00, 7),
(3, 3, 100, 3.50, 7),
(4, 4, 20, 35.00, 7),
(5, 5, 30, 15.00, 7),
(6, 6, 5, 1300.00, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_venta`, `id_producto`, `cantidad`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 3),
(3, 2, 3, 10),
(4, 3, 4, 1),
(5, 4, 5, 5),
(6, 5, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `monto` decimal(6,2) DEFAULT NULL,
  `metodo_pago` varchar(20) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_venta`, `fecha_hora`, `monto`, `metodo_pago`, `estado`) VALUES
(1, 1, '2025-10-01 09:05:00', 2059.97, 'Tarjeta', 1),
(2, 2, '2025-10-01 09:35:00', 45.00, 'Efectivo', 1),
(3, 3, '2025-10-01 10:05:00', 39.99, 'Transferencia', 1),
(4, 4, '2025-10-01 10:35:00', 99.95, 'Tarjeta', 1),
(5, 5, '2025-10-01 11:05:00', 1499.99, 'Efectivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nro_identidad` varchar(11) NOT NULL,
  `razon_social` varchar(130) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `cod_postal` int(5) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `rol` varchar(15) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `fecha_reg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nro_identidad`, `razon_social`, `telefono`, `correo`, `departamento`, `provincia`, `distrito`, `cod_postal`, `direccion`, `rol`, `password`, `estado`, `fecha_reg`) VALUES
(1, '12345678', 'Proveedor A SAC', '987654321', 'proveedor_a@gmail.com', 'Lima', 'Lima', 'Miraflores', 15074, 'Av. Principal 123', 'proveedor', '12345678', 1, '2025-10-01 08:00:00'),
(2, '23456789', 'Proveedor B EIRL', '987654322', 'proveedor_b@gmail.com', 'Arequipa', 'Arequipa', 'Cercado', 4001, 'Calle Comercio 456', 'proveedor', '$2y$10$def456...', 1, '2025-10-01 08:05:00'),
(3, '34567890', 'Proveedor C SRL', '987654323', 'proveedor_c@gmail.com', 'Cusco', 'Cusco', 'Cusco', 8000, 'Jr. Independencia 789', 'proveedor', '$2y$10$ghi789...', 1, '2025-10-01 08:10:00'),
(4, '45678901', 'Proveedor D SA', '987654324', 'proveedor_d@gmail.com', 'Piura', 'Piura', 'Piura', 20001, 'Av. Grau 101', 'proveedor', '$2y$10$jkl012...', 1, '2025-10-01 08:15:00'),
(5, '56789012', 'Proveedor E SAC', '987654325', 'proveedor_e@gmail.com', 'Trujillo', 'Trujillo', 'Trujillo', 13001, 'Calle Libertad 202', 'proveedor', '$2y$10$mno345...', 1, '2025-10-01 08:20:00'),
(6, '67890123', 'Juan Pérez', '912345678', 'juan.perez@gmail.com', 'Lima', 'Lima', 'San Isidro', 15073, 'Av. Arequipa 456', 'cliente', '$2y$10$pqr678...', 1, '2025-10-01 08:25:00'),
(7, '78901234', 'María Gómez', '912345679', 'maria.gomez@gmail.com', 'Lima', 'Lima', 'Surco', 15023, 'Av. Benavides 789', 'vendedor', '$2y$10$stu901...', 1, '2025-10-01 08:30:00'),
(8, '89012345', 'Admin Sistema', '912345680', 'admin@gmail.com', 'Lima', 'Lima', 'Lima', 15001, 'Jr. de la Unión 123', 'admin', '$2y$10$vwx234...', 1, '2025-10-01 08:35:00'),
(40, '1', '234234 ', '3424', '234234@gmail.com', '234234', '234234', '234234', 9098, '234234', 'user', '$2y$10$YFSjayJ6tSplGJNi2ye9g.xIjqSKZY4TBtky1jrT5kkO8d6riTAu2', 1, '2025-07-22 08:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `stock` int(5) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `detalle`, `precio`, `stock`, `id_categoria`, `fecha_vencimiento`, `imagen`, `id_proveedor`) VALUES
(1, 'P001', 'Smartphone X', 'Teléfono inteligente 128GB', 999.99, 50, 1, NULL, 'smartphone.jpg', 1),
(2, 'P002', 'Camiseta Algodón', 'Camiseta talla M color azul', 29.99, 100, 2, NULL, 'camiseta.jpg', 2),
(3, 'P003', 'Arroz Premium', 'Arroz blanco 1kg', 4.50, 200, 3, '2026-10-01', 'arroz.jpg', 3),
(4, 'P004', 'Lámpara LED', 'Lámpara de escritorio 10W', 39.99, 30, 4, NULL, 'lampara.jpg', 4),
(5, 'P005', 'Peluche Osito', 'Peluche de 30cm', 19.99, 80, 5, NULL, 'peluche.jpg', 5),
(6, 'P006', 'Laptop Pro', 'Laptop 16GB RAM', 1499.99, 20, 1, NULL, 'laptop.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `fecha_hora_inicio` datetime DEFAULT NULL,
  `fecha_hora_fin` datetime DEFAULT NULL,
  `token` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id`, `id_persona`, `fecha_hora_inicio`, `fecha_hora_fin`, `token`, `ip`) VALUES
(1, 8, '2025-10-01 08:00:00', NULL, 'abc123', '192.168.1.1'),
(2, 7, '2025-10-01 08:15:00', NULL, 'def456', '192.168.1.2'),
(3, 6, '2025-10-01 08:30:00', NULL, 'ghi789', '192.168.1.3'),
(4, 8, '2025-10-01 09:00:00', '2025-10-01 09:30:00', 'jkl012', '192.168.1.4'),
(5, 7, '2025-10-01 09:15:00', NULL, 'mno345', '192.168.1.5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `codigo`, `fecha_hora`, `id_cliente`, `id_vendedor`, `estado`) VALUES
(1, 'V001', '2025-10-01 09:00:00', 6, 7, 1),
(2, 'V002', '2025-10-01 09:30:00', 6, 7, 1),
(3, 'V003', '2025-10-01 10:00:00', 6, 7, 1),
(4, 'V004', '2025-10-01 10:30:00', 6, 7, 1),
(5, 'V005', '2025-10-01 11:00:00', 6, 7, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nro_identidad` (`nro_identidad`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_trabajador`) REFERENCES `persona` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `persona` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `persona` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
