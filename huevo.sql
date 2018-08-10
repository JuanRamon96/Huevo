-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2018 a las 06:38:33
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `huevo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `ID_Area` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`ID_Area`, `Nombre`, `Activo`, `Eliminado`) VALUES
(2, 'area1', 1, 0),
(3, 'area2', 1, 0),
(4, 'area3', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Domicilio` varchar(150) NOT NULL,
  `Ciudad` varchar(40) NOT NULL,
  `Estado` varchar(40) NOT NULL,
  `Pais` varchar(40) NOT NULL,
  `CP` int(11) NOT NULL,
  `RazonSocial` varchar(60) NOT NULL,
  `RFC` varchar(60) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Contacto` varchar(150) NOT NULL,
  `TelContacto` varchar(30) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Codigo`, `Nombre`, `Domicilio`, `Ciudad`, `Estado`, `Pais`, `CP`, `RazonSocial`, `RFC`, `Telefono`, `Email`, `Contacto`, `TelContacto`, `Activo`, `Eliminado`) VALUES
(1, 'DFFRG267162377', 'Prueba', 'prueba fhdjvnxkj', 'nbvcx', 'sdffhn', 'sdfcvg', 47190, 'shjdbchjs', 'sadfg24345', '1323244554', 'xzcvbb@sdfg.com', 'sdfgh', '213243454543', 1, 0),
(2, 'SDH34453', 'szdfgh', 'szdfg', 'sdfg', 'asdfg', 'szxfvbg', 50123, 'sdfvg', 'asdfv', '213453245', 'asdfvdf@sdffd.com', 'dsfgbrfdgrf', '344534453', 1, 0),
(6, 'H34453', 'dfvbg', 'dfgh', 'sdfg', 'sdfg', 'sdf', 4, 'sdf', 'sdf', 'sdf', 'sdfg@sdfg', 'sdfg', 'sdfg', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `ID_Permiso` int(11) NOT NULL,
  `FK_Usuario` int(11) NOT NULL,
  `Productos` varchar(20) NOT NULL,
  `Clientes` varchar(20) NOT NULL,
  `Ventas` varchar(20) NOT NULL,
  `Proveedores` varchar(20) NOT NULL,
  `Compras` varchar(20) NOT NULL,
  `Produccion` varchar(20) NOT NULL,
  `Entregas` varchar(20) NOT NULL,
  `Reportes` varchar(20) NOT NULL,
  `Etiquetas` varchar(10) NOT NULL,
  `Empleados` varchar(20) NOT NULL,
  `Precios` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`ID_Permiso`, `FK_Usuario`, `Productos`, `Clientes`, `Ventas`, `Proveedores`, `Compras`, `Produccion`, `Entregas`, `Reportes`, `Etiquetas`, `Empleados`, `Precios`) VALUES
(2, 4, '1*1*1*1*', '1*0*0*0*', '1*1*0*0*', '1*0*0*0*', '1*0*0*0*', '0*0*0*0*', '0*0*0*0*', '1*', '1*', '0*0*0*0*', '0*0*0*0*');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `UME` varchar(30) NOT NULL,
  `Categoria` varchar(30) NOT NULL,
  `Existencia` int(11) NOT NULL,
  `Max` int(11) NOT NULL,
  `Min` int(11) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Codigo`, `Nombre`, `UME`, `Categoria`, `Existencia`, `Max`, `Min`, `Activo`, `Eliminado`) VALUES
(1, 'sdfdsf', 'Huevo frÃ¡gil', 'Kg', 'Materia Prima', 100, 500, 50, 1, 0),
(2, 'sdf32', 'JabÃ³n', 'Pieza', 'Insumo', 50, 100, 10, 1, 0),
(3, 'swads3443', 'Huevo liquido', 'Litro', 'Producto Terminado', 100, 500, 50, 1, 0),
(4, 'deef3443', 'Guantes', 'Pieza', 'Insumo', 200, 300, 20, 1, 0),
(5, 'sddsf334', 'Prueba1', 'Pieza', 'Insumo', 15, 10, 30, 0, 0),
(6, 'wd334', 'sdfgh', 'Pieza', 'Insumo', 41, 50, 20, 1, 1),
(7, 'ded3234', 'mnknkjlg', 'Kg', 'Materia Prima', 50, 20, 100, 1, 0),
(8, 'DBSHJ343', 'Prueba', 'Kg', 'Materia Prima', 60, 100, 30, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Domicilio` varchar(150) NOT NULL,
  `Ciudad` varchar(40) NOT NULL,
  `Estado` varchar(40) NOT NULL,
  `Pais` varchar(40) NOT NULL,
  `CP` int(11) NOT NULL,
  `RazonSocial` varchar(60) NOT NULL,
  `RFC` varchar(60) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Contacto` varchar(150) NOT NULL,
  `TelContacto` varchar(30) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Codigo`, `Nombre`, `Domicilio`, `Ciudad`, `Estado`, `Pais`, `CP`, `RazonSocial`, `RFC`, `Telefono`, `Email`, `Contacto`, `TelContacto`, `Activo`, `Eliminado`) VALUES
(1, 'SZDSFDF234', 'sdfbgsdfg', 'sdfg', 'dsftgfr', 'sdfvb', 'sdfvg', 4145, 'sdfvg', 'sdf', 'sdfv', 'sdf@sdf', 'sdfbg', '5114554', 1, 0),
(2, 'SDGF3454', 'sdf', 'sdf', '', 'sadfg', 'dsfg', 4561, 'dsfg', 'dfg', 'sdfg', 'dsfg@sdfg', 'sdf', '234324343', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `ID_Puesto` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `FK_Area` int(11) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`ID_Puesto`, `Nombre`, `FK_Area`, `Activo`, `Eliminado`) VALUES
(1, 'puesto1', 4, 1, 0),
(2, 'puesto2', 3, 1, 0),
(3, 'puesto3', 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(15) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `Contrasena` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre`, `Contrasena`, `Email`, `Tipo`) VALUES
(1, 'JuanR', '$2y$12$WPBjfyfNFUEnSMiohxzx6uhffSrYNoMP4ufRdDMuLFicmXtH7gL8e', 'jramongarciaangel@gmail.com', 1),
(4, 'Normal', '$2y$12$MTdUhKTbAM0DrdV4GziB1.VETL38DfpSA6JAHosLswdTjkCV63G26', 'normal123@gmail.com', 2);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `agregar_permisos` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
IF New.Tipo = '2' THEN
	INSERT INTO permisos VALUES('',New.ID_Usuario,'0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*','0*','0*0*0*0*','0*0*0*0*'); 
END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`ID_Area`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID_Permiso`),
  ADD KEY `FK_Usuario` (`FK_Usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`ID_Puesto`),
  ADD KEY `FK_Area` (`FK_Area`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `ID_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `ID_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `ID_Puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`FK_Area`) REFERENCES `areas` (`ID_Area`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
