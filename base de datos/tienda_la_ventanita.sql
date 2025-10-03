-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2025 a las 00:31:38
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
  `fechaIngreso` varchar(20) DEFAULT NULL,
  `cantidadIngreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradainventario`
--

INSERT INTO `entradainventario` (`idEntrada`, `idProducto`, `idUsuario`, `fechaIngreso`, `cantidadIngreso`) VALUES
(1, 1, 8, '2025-10-03', 15),
(2, 5, 9, '2025-04-16', 20),
(3, 7, 13, '2025-05-17', 15),
(4, 4, 17, '2025-09-20', 6),
(5, 3, 18, '2025-08-18', 4),
(6, 11, 19, '2025-12-16', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaEmision` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `idUsuario`, `fechaEmision`, `total`) VALUES
(1, 8, '01-08-24', 8000),
(2, 11, '2025-05-31', 7000),
(3, 12, '2025-06-08', 9000),
(4, 14, '2025-06-24', 24000),
(5, 15, '2025-05-13', 5000),
(6, 16, '2025-11-07', 3200),
(7, 9, '2025-10-26', 16000),
(8, 13, '2025-07-06', 18000),
(9, 17, '2025-03-23', 8400),
(10, 18, '2025-08-04', 8000),
(11, 19, '2025-07-27', 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `uniMedida` varchar(8) DEFAULT NULL,
  `preUnitario` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `marca` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `categoria`, `uniMedida`, `preUnitario`, `stock`, `foto`, `marca`) VALUES
(1, 'leche', 'lacteos', 'litros', 4000, 10, NULL, 'colanta'),
(2, 'pechuga de pollo', 'carnico', 'kilos', 8000, 5, NULL, 'macpollo'),
(3, 'cerveza', 'bebidas', '300 ml', 2800, 8, NULL, 'poker'),
(4, 'ponque ramo', 'panaderia', '230 g', 7000, 5, NULL, 'ramo'),
(5, 'arroz', 'granos', '500 g', 2800, 15, NULL, 'diana'),
(6, 'frijol', 'granos', '500 g', 3200, 15, NULL, 'diana'),
(7, 'papas margarita', 'snacks', '50 g', 3000, 10, NULL, 'margarita'),
(8, 'atun en lata', 'enlatados', '160 g', 8000, 7, NULL, 'van camps'),
(9, 'cubeta de huevos', 'proteinas', '30 und', 18000, 8, NULL, 'huevos oro'),
(10, 'libra de papa', 'verduras', 'libra', 2500, 50, NULL, 'campo'),
(11, 'jabon de baño', 'aseo personal', '110 g', 2500, 10, NULL, 'palmolive'),
(12, 'escoba', 'aseo del hogar', 'unidad', 12000, 5, NULL, 'vanyplas'),
(13, 'concentrado perro', 'mascotas', '475 g', 4600, 7, NULL, 'dog chow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `numDocumento` int(11) DEFAULT NULL,
  `tipoDocumento` varchar(5) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contraseña` varchar(10) DEFAULT NULL,
  `rol` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `numDocumento`, `tipoDocumento`, `nombre`, `direccion`, `telefono`, `email`, `contraseña`, `rol`) VALUES
(8, 123, 'CC', 'juan', 'limon', '3150575304', NULL, 'juan123', 'proveedor'),
(9, 456, 'TI', 'miguel', 'salado', '3134416859', NULL, 'miguel456', 'proveedor'),
(10, 789, 'CC', 'angie', 'cantabria', '3177558122', 'angie@gmail.com', 'angie789', 'administrador'),
(11, 987, 'CC', 'cristiano', 'salado', '3150034585', 'cris@gmail.com', 'cris321', 'cliente'),
(12, 654, 'CC', 'cristian', 'modelia', '3204985678', 'cricaicedo@gmail.com', 'cristian65', 'cliente'),
(13, 321, 'CC', 'nicholas', 'la pola', '3205083570', NULL, 'nich321', 'proveedor'),
(14, 111, 'TI', 'rosmira', 'salado', '3165442993', 'rosmira@gmail.com', 'rosmira111', 'cliente'),
(15, 222, 'CC', 'maria', 'portales', '3178614700', 'maria@gmail.com', 'maria222', 'cliente'),
(16, 333, 'CC', 'carlos', 'limon', '3102785624', 'carlos@gmail.com', 'carlos333', 'cliente'),
(17, 444, 'CC', 'yan', 'jordan', '31355573614', NULL, 'yan444', 'proveedor'),
(18, 555, 'CC', 'gerardo', 'simon bolivar', '3156233567', NULL, 'gerardo555', 'proveedor'),
(19, 666, 'CC', 'orlando', 'modelia', '3165558133', NULL, 'orlando666', 'proveedor');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
