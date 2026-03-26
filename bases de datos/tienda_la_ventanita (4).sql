-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2026 a las 19:01:54
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idCarrito`, `idUsuario`, `fecha`, `estado`) VALUES
(19, 42, '2026-03-20 14:38:28', 'activo'),
(20, 51, '2026-03-20 16:56:29', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_detalle`
--

CREATE TABLE `carrito_detalle` (
  `idDetalle` int(11) NOT NULL,
  `idCarrito` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'Bebidas, pasabocas y dulcesss'),
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

--
-- Volcado de datos para la tabla `detalle_salida`
--

INSERT INTO `detalle_salida` (`idDetalle`, `idFactura`, `idProducto`, `cantiSalida`, `valorUnitario`, `totalVenta`) VALUES
(37, 34, 8, 1, 8000, 8000),
(38, 34, 10, 1, 2500, 2500),
(39, 34, 3, 1, 2800, 2800),
(42, 36, 8, 1, 8000, 8000),
(43, 37, 8, 1, 8000, 8000),
(44, 37, 7, 4, 3000, 12000),
(45, 38, 10, 1, 2500, 2500),
(46, 39, 10, 1, 2500, 2500),
(47, 40, 10, 1, 2500, 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `tipo_devolucion` varchar(50) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `estado` varchar(30) DEFAULT 'pendiente',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `factura` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id`, `producto_id`, `usuario`, `tipo_devolucion`, `motivo`, `estado`, `fecha`, `factura`, `cantidad`) VALUES
(1, 10, '42', 'no_lo_quiere', 'sadas', 'rechazado', '2026-03-11 20:26:52', '1773260812_Captura de pantalla 2026-03-11 144419.png', 1),
(2, 10, '42', 'no_lo_quiere', 'sadasdasd', 'aprobado', '2026-03-11 20:34:11', '1773261251_Captura de pantalla 2026-03-11 144419.png', 1),
(3, 10, '42', 'insatisfaccion', 'asdasd', 'aprobado', '2026-03-11 22:23:38', '1773267818_Captura de pantalla 2026-03-11 144419.png', 2),
(4, 3, '51', 'no_lo_quiere', 'gsdgs', 'rechazado', '2026-03-13 17:42:50', '1773423770_Captura de pantalla 2026-03-11 144419.png', 1),
(5, 8, '51', 'insatisfaccion', 'koasdkoas', 'aprobado', '2026-03-13 17:59:08', '1773424748_Captura de pantalla 2026-03-11 144419.png', 1);

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

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `idUsuario`, `fechaEmision`, `total`) VALUES
(34, 51, '2026-02-27 14:26:09.000000', 13300),
(36, 49, '2026-02-27 15:24:09.000000', 8000),
(37, 51, '2026-02-27 15:36:35.000000', 20000),
(38, 42, '2026-03-04 16:06:56.000000', 2500),
(39, 42, '2026-03-11 15:33:33.000000', 2500),
(40, 51, '2026-03-20 16:58:02.000000', 2500);

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
(7, 'Ramo'),
(8, 'Margarita'),
(9, 'Van Camps'),
(10, 'Huevos oro'),
(11, 'Colcafe'),
(12, 'Ariel'),
(13, 'Familia'),
(14, 'Dog Chow'),
(18, 'Sin marca'),
(20, 'Coca-Cola'),
(21, 'Alpina'),
(22, 'Pas'),
(23, 'Pastas la muñeca'),
(24, 'Diana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
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

INSERT INTO `productos` (`idProducto`, `nombre`, `descripcion`, `preUnitario`, `stock`, `foto`, `idCategoria`, `idUnidad_medida`, `idMarca`, `destacado`) VALUES
(3, 'Cerveza budweiser lata', '', 2800, 8, '1772048710_cerveza budweiser lata 269ml.webp', 3, 10, 18, 1),
(4, 'Ponqué ramo tradicional', NULL, 7000, 5, '1772048679_ponque ramo tradicional 230g.png', 3, 1, 7, 1),
(5, 'Arroz diana', NULL, 2800, 15, '1772048562_arroz diana 500g.webp', 5, 5, 11, 1),
(6, 'Frijol diana calima 500g', '', 3200, 14, '1772048456_frijol diana calima 500g.webp', 5, 5, 24, 1),
(7, 'Papas margarita Limon', '', 3000, 80, '1772048109_papas limon margarita 105g.webp', 3, 10, 8, 1),
(8, 'Atun van camps en aceite', '', 8000, 5, '1772048540_atun van camps lomitos en aceite 160g.webp', 7, 1, 9, 1),
(10, 'Bon yurt alpina zucaritas', '', 2500, 31, '1772048289_bon yurt alpina zucaritas 170g.jpg', 3, 5, 21, 1),
(15, 'Pastas la muñeca', 'Pasta corta en concha 1000g', 2000, 7, '1774034338_Pasta-La-Muñeca-Corta-Concha 1000g.png', 5, 5, 23, 1);

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
(3, 'mililitros'),
(4, 'kilos'),
(5, 'gramos'),
(6, 'paquete'),
(7, 'caja'),
(9, 'lata'),
(10, 'Bolsaaa'),
(11, 'Litros');

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
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL,
  `reset_code` varchar(10) DEFAULT NULL,
  `code_expira` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `numDocumento`, `nombre`, `direccion`, `telefono`, `email`, `password`, `tipo_documento`, `idRol`, `reset_code`, `code_expira`, `reset_token`, `token_expira`) VALUES
(42, 4567, 'goku', 'cali', '0931', 'miguelgg0711@gmail.com', '$2y$10$uvFPqUOXGutVeSECe7/srOInyudPOkktG41hlibSc1XL342cCYrbe', 1, 1, NULL, NULL, NULL, NULL),
(49, 1121859855, 'juan felipe', 'salado', '3134416859', 'juan091@gmail.com', '$2y$10$WgAykrtyzl4HmGXsDKxNGOKaRcSIAs3iN8dfAzQuRWT36CMdQizGi', 1, 2, NULL, NULL, NULL, NULL),
(51, 1121859855, 'miguel angel ', 'salado', '3134416859', 'scristianoricardo2@gmail.com', '$2y$10$Mzmv3MShEIEwYIKnYkof8OhbBZvYwmCUQm9Ho6XdVtopxxM1Vw2gS', 4, 2, NULL, NULL, NULL, NULL),
(52, 1106634150, 'nicol', 'salado', '3150034585', 'nicollealvis@gmail.com', '$2y$10$m295EN/c6WURn7HnCo6hYO1US6dFUPN6tQG6EtadwsqoX.e5kjWc2', 1, 2, NULL, NULL, NULL, NULL),
(55, 9039021, 'miguel', 'salado', '12344444', 'angelpapilindo@gmail.com', '$2y$10$EquqyBB.Ue4a.oHye1wVnOT7XCisccpaHM.NZSPSu/HtrawcyU/Eu', 4, 2, NULL, NULL, NULL, NULL),
(56, 67821, 'angel', 'salado', '3134416859', 'angelos@gmail.com', '$2y$10$Tbys6O.2eO6.OP8.Czn5JO2xcMzZvOLOekllthhMcJxGQ8ccSHHq.', 2, 2, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idCarrito` (`idCarrito`),
  ADD KEY `idProducto` (`idProducto`);

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
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `TipoDocumento` (`tipo_documento`),
  ADD KEY `rol_fk` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_salida`
--
ALTER TABLE `detalle_salida`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entradainventario`
--
ALTER TABLE `entradainventario`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `idUnidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD CONSTRAINT `carrito_detalle_ibfk_1` FOREIGN KEY (`idCarrito`) REFERENCES `carrito` (`idCarrito`),
  ADD CONSTRAINT `carrito_detalle_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

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
