-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2024 a las 22:25:05
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
-- Base de datos: `inventarios_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE DATABASE inventarios_sena;
USE inventarios_sena;


CREATE TABLE `categorias` (
  `idcategorias` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `decripcion_categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrega`
--

CREATE TABLE `detalle_entrega` (
  `iddetalle_entrega` int(11) NOT NULL,
  `id_entrega_elementos` int(11) NOT NULL,
  `idelementos` int(11) NOT NULL,
  `cantidad` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `idelementos` int(11) NOT NULL,
  `idProyectos` tinyint(3) NOT NULL,
  `idstands` tinyint(3) NOT NULL,
  `iditems` tinyint(3) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `serial` varchar(45) DEFAULT NULL,
  `span` varchar(45) DEFAULT NULL,
  `codigo_barras` varchar(100) DEFAULT NULL,
  `grosor` varchar(45) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `cantidad_minima` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL,
  `nombre_empleado` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_elementos`
--

CREATE TABLE `entrega_elementos` (
  `id_entrega_elementos` int(11) NOT NULL,
  `idProyectos` tinyint(3) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `iditems` tinyint(3) NOT NULL,
  `idsubcategorias` int(11) NOT NULL,
  `nombre_item` varchar(80) NOT NULL,
  `descipcion_item` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `idnovedades` int(11) NOT NULL,
  `idTipos_novedades` tinyint(2) NOT NULL,
  `idelementos` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `descripcion_novedad` varchar(120) NOT NULL,
  `fecha_reporte` datetime NOT NULL,
  `fecha_cierre` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idProyectos` tinyint(3) NOT NULL,
  `nombre_proyecto` varchar(150) NOT NULL,
  `descripcion_proyecto` longtext DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `responsable_proyecto` varchar(60) NOT NULL,
  `email_responsable` varchar(35) NOT NULL,
  `telefono_responsable` varchar(20) NOT NULL,
  `direccion_cliente` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stands`
--

CREATE TABLE `stands` (
  `idstands` tinyint(3) NOT NULL,
  `nombre_stand` varchar(60) NOT NULL,
  `ubicacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idsubcategorias` int(11) NOT NULL,
  `idcategorias` int(11) NOT NULL,
  `nombre_subcategoria` varchar(80) NOT NULL,
  `descripcion_subcategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_novedades`
--

CREATE TABLE `tipos_novedades` (
  `idTipos_novedades` tinyint(2) NOT NULL,
  `nombre_tipo_novedad` varchar(60) NOT NULL,
  `descripcion_tipo_novedad` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
--Estructura de la tabla devolucion_elemento

CREATE TABLE devolucion_elementos (
    id_devolucion_elementos INT AUTO_INCREMENT PRIMARY KEY,
    detalles_entregas_id INT,
    devolucion_cantidad INT,
    proyecto_id INT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (detalles_entregas_id) REFERENCES detalles_entregas_elementos(entrega_elemento_id),
    FOREIGN KEY (proyecto_id) REFERENCES proyectos(id_proyecto)
);


-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategorias`);

--
-- Indices de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD PRIMARY KEY (`iddetalle_entrega`),
  ADD KEY `fk_detalle_salida_elementos1_idx` (`idelementos`),
  ADD KEY `fk_detalle_salida_Entrega_elementos1_idx` (`id_entrega_elementos`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`idelementos`),
  ADD KEY `fk_elementos_Proyectos1_idx` (`idProyectos`),
  ADD KEY `fk_elementos_stands1_idx` (`idstands`),
  ADD KEY `fk_elementos_items1_idx` (`iditems`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `entrega_elementos`
--
ALTER TABLE `entrega_elementos`
  ADD PRIMARY KEY (`id_entrega_elementos`),
  ADD KEY `fk_Entrega_elementos_empleados1_idx` (`idempleado`),
  ADD KEY `fk_Entrega_elementos_Proyectos1_idx` (`idProyectos`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iditems`),
  ADD KEY `fk_items_subcategorias1_idx` (`idsubcategorias`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`idnovedades`),
  ADD KEY `fk_novedades_Tipos_novedades_idx` (`idTipos_novedades`),
  ADD KEY `fk_novedades_elementos1_idx` (`idelementos`),
  ADD KEY `fk_novedades_empleados1_idx` (`idempleado`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idProyectos`);

--
-- Indices de la tabla `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`idstands`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idsubcategorias`),
  ADD KEY `fk_subcategorias_categorias1_idx` (`idcategorias`);

--
-- Indices de la tabla `tipos_novedades`
--
ALTER TABLE `tipos_novedades`
  ADD PRIMARY KEY (`idTipos_novedades`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  MODIFY `iddetalle_entrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `idelementos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrega_elementos`
--
ALTER TABLE `entrega_elementos`
  MODIFY `id_entrega_elementos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `idnovedades` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stands`
--
ALTER TABLE `stands`
  MODIFY `idstands` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategorias` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD CONSTRAINT `fk_detalle_salida_Entrega_elementos1` FOREIGN KEY (`id_entrega_elementos`) REFERENCES `entrega_elementos` (`id_entrega_elementos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_salida_elementos1` FOREIGN KEY (`idelementos`) REFERENCES `elementos` (`idelementos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `fk_elementos_Proyectos1` FOREIGN KEY (`idProyectos`) REFERENCES `proyectos` (`idProyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_elementos_items1` FOREIGN KEY (`iditems`) REFERENCES `items` (`iditems`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_elementos_stands1` FOREIGN KEY (`idstands`) REFERENCES `stands` (`idstands`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entrega_elementos`
--
ALTER TABLE `entrega_elementos`
  ADD CONSTRAINT `fk_Entrega_elementos_Proyectos1` FOREIGN KEY (`idProyectos`) REFERENCES `proyectos` (`idProyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Entrega_elementos_empleados1` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_subcategorias1` FOREIGN KEY (`idsubcategorias`) REFERENCES `subcategorias` (`idsubcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD CONSTRAINT `fk_novedades_Tipos_novedades` FOREIGN KEY (`idTipos_novedades`) REFERENCES `tipos_novedades` (`idTipos_novedades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_novedades_elementos1` FOREIGN KEY (`idelementos`) REFERENCES `elementos` (`idelementos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_novedades_empleados1` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategorias_categorias1` FOREIGN KEY (`idcategorias`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
