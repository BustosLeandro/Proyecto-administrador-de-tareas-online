-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2023 a las 18:18:09
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `administrador_de_tareas_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `Codigo` int(11) NOT NULL,
  `Color` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`Codigo`, `Color`) VALUES
(1, 'text-bg-primary'),
(2, 'text-bg-secondary'),
(3, 'text-bg-success'),
(4, 'text-bg-danger'),
(5, 'text-bg-warning'),
(6, 'text-bg-info'),
(7, 'text-bg-light'),
(8, 'text-bg-dark'),
(9, 'Nulo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `Codigo` int(11) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoSubtarea` int(11) NOT NULL,
  `Comentario` varchar(500) NOT NULL,
  `Imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `Codigo` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`Codigo`, `Estado`) VALUES
(1, 'Definida'),
(2, 'En proceso'),
(3, 'Finalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

CREATE TABLE `prioridades` (
  `Codigo` int(11) NOT NULL,
  `Prioridad` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prioridades`
--

INSERT INTO `prioridades` (`Codigo`, `Prioridad`) VALUES
(1, 'Baja'),
(2, 'Normal'),
(3, 'Alta'),
(4, 'Nulo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtareas`
--

CREATE TABLE `subtareas` (
  `Codigo` int(11) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoTarea` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `CodigoPrioridad` int(11) NOT NULL,
  `FechaVencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `Codigo` int(11) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoPrioridad` int(11) NOT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `CodigoColor` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `FechaVencimiento` date NOT NULL DEFAULT current_timestamp(),
  `FechaRecordatorio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `FotoPerfil` varchar(100) DEFAULT NULL,
  `FotoIcono` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `CodigoSubtarea` (`CodigoSubtarea`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `subtareas`
--
ALTER TABLE `subtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoEstado` (`CodigoEstado`),
  ADD KEY `CodigoPrioridad` (`CodigoPrioridad`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `CodigoTarea` (`CodigoTarea`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoPrioridad` (`CodigoPrioridad`),
  ADD KEY `CodigoEstado` (`CodigoEstado`),
  ADD KEY `CodigoColor` (`CodigoColor`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`CodigoSubtarea`) REFERENCES `subtareas` (`Codigo`);

--
-- Filtros para la tabla `subtareas`
--
ALTER TABLE `subtareas`
  ADD CONSTRAINT `subtareas_ibfk_1` FOREIGN KEY (`CodigoEstado`) REFERENCES `estados` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_2` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridades` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_3` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_4` FOREIGN KEY (`CodigoTarea`) REFERENCES `tareas` (`Codigo`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridades` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`CodigoEstado`) REFERENCES `estados` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`CodigoColor`) REFERENCES `colores` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_4` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
