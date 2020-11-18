-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2020 a las 16:24:49
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_delivery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `texto` varchar(1000) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `texto`, `puntaje`, `id_pedido`, `id_usuario`) VALUES
(1, '10', 1, 98, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `ruta`, `id_pedido`, `descripcion`) VALUES
(153, 'images/5fb319ac3df8c.jpg', 94, ''),
(154, 'images/5fb319bf101a9.jpg', 94, ''),
(156, 'images/5fb319cda5a98.jpg', 94, ''),
(157, 'images/5fb319cda72b5.jpeg', 94, ''),
(158, 'images/5fb319e002ff0.jpg', 94, '1111'),
(161, 'images/5fb31ce497122.png', 123, ''),
(162, 'images/5fb31d4c57cb7.png', 129, ''),
(163, 'images/5fb31da31f340.jpg', 131, ''),
(164, 'images/5fb31dd26a031.jpg', 132, ''),
(165, 'images/5fb31e8ce9f8e.jpg', 133, ''),
(166, 'images/5fb31f4d21eb8.png', 136, ''),
(167, 'images/5fb31f6a4c957.png', 137, '10'),
(168, 'images/5fb31f8c722c2.png', 138, ''),
(169, 'images/5fb31fddbfee9.png', 138, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `direccion` varchar(110) NOT NULL,
  `cliente` varchar(110) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_producto`, `direccion`, `cliente`, `estado`, `cantidad`, `id_usuario`) VALUES
(94, 5, '150', '17', 'En preparación', 10, 2),
(95, 5, '', '18', 'En preparación', 0, 2),
(96, 5, '', '19', 'En preparación', 0, 2),
(97, 5, '', '20', 'En preparación', 0, 2),
(98, 5, '', '21', 'En preparación', 0, 2),
(99, 5, '', '22', 'En preparación', 0, 2),
(100, 5, '', '23', 'En preparación', 0, 2),
(101, 5, '', '24', 'En camino', 0, 2),
(102, 5, '', '25', 'En camino', 0, 2),
(103, 5, '', '26', 'En camino', 0, 2),
(122, 7, '115', '115 115', 'En preparación', 10, 2),
(123, 7, '1161', '116 116', 'Entregado', 10, 2),
(128, 7, '15000', '1111111 111111', 'En preparación.', 10, 2),
(129, 7, '896', '123456 1', 'En preparación.', 2, 2),
(130, 5, '22222', '2222 222', 'En preparación.', 2, 2),
(131, 7, '10', '10 10', 'En preparación.', 10, 2),
(132, 7, '44', '444 444', 'En preparación.', 4, 2),
(133, 7, '888', '48888 888', 'En preparación.', 8, 2),
(134, 7, '666', '666 666', 'En preparación.', 6, 2),
(135, 5, '25 de Mayo', '11010 110', 'En preparación.', 10, 2),
(136, 7, '25 de Mayo', '1010 10', 'En preparación.', 10, 2),
(137, 7, '010', '1111111111 1111111', 'En preparación.', 10, 2),
(138, 7, '777', '777 777', 'En preparación.', 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `nombre` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `precio`, `descripcion`, `nombre`) VALUES
(5, 150, 'Grandes.', 'Pizza'),
(7, 120, 'Verduras', 'Empanada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `respuesta` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `alias`, `password`, `pregunta`, `respuesta`, `admin`) VALUES
(2, 'JM', '$2y$10$B1WK1hhsheVYSYoem/V0rOLS3IrgC3m9Pv8iKo7XA8Lt2hS2E7Bw2', '¿De qué club sos hincha?', 'Racing Club', 1),
(7, 'Diego', '$2y$10$DtiLoC06VaER/S1FmUTsv.2Ok.Ab5R5M9xzixBl9OQQswBGw9vI3C', 'a', 'a', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_pedido_fk` (`id_pedido`) USING BTREE,
  ADD KEY `id_usuario_fk` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_pedido_fk` (`id_pedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_producto_FK` (`id_producto`),
  ADD KEY `id_usuario_fk` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
