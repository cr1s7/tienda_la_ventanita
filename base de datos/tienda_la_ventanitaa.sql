-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2025 a las 22:56:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_la_ventanita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`) VALUES
(1, 'lacteos'),
(2, 'carnes'),
(3, 'bebidas'),
(4, 'panaderia'),
(5, 'granos'),
(6, 'snacks'),
(7, 'enlatados'),
(8, 'proteinas'),
(9, 'verduras'),
(10, 'aseo personal'),
(11, 'aseo del hogar'),
(12, 'mascotas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida`
--

CREATE TABLE `detalle_salida` (
  `idDetalle` int(11) NOT NULL,
  `idFactura` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `cantiSalida` int(11) DEFAULT NULL,
  `valorUnitario` int(11) DEFAULT NULL,
  `totalVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`idDetalle`, `idFactura`, `idProducto`, `cantiSalida`, `valorUnitario`, `totalVenta`) VALUES
(1, 1, 1, 2, 4000, 8000),
(2, 2, 4, 1, 7000, 7000),
(3, 3, 7, 3, 3000, 9000),
(4, 4, 12, 2, 12000, 24000),
(5, 5, 11, 2, 2500, 5000),
(6, 6, 6, 1, 3200, 3200),
(7, 7, 8, 2, 8000, 16000),
(8, 8, 9, 1, 18000, 18000),
(9, 9, 5, 3, 2800, 8400),
(10, 10, 2, 1, 8000, 8000),
(11, 11, 10, 1, 2500, 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradainventario`
--

CREATE TABLE `entradainventario` (
  `idEntrada` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaIngreso` datetime(6) DEFAULT NULL,
  `cantidadIngreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradainventario`
--

INSERT INTO `entradainventario` (`idEntrada`, `idProducto`, `idUsuario`, `fechaIngreso`, `cantidadIngreso`) VALUES
(1, 1, 8, '2025-10-03 00:00:00.000000', 15),
(2, 5, 9, '2025-04-16 00:00:00.000000', 20),
(3, 7, 13, '2025-05-17 00:00:00.000000', 15),
(4, 4, 17, '2025-09-20 00:00:00.000000', 6),
(5, 3, 18, '2025-08-18 00:00:00.000000', 4),
(6, 11, 19, '2025-12-16 00:00:00.000000', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaEmision` datetime(6) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `idUsuario`, `fechaEmision`, `total`) VALUES
(1, 8, '0000-00-00 00:00:00.000000', 8000),
(2, 11, '0000-00-00 00:00:00.000000', 7000),
(3, 12, '0000-00-00 00:00:00.000000', 9000),
(4, 14, '0000-00-00 00:00:00.000000', 24000),
(5, 15, '0000-00-00 00:00:00.000000', 5000),
(6, 16, '0000-00-00 00:00:00.000000', 3200),
(7, 9, '0000-00-00 00:00:00.000000', 16000),
(8, 13, '0000-00-00 00:00:00.000000', 18000),
(9, 17, '0000-00-00 00:00:00.000000', 8400),
(10, 18, '0000-00-00 00:00:00.000000', 8000),
(11, 19, '0000-00-00 00:00:00.000000', 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `idMarca` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`idMarca`, `nombre`) VALUES
(1, 'colanta'),
(2, 'alpina'),
(3, 'postobon'),
(4, 'coca-cola'),
(5, 'diana'),
(6, 'bimbo'),
(7, 'ramo'),
(8, 'margarita'),
(9, 'van camps'),
(10, 'huevos oro'),
(11, 'cafe sello rojo'),
(12, 'ariel'),
(13, 'familia'),
(14, 'dog chow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `preUnitario` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idUnidad_medida` int(11) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `preUnitario`, `stock`, `foto`, `idCategoria`, `idUnidad_medida`, `idMarca`) VALUES
(1, 'leche', 4000, 10, NULL, NULL, NULL, NULL),
(2, 'pechuga de pollo', 8000, 5, NULL, NULL, NULL, NULL),
(3, 'cerveza', 2800, 8, NULL, NULL, NULL, NULL),
(4, 'ponque ramo', 7000, 5, NULL, NULL, NULL, NULL),
(5, 'arroz', 2800, 15, NULL, NULL, NULL, NULL),
(6, 'frijol', 3200, 15, NULL, NULL, NULL, NULL),
(7, 'papas margarita', 3000, 10, NULL, NULL, NULL, NULL),
(8, 'atun en lata', 8000, 7, NULL, NULL, NULL, NULL),
(9, 'cubeta de huevos', 18000, 8, NULL, NULL, NULL, NULL),
(10, 'libra de papa', 2500, 50, NULL, NULL, NULL, NULL),
(11, 'jabon de baño', 2500, 10, NULL, NULL, NULL, NULL),
(12, 'escoba', 12000, 5, NULL, NULL, NULL, NULL),
(13, 'concentrado perro', 4600, 7, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`) VALUES
(1, 'administrador'),
(2, 'cliente'),
(3, 'proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `nombreDocumento` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `nombreDocumento`) VALUES
(1, 'CC'),
(2, 'TI'),
(3, 'RC'),
(4, 'VISA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `idUnidad` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`idUnidad`, `nombre`) VALUES
(1, 'unidad'),
(2, 'litros'),
(3, 'mililitros'),
(4, 'kilos'),
(5, 'gramos'),
(6, 'paquete'),
(7, 'caja'),
(8, 'botella'),
(9, 'lata'),
(10, 'bolsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `numDocumento` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contraseña` varchar(10) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `numDocumento`, `nombre`, `direccion`, `telefono`, `email`, `contraseña`, `tipo_documento`, `idRol`) VALUES
(8, 123, 'juan', 'limon', '3150575304', NULL, 'juan123', NULL, NULL),
(9, 456, 'miguel', 'salado', '3134416859', NULL, 'miguel456', NULL, NULL),
(10, 789, 'angie', 'cantabria', '3177558122', 'angie@gmail.com', 'angie789', NULL, NULL),
(11, 987, 'cristiano', 'salado', '3150034585', 'cris@gmail.com', 'cris321', NULL, NULL),
(12, 654, 'cristian', 'modelia', '3204985678', 'cricaicedo@gmail.com', 'cristian65', NULL, NULL),
(13, 321, 'nicholas', 'la pola', '3205083570', NULL, 'nich321', NULL, NULL),
(14, 111, 'rosmira', 'salado', '3165442993', 'rosmira@gmail.com', 'rosmira111', NULL, NULL),
(15, 222, 'maria', 'portales', '3178614700', 'maria@gmail.com', 'maria222', NULL, NULL),
(16, 333, 'carlos', 'limon', '3102785624', 'carlos@gmail.com', 'carlos333', NULL, NULL),
(17, 444, 'yan', 'jordan', '31355573614', NULL, 'yan444', NULL, NULL),
(18, 555, 'gerardo', 'simon bolivar', '3156233567', NULL, 'gerardo555', NULL, NULL),
(19, 666, 'orlando', 'modelia', '3165558133', NULL, 'orlando666', NULL, NULL),
(28, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL),
(31, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idFactura` (`idFactura`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `entradainventario`
--
ALTER TABLE `entradainventario`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categorias_fk` (`idCategoria`),
  ADD KEY `marca_fk` (`idMarca`),
  ADD KEY `unimedida_fk` (`idUnidad_medida`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`idUnidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `TipoDocumento` (`tipo_documento`),
  ADD KEY `rol_fk` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `entradainventario`
--
ALTER TABLE `entradainventario`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `idUnidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  ADD CONSTRAINT `detalle_salida_ibfk_1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `detalle_salida_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `entradainventario`
--
ALTER TABLE `entradainventario`
  ADD CONSTRAINT `entradainventario_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `entradainventario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categorias_fk` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `marca_fk` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`),
  ADD CONSTRAINT `unimedida_fk` FOREIGN KEY (`idUnidad_medida`) REFERENCES `unidad_medida` (`idUnidad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `TipoDocumento` FOREIGN KEY (`tipo_documento`) REFERENCES `tipodocumento` (`id`),
  ADD CONSTRAINT `rol_fk` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
