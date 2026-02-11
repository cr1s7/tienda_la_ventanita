-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2026 a las 20:45:37
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
(1, 'Lácteos y refrigerados'),
(3, 'Bebidas, pasabocas y dulces'),
(4, 'Panaderia'),
(5, 'Granos'),
(7, 'Enlatados'),
(8, 'Proteínas'),
(9, 'Frutas y verduras'),
(11, 'Productos de aseo'),
(14, 'Mundo Mascotas');

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
(1, 'leche alqueria'),
(2, 'alpina'),
(3, 'postobon'),
(4, 'coca-cola'),
(6, 'bimbo'),
(7, 'ramo'),
(8, 'margarita'),
(9, 'van camps'),
(10, 'huevos oro'),
(11, 'cafe sello rojo'),
(12, 'ariel'),
(13, 'familia'),
(14, 'dog chow'),
(17, 'postobon'),
(18, 'Sin marca');

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
  `idMarca` int(11) DEFAULT NULL,
  `destacado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `preUnitario`, `stock`, `foto`, `idCategoria`, `idUnidad_medida`, `idMarca`, `destacado`) VALUES
(2, 'pechuga de pollo', 8000, 5, NULL, NULL, NULL, NULL, 0),
(3, 'cerveza', 2800, 8, NULL, NULL, NULL, NULL, 0),
(4, 'ponque ramo', 7000, 5, NULL, NULL, NULL, NULL, 0),
(5, 'arroz', 2800, 15, NULL, 5, 5, 11, 1),
(6, 'frijol', 3200, 15, NULL, 5, 5, 18, 1),
(7, 'papas margarita', 3000, 10, NULL, 3, 10, 8, 1),
(8, 'atun en lata', 8000, 7, NULL, 7, 1, 9, 1),
(10, 'libra de papa', 2500, 50, NULL, 9, 5, 18, NULL),
(12, 'escoba', 10000, 4, NULL, 11, 1, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_destacados`
--

CREATE TABLE `productos_destacados` (
  `id_destacado` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_en_oferta`
--

CREATE TABLE `productos_en_oferta` (
  `id_oferta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio_oferta` decimal(10,2) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'cliente');

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
  `password` varchar(255) NOT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `numDocumento`, `nombre`, `direccion`, `telefono`, `email`, `password`, `tipo_documento`, `idRol`) VALUES
(40, 1106634150, 'casadooo', 'oviedo', '3150034585', 'messi@gmail.com', '$2y$10$vlKOC788606oRgc9bd4cqObZ4BIYkAY3xzd2GQvHGZLvohPAFExZi', 1, 1),
(42, 4567, 'goku', 'cali', '0931', 'miguel@gmail.com', '$2y$10$tjs4gZeHDCdvVbyfPnwsFuOzg9F5FoiFHKlG9Op.mn5VbiK4s8R42', 1, 1),
(43, 789, 'juan', 'bogota', '123', 'juan@gmail.com', '$2y$10$I.MZDDdaenwE2xNU9UzAzOWRnxY4SbiYEly/JoVsJpx68ptQnaNc.', 1, 2);

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
-- Indices de la tabla `productos_destacados`
--
ALTER TABLE `productos_destacados`
  ADD PRIMARY KEY (`id_destacado`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `productos_en_oferta`
--
ALTER TABLE `productos_en_oferta`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `idProducto` (`idProducto`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `TipoDocumento` (`tipo_documento`),
  ADD KEY `rol_fk` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos_destacados`
--
ALTER TABLE `productos_destacados`
  MODIFY `id_destacado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_en_oferta`
--
ALTER TABLE `productos_en_oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
-- Filtros para la tabla `productos_destacados`
--
ALTER TABLE `productos_destacados`
  ADD CONSTRAINT `productos_destacados_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `productos_en_oferta`
--
ALTER TABLE `productos_en_oferta`
  ADD CONSTRAINT `productos_en_oferta_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

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
