-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2023 a las 22:14:38
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
-- Base de datos: `planilla_anf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aguinaldo`
--

CREATE TABLE `aguinaldo` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `sueldo_base` double DEFAULT NULL,
  `sueldo_calculo` double DEFAULT NULL,
  `anios_laborales` int(11) DEFAULT NULL,
  `dias_base` int(11) DEFAULT NULL,
  `aguinaldo` double DEFAULT NULL,
  `renta_aguinaldo` double DEFAULT NULL,
  `liquido_pagar` double DEFAULT NULL,
  `anio_planilla` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aguinaldo`
--

INSERT INTO `aguinaldo` (`id`, `id_empleado`, `sueldo_base`, `sueldo_calculo`, `anios_laborales`, `dias_base`, `aguinaldo`, `renta_aguinaldo`, `liquido_pagar`, `anio_planilla`, `estado`) VALUES
(5, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL,
  `id_planilla` int(11) NOT NULL,
  `permisos` double DEFAULT NULL,
  `incapacidades` double DEFAULT NULL,
  `llegadas_tardias` double DEFAULT NULL,
  `dias_descontados` double DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `id_planilla`, `permisos`, `incapacidades`, `llegadas_tardias`, `dias_descontados`, `total`) VALUES
(1, 43, 2, 2, 2, 4, 10),
(2, 44, 2, 2, 0, 2, 6),
(3, 45, 4, 4, 4, 4, 16),
(4, 52, 2, 10, 1, 1, 14),
(5, 60, 2, 2, 2, 3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(50) NOT NULL,
  `primernombre` varchar(50) NOT NULL,
  `segundonombre` varchar(100) NOT NULL,
  `primerapellido` varchar(100) NOT NULL,
  `segundoapellido` varchar(100) NOT NULL,
  `dui` int(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `fechaingreso` date NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `sueldo` int(50) NOT NULL,
  `seguromedico` varchar(100) NOT NULL,
  `pension` varchar(100) NOT NULL,
  `numeroafiliado` int(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `dui`, `sexo`, `fechanacimiento`, `fechaingreso`, `cargo`, `sueldo`, `seguromedico`, `pension`, `numeroafiliado`, `estado`) VALUES
(40, 'Carlos', 'Alberto', 'Domingues', 'Torres', 12131416, 'masculino', '1984-06-20', '2020-06-16', 'Empleado', 364, 'ISSS', 'Crecer', 141413, 1),
(46, 'Jorge', 'Alexander', 'Aquino', 'Ramirez', 494938311, 'masculino', '1993-12-07', '2020-07-11', 'Empleado', 450, 'ISSS', 'Crecer', 121212121, 1),
(47, 'Pedro', 'Sanchez', 'Antillon', 'Portillo', 45458421, 'masculino', '1994-12-20', '2019-12-20', 'Empleado', 360, 'ISSS', 'Crecer', 232541, 1),
(48, 'Jorge', 'Alberto', 'Beltran', 'Mendoza', 55233114, 'masculino', '1982-12-03', '2020-12-11', 'Empleado', 320, 'ISSS', 'Confia', 22322223, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_extras`
--

