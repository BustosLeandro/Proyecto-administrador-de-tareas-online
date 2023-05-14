-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2023 a las 20:50:23
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
  `Color` varchar(17) NOT NULL,
  `Valor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`Codigo`, `Color`, `Valor`) VALUES
(1, 'Azul', 'text-bg-primary'),
(2, 'Gris', 'text-bg-secondary'),
(3, 'Verde', 'text-bg-success'),
(4, 'Rojo', 'text-bg-danger'),
(5, 'Amarillo', 'text-bg-warning'),
(6, 'Celeste', 'text-bg-info'),
(7, 'Negro', 'text-bg-dark');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coloressubtareas`
--

CREATE TABLE `coloressubtareas` (
  `Codigo` int(11) NOT NULL,
  `Color` varchar(17) NOT NULL,
  `Valor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coloressubtareas`
--

INSERT INTO `coloressubtareas` (`Codigo`, `Color`, `Valor`) VALUES
(1, 'Azul', 'text-bg-primary'),
(2, 'Gris', 'text-bg-secondary'),
(3, 'Verde', 'text-bg-success'),
(4, 'Rojo', 'text-bg-danger'),
(5, 'Amarillo', 'text-bg-warning'),
(6, 'Celeste', 'text-bg-info'),
(7, 'Negro', 'text-bg-dark');

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
(3, 'Alta'),
(1, 'Baja'),
(2, 'Normal');

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
(3, 'Alta'),
(1, 'Baja'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtareas`
--

CREATE TABLE `subtareas` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoColaborador` int(11) DEFAULT NULL,
  `CodigoTarea` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `CodigoEstado` int(11) NOT NULL,
  `CodigoPrioridad` int(11) DEFAULT NULL,
  `CodigoColor` int(11) DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `FechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `FechaAsignacion` date DEFAULT NULL,
  `estaArchivada` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `FechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `estaArchivada` tinyint(4) NOT NULL DEFAULT 0
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
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Codigo`, `Nombre`, `Apellido`, `Email`, `Password`) VALUES
(1, 'Leandro', 'Bustos', 'bustosleandro27@gmail.com', '$2y$10$Occb0Q0QKYTINnF7cfAdWuIfCiff8Lo.Mtyv4PE3gQjEylSZeOsrq'),
(2, 'Juan', 'Gallego', 'JGallego@gmail.com.ar', '$2y$10$Df2P.UzuSv9/rKEZN9r.S.PI6oasPTgslMs3O6ZDjCGFusddJ3gXu'),
(3, 'Sofia', 'Rey', 'SREY09@gmail.com.ar', '$2y$10$XujMhW4kpLTZ3ZRqnMtFfesLuwOgZEiYggCYdVSIZ2CL1zA0XMqW2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Color` (`Color`),
  ADD UNIQUE KEY `Valor` (`Valor`);

--
-- Indices de la tabla `coloressubtareas`
--
ALTER TABLE `coloressubtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Color` (`Color`),
  ADD UNIQUE KEY `Valor` (`Valor`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `comentarios_ibfk_2` (`CodigoSubtarea`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Estado` (`Estado`);

--
-- Indices de la tabla `estadossubtareas`
--
ALTER TABLE `estadossubtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Estado` (`Estado`);

--
-- Indices de la tabla `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Prioridad` (`Prioridad`);

--
-- Indices de la tabla `prioridadessubtareas`
--
ALTER TABLE `prioridadessubtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `Prioridad` (`Prioridad`);

--
-- Indices de la tabla `subtareas`
--
ALTER TABLE `subtareas`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoEstado` (`CodigoEstado`),
  ADD KEY `CodigoPrioridad` (`CodigoPrioridad`),
  ADD KEY `CodigoColor` (`CodigoColor`),
  ADD KEY `CodigoColaborador` (`CodigoColaborador`),
  ADD KEY `CodigoUsuario` (`CodigoUsuario`),
  ADD KEY `subtareas_ibfk_1` (`CodigoTarea`);

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
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `coloressubtareas`
--
ALTER TABLE `coloressubtareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`CodigoSubtarea`) REFERENCES `subtareas` (`Codigo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subtareas`
--
ALTER TABLE `subtareas`
  ADD CONSTRAINT `subtareas_ibfk_1` FOREIGN KEY (`CodigoTarea`) REFERENCES `tareas` (`Codigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `subtareas_ibfk_3` FOREIGN KEY (`CodigoEstado`) REFERENCES `estadossubtareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_4` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridadessubtareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_5` FOREIGN KEY (`CodigoColor`) REFERENCES `coloressubtareas` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_6` FOREIGN KEY (`CodigoColaborador`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `subtareas_ibfk_7` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `CodigoUsuario` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuarios` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`CodigoPrioridad`) REFERENCES `prioridades` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`CodigoEstado`) REFERENCES `estados` (`Codigo`),
  ADD CONSTRAINT `tareas_ibfk_4` FOREIGN KEY (`CodigoColor`) REFERENCES `colores` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
