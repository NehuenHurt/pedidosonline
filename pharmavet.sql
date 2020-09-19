-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2020 a las 14:33:46
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pharmavet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codigoCli` varchar(6) COLLATE utf8_bin NOT NULL,
  `nombreCli` varchar(30) COLLATE utf8_bin NOT NULL,
  `direccionCli` varchar(30) COLLATE utf8_bin NOT NULL,
  `localidadCli` varchar(20) COLLATE utf8_bin NOT NULL,
  `provinciaCli` varchar(20) COLLATE utf8_bin NOT NULL,
  `codigoPostalCli` varchar(10) COLLATE utf8_bin NOT NULL,
  `telefonoCli` varchar(40) COLLATE utf8_bin NOT NULL,
  `zonaCli` varchar(4) COLLATE utf8_bin NOT NULL,
  `vendedorCli` int(11) NOT NULL,
  `codFleteCli` varchar(6) COLLATE utf8_bin NOT NULL,
  `nombreFleteCli` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_Pedidos`
--

CREATE TABLE `item_Pedidos` (
  `numeroPed` int(10) UNSIGNED NOT NULL,
  `lineaItPed` int(10) UNSIGNED NOT NULL,
  `codigoPro` varchar(10) COLLATE utf8_bin NOT NULL,
  `cantidadPro` int(11) NOT NULL,
  `precioItPed` decimal(12,2) NOT NULL,
  `esBonificadiItPed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `numeroPed` int(10) UNSIGNED NOT NULL,
  `codigoCli` varchar(6) COLLATE utf8_bin NOT NULL,
  `fechaPed` date NOT NULL,
  `horaPed` time NOT NULL,
  `numeroUsu` int(11) NOT NULL,
  `nombreUsu` varchar(30) COLLATE utf8_bin NOT NULL,
  `descuentoPed` decimal(6,2) NOT NULL,
  `transportePed` varchar(20) COLLATE utf8_bin NOT NULL,
  `tieneDeudaPed` tinyint(1) NOT NULL,
  `notaPed` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigoPro` varchar(10) COLLATE utf8_bin NOT NULL,
  `descripcionPro` varchar(30) COLLATE utf8_bin NOT NULL,
  `precioPro` decimal(12,2) NOT NULL,
  `imagenPro` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `numeroUsu` int(11) NOT NULL,
  `nombreUsu` varchar(30) COLLATE utf8_bin NOT NULL,
  `claveUsu` varchar(12) COLLATE utf8_bin NOT NULL,
  `correoUsu` varchar(50) COLLATE utf8_bin NOT NULL,
  `descuentoUsu` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`numeroUsu`, `nombreUsu`, `claveUsu`, `correoUsu`, `descuentoUsu`) VALUES
(1000, 'Administrador', 'manolo', 'osvaldocampilongo@gmail.com', '30.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigoCli`);

--
-- Indices de la tabla `item_Pedidos`
--
ALTER TABLE `item_Pedidos`
  ADD PRIMARY KEY (`numeroPed`,`lineaItPed`),
  ADD KEY `itPedxProducto` (`codigoPro`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`numeroPed`),
  ADD KEY `pedxUsu` (`numeroUsu`),
  ADD KEY `pedxCliente` (`codigoCli`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigoPro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`numeroUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `numeroPed` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `item_Pedidos`
--
ALTER TABLE `item_Pedidos`
  ADD CONSTRAINT `itPedxPedido` FOREIGN KEY (`numeroPed`) REFERENCES `pedidos` (`numeroPed`),
  ADD CONSTRAINT `itPedxProducto` FOREIGN KEY (`codigoPro`) REFERENCES `productos` (`codigoPro`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedxCliente` FOREIGN KEY (`codigoCli`) REFERENCES `clientes` (`codigoCli`),
  ADD CONSTRAINT `pedxUsu` FOREIGN KEY (`numeroUsu`) REFERENCES `usuarios` (`numeroUsu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