CREATE TABLE `horas_extras` (
  `id` int(11) NOT NULL,
  `id_planilla` int(11) NOT NULL,
  `num_horas_extras` int(11) DEFAULT NULL,
  `pago_horas_extras` double DEFAULT NULL,
  `num_horas_nocturnas` int(11) DEFAULT NULL,
  `pagos_horas_nocturnas` double DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horas_extras`
--

INSERT INTO `horas_extras` (`id`, `id_planilla`, `num_horas_extras`, `pago_horas_extras`, `num_horas_nocturnas`, `pagos_horas_nocturnas`, `total`) VALUES
(1, 43, 4, 12.13, 1, 3.79, 15.93),
(2, 44, 2, 7.5, 2, 9.38, 16.88),
(4, 45, 2, 6, 4, 15, 21),
(5, 52, 4, 10.67, 2, 6.67, 17.33),
(6, 57, 2, 6.07, 2, 7.58, 13.65);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incremento_salarial`
--

CREATE TABLE `incremento_salarial` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `sueldo_antes` double DEFAULT NULL,
  `sueldo_incremento` double DEFAULT NULL,
  `a_partir_de` date DEFAULT NULL,
  `comentarios_incremento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incremento_salarial`
--

INSERT INTO `incremento_salarial` (`id`, `id_empleado`, `sueldo_antes`, `sueldo_incremento`, `a_partir_de`, `comentarios_incremento`) VALUES
(20, 40, 300, 364, '2022-03-01', 'Incremento en base a la ley salarial'),
(21, 46, 350, 450, '2021-03-01', 'Incremento por cargo'),
(22, 47, 300, 360, '2021-12-12', 'Incremento en base a la ley');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_prestaciones`
--

CREATE TABLE `planilla_prestaciones` (
  `id` int(11) NOT NULL,
  `id_planilla` int(11) NOT NULL,
  `afps` double DEFAULT NULL,
  `isss` double DEFAULT NULL,
  `renta` double DEFAULT NULL,
  `salario_bruto` double DEFAULT NULL,
  `salario_neto` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planilla_prestaciones`
--

INSERT INTO `planilla_prestaciones` (`id`, `id_planilla`, `afps`, `isss`, `renta`, `salario_bruto`, `salario_neto`) VALUES
(2, 43, 28.99, 12, 0, 399.93, 358.94),
(3, 44, 33.99, 14.07, 0, 468.88, 420.82),
(4, 45, 27.19, 11.25, 0, 375, 336.56),
(5, 52, 23.89, 9.89, 0, 329.53, 295.75),
(6, 57, 27.96, 11.57, 0, 385.65, 346.12),
(7, 60, 22.55, 9.33, 0, 311, 279.12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_salarial`
--

CREATE TABLE `planilla_salarial` (
  `id` int(11) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `id_empleado` int(11) NOT NULL,
  `salario` double DEFAULT NULL,
  `salario_bruto` double DEFAULT NULL,
  `salario_neto` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planilla_salarial`
--

INSERT INTO `planilla_salarial` (`id`, `anio`, `mes`, `id_empleado`, `salario`, `salario_bruto`, `salario_neto`) VALUES
(43, 2023, 11, 40, 364, 399.93, 358.94),
(44, 2023, 11, 46, 450, 468.88, 420.82),
(45, 2023, 11, 47, 360, 375, 336.56),
(49, 2023, 12, 40, 364, NULL, NULL),
(50, 2023, 12, 46, 450, NULL, NULL),
(51, 2023, 12, 47, 360, NULL, NULL),
(52, 2023, 12, 48, 320, 329.53, 295.75),
(53, 2024, 1, 40, 364, NULL, NULL),
(54, 2024, 1, 46, 450, NULL, NULL),
(55, 2024, 1, 47, 360, NULL, NULL),
(56, 2024, 1, 48, 320, NULL, NULL),
(57, 2024, 2, 40, 364, 385.65, 346.12),
(58, 2024, 2, 46, 450, NULL, NULL),
(59, 2024, 2, 47, 360, NULL, NULL),
(60, 2024, 2, 48, 320, 311, 279.12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestaciones`
--

CREATE TABLE `prestaciones` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `desde` double DEFAULT NULL,
  `hasta` double DEFAULT NULL,
  `patronal` decimal(5,2) DEFAULT NULL,
  `laboral` decimal(5,2) DEFAULT NULL,
  `techo` double DEFAULT NULL,
  `unidad_tiempo` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestaciones`
--

INSERT INTO `prestaciones` (`id`, `tipo`, `nombre`, `desde`, `hasta`, `patronal`, `laboral`, `techo`, `unidad_tiempo`, `estado`) VALUES
(13, 'pensiones', 'Administradoras de fondos de pensiones', 0, NULL, 7.75, 7.25, 7500, NULL, 1),
(14, 'pensiones', 'AFP Crecer', 350.01, 800, 7.75, 8.00, 7500, NULL, 0),
(16, 'seguro medico', 'Instituto del Seguro Social de El Salvador ISSS', 0, NULL, 7.50, 3.00, 1000, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remuneraciones`
--

CREATE TABLE `remuneraciones` (
  `id` int(11) NOT NULL,
  `id_planilla` int(11) NOT NULL,
  `feriado` double DEFAULT NULL,
  `reintegro` double DEFAULT NULL,
  `domingo` double DEFAULT NULL,
  `vacaciones` double DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `remuneraciones`
--

INSERT INTO `remuneraciones` (`id`, `id_planilla`, `feriado`, `reintegro`, `domingo`, `vacaciones`, `total`) VALUES
(1, 43, 1, 20, 2, 7, 30),
(2, 44, 2, 2, 2, 2, 8),
(3, 45, 4, 2, 2, 2, 10),
(4, 52, 1.2, 1, 2, 2, 6.2),
(5, 57, 2, 2, 2, 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renta`
--

CREATE TABLE `renta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `desde` double DEFAULT NULL,
  `hasta` double DEFAULT NULL,
  `aplicar` decimal(5,2) DEFAULT NULL,
  `sobre_exceso` double DEFAULT NULL,
  `cuota_fija` double DEFAULT NULL,
  `unidad_tiempo` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `renta`
--

INSERT INTO `renta` (`id`, `nombre`, `desde`, `hasta`, `aplicar`, `sobre_exceso`, `cuota_fija`, `unidad_tiempo`, `estado`) VALUES
(1, 'I TRAMO', 0.01, 472, NULL, NULL, NULL, NULL, 1),
(2, 'II TRAMO', 472.01, 895.24, 10.00, 472, 17.67, NULL, 1),
(3, 'III TRAMO', 895.25, 2038.1, 20.00, 895.24, 60, NULL, 1),
(4, 'IV TRAMO', 2038.11, NULL, 30.00, 2038.1, 288.57, NULL, 1),
(7, 'V TRAMO', 1000, 2500, 45.00, 1200, 120, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `contrasena` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`) VALUES
(1, 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_empleado` (`id_empleado`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_planilla_salarila_12` (`id_planilla`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horas_extras`
--
ALTER TABLE `horas_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horas_extras_ibfk_1` (`id_planilla`);

--
-- Indices de la tabla `incremento_salarial`
--
ALTER TABLE `incremento_salarial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incremento_salarial_ibfk_1` (`id_empleado`);

--
-- Indices de la tabla `planilla_prestaciones`
--
ALTER TABLE `planilla_prestaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planilla_prestaciones_ibfk_1` (`id_planilla`);

--
-- Indices de la tabla `planilla_salarial`
--
ALTER TABLE `planilla_salarial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planilla_salarial_ibfk_1` (`id_empleado`);

--
-- Indices de la tabla `prestaciones`
--
ALTER TABLE `prestaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `remuneraciones`
--
ALTER TABLE `remuneraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remuneraciones_ibfk_1` (`id_planilla`);

--
-- Indices de la tabla `renta`
--
ALTER TABLE `renta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `horas_extras`
--
ALTER TABLE `horas_extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `incremento_salarial`
--
ALTER TABLE `incremento_salarial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `planilla_prestaciones`
--
ALTER TABLE `planilla_prestaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `planilla_salarial`
--
ALTER TABLE `planilla_salarial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `prestaciones`
--
ALTER TABLE `prestaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `remuneraciones`
--
ALTER TABLE `remuneraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `renta`
--
ALTER TABLE `renta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD CONSTRAINT `fk_id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD CONSTRAINT `fk_planilla_salarila_12` FOREIGN KEY (`id_planilla`) REFERENCES `planilla_salarial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horas_extras`
--
ALTER TABLE `horas_extras`
  ADD CONSTRAINT `horas_extras_ibfk_1` FOREIGN KEY (`id_planilla`) REFERENCES `planilla_salarial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incremento_salarial`
--
ALTER TABLE `incremento_salarial`
  ADD CONSTRAINT `incremento_salarial_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planilla_prestaciones`
--
ALTER TABLE `planilla_prestaciones`
  ADD CONSTRAINT `planilla_prestaciones_ibfk_1` FOREIGN KEY (`id_planilla`) REFERENCES `planilla_salarial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planilla_salarial`
--
ALTER TABLE `planilla_salarial`
  ADD CONSTRAINT `planilla_salarial_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `remuneraciones`
--
ALTER TABLE `remuneraciones`
  ADD CONSTRAINT `remuneraciones_ibfk_1` FOREIGN KEY (`id_planilla`) REFERENCES `planilla_salarial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
