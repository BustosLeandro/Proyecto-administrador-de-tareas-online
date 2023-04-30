-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2023 a las 00:06:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
(7, 'text-bg-dark');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coloressubtareas`
--

CREATE TABLE `coloressubtareas` (
  `Codigo` int(11) NOT NULL,
  `Color` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coloressubtareas`
--

INSERT INTO `coloressubtareas` (`Codigo`, `Color`) VALUES
(1, 'text-bg-primary'),
(2, 'text-bg-secondary'),
(3, 'text-bg-success'),
(4, 'text-bg-danger'),
(5, 'text-bg-warning'),
(6, 'text-bg-info'),
(7, 'text-bg-dark');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `Codigo` int(11) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoSubtarea` int(11) NOT NULL,
  `Comentario` varchar(500) NOT NULL
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
-- Estructura de tabla para la tabla `estadossubtareas`
--

CREATE TABLE `estadossubtareas` (
  `Codigo` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadossubtareas`
--

INSERT INTO `estadossubtareas` (`Codigo`, `Estado`) VALUES
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
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridadessubtareas`
--

CREATE TABLE `prioridadessubtareas` (
  `Codigo` int(11) NOT NULL,
  `Prioridad` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prioridadessubtareas`
--

INSERT INTO `prioridadessubtareas` (`Codigo`, `Prioridad`) VALUES
(1, 'Baja'),
(2, 'Normal'),
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtareas`
--

CREATE TABLE `subtareas` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoTarea` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `CodigoPrioridad` int(11) DEFAULT NULL,
  `CodigoColor` int(11) DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `FechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `FechaAsignacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subtareas`
--

INSERT INTO `subtareas` (`Codigo`, `Titulo`, `CodigoUsuario`, `CodigoTarea`, `Descripcion`, `CodigoEstado`, `CodigoPrioridad`, `CodigoColor`, `FechaVencimiento`, `FechaCreacion`, `FechaAsignacion`) VALUES
(1, 'Esta es la segunda subtarea', 1, 1, 'Primer subtarea de la primer tarea', 1, NULL, 6, NULL, '2023-04-30', NULL),
(5, 'Esta es la segunda subtarea', 1, 1, 'Segunda subtarea de la primer tarea', 2, 2, NULL, '2023-04-29', '2023-04-30', '2023-04-01'),
(6, 'Tercer subtarea', 1, 3, 'asdasdfasdfasdfasdfasdf', 3, 1, NULL, NULL, '2023-04-30', NULL),
(7, 'Cuarta subtarea', 1, 2, 'asdfasdfasdfasdf', 1, 3, NULL, NULL, '2023-04-30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoPrioridad` int(11) NOT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `CodigoColor` int(11) DEFAULT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `FechaRecordatorio` date DEFAULT NULL,
  `FechaCreacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`Codigo`, `Titulo`, `CodigoUsuario`, `CodigoPrioridad`, `CodigoEstado`, `CodigoColor`, `Descripcion`, `FechaVencimiento`, `FechaRecordatorio`, `FechaCreacion`) VALUES
(1, 'Este es el titulo', 1, 3, 2, NULL, 'orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur.', '2023-04-06', NULL, '2023-04-30'),
(2, 'Esta es la segunda tarea', 1, 1, 1, 5, 'Hacer esta tarea cuando se terminen las otras', '2023-04-05', '2023-04-01', '2023-04-30'),
(3, 'Esta es la tercer tarea', 1, 2, 3, 4, 'Tarea finalizada', '2023-04-21', NULL, '2023-04-30');

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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Codigo`, `Nombre`, `Apellido`, `Email`, `Password`, `FotoPerfil`, `FotoIcono`) VALUES
(1, 'Leandro', 'Bustos', 'bustosleandro27@gmail.com', '$2y$10$cZv72F/PhhGrrON.UxET4uiflEJaH71/tZVTOYnfdLZn8tLjaAKd.', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `coloressubtareas`
--
ALTER TABLE `coloressubtareas`
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
-- Indices de la tabla `estadossubtareas`
--
ALTER TABLE `estadossubtareas`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `prioridadessubtareas`
--
ALTER TABLE `prioridadessubtareas`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `subtareas`
--
ALTER TABLE `subtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `CodigoTarea` (`CodigoTarea`),
  ADD KEY `CodigoEstado` (`CodigoEstado`),
  ADD KEY `CodigoPrioridad` (`CodigoPrioridad`),
  ADD KEY `CodigoColor` (`CodigoColor`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `CodigoPrioridad` (`CodigoPrioridad`),
  ADD KEY `CodigoEstado` (`CodigoEstado`),
  ADD KEY `CodigoColor` (`CodigoColor`);

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
-- AUTO_INCREMENT de la tabla `coloressubtareas`
--
ALTER TABLE `coloressubtareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadossubtareas`
--
ALTER TABLE `estadossubtareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prioridadessubtareas`
--
ALTER TABLE `prioridadessubtareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subtareas`
--
ALTER TABLE `subtareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `subtareas_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_2` FOREIGN KEY (`CodigoTarea`) REFERENCES `tareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_3` FOREIGN KEY (`CodigoEstado`) REFERENCES `estadossubtareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_4` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridadessubtareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_5` FOREIGN KEY (`CodigoColor`) REFERENCES `coloressubtareas` (`Codigo`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridades` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`CodigoEstado`) REFERENCES `estados` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_4` FOREIGN KEY (`CodigoColor`) REFERENCES `colores` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
