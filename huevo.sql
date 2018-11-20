-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2018 a las 04:51:12
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
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`ID_Area`, `Codigo`, `Nombre`, `Activo`, `Eliminado`) VALUES
(2, 'dhbdfzbdzf', 'Sistemas', 1, 0),
(3, 'ezatsw25', 'area2', 1, 1),
(4, 'we34', 'area3', 1, 1),
(5, 'r435', 'Compras', 1, 0),
(6, 'ikuiuio32', 'Area4', 1, 1),
(7, 'asddf33', 'area5', 1, 1),
(8, 'retrta373', 'area6', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Domicilio` varchar(150) NOT NULL,
  `Colonia` varchar(40) NOT NULL,
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

INSERT INTO `clientes` (`ID_Cliente`, `Codigo`, `Nombre`, `Domicilio`, `Colonia`, `Ciudad`, `Estado`, `Pais`, `CP`, `RazonSocial`, `RFC`, `Telefono`, `Email`, `Contacto`, `TelContacto`, `Activo`, `Eliminado`) VALUES
(1, 'DFFRG267162377', 'Prueba', 'prueba fhdjvnxkj', 'sddcds', 'nbvcx', 'sdffhn', 'sdfcvg', 47190, 'shjdbchjs', 'sadfg24345', '1323244554', 'xzcvbb@sdfg.com', 'sdfgh', '213243454543', 1, 0),
(6, 'H34453', 'dfvbg', 'dfgh', '', 'sdfg', 'sdfg', 'sdf', 4, 'sdf', 'sdf', 'sdf', 'sdfg@sdfg', 'sdfg', 'sdfg', 0, 1),
(7, '2101514', 'Gigantes Tepa SA', 'Kilometro 4 Tepa Yahualica', 'Colonia 1', 'Tepatitlan', 'Jalisco', 'Mexico', 47600, 'Gigantes Tepa SA', 'GTE851217LL3', '3787888250', 'recepcion@gigantesagroindustria.com', 'Claudia Savedra', 'ext. 8033', 1, 0),
(8, 'scd', 'vcbvfbvbvc', 'dfzdsvfb', 'dsvvvfds', 'dvdvsz', 'dszv', 'sdvdv', 434, 'dsvds', 'dsdv', '24334324', 'dzvd@sdsd', 'zcdxc', '33432434', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_Compra` int(11) NOT NULL,
  `FK_Orden` int(11) NOT NULL,
  `Folio` varchar(30) NOT NULL,
  `FK_Proveedor` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Fecha` datetime NOT NULL,
  `Cancelada` tinyint(1) NOT NULL,
  `Eliminada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`ID_Compra`, `FK_Orden`, `Folio`, `FK_Proveedor`, `Total`, `Fecha`, `Cancelada`, `Eliminada`) VALUES
(2, 2, 'CPG1', 1, 700, '2018-10-28 21:00:49', 0, 0),
(3, 1, 'CPG2', 2, 423.4, '2018-10-28 21:01:36', 0, 0),
(4, 2, 'CPG3', 1, 700, '2018-10-28 21:18:53', 0, 0),
(5, 3, 'CPG4', 2, 400, '2018-10-28 21:21:21', 0, 0),
(6, 1, 'CPP1', 2, 423.4, '2018-10-30 12:48:48', 0, 0),
(7, 4, 'CPG5', 2, 162.4, '2018-10-30 12:51:19', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `ID_Compras_Detalle` int(11) NOT NULL,
  `FK_Compra` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Cantidad` double NOT NULL,
  `Precio_Unitario` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Descuento` double NOT NULL,
  `IVA` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_detalle`
--

INSERT INTO `compras_detalle` (`ID_Compras_Detalle`, `FK_Compra`, `FK_Producto`, `Cantidad`, `Precio_Unitario`, `Subtotal`, `Descuento`, `IVA`, `Total`) VALUES
(2, 2, 3, 200, 3.5, 700, 0, 0, 700),
(3, 3, 1, 50, 6.5, 325, 0, 16, 377),
(4, 3, 4, 5, 8, 40, 0, 16, 46.4),
(5, 4, 3, 200, 3.5, 700, 0, 0, 700),
(6, 5, 3, 100, 4, 400, 0, 0, 400),
(7, 6, 1, 50, 6.5, 325, 0, 16, 377),
(8, 6, 4, 5, 8, 40, 0, 16, 46.4),
(9, 7, 1, 20, 7, 140, 0, 16, 162.4);

--
-- Disparadores `compras_detalle`
--
DELIMITER $$
CREATE TRIGGER `aumentar_inventario` AFTER INSERT ON `compras_detalle` FOR EACH ROW BEGIN
	IF (SELECT Costo_Actual FROM precios WHERE FK_Producto=New.FK_Producto) > 0 THEN
		UPDATE precios SET Costo_Actual=New.Precio_Unitario,Costo_Promedio=(((SELECT Existencia FROM productos WHERE ID_Producto=New.FK_Producto)*Costo_Promedio)+(New.Cantidad*New.Precio_Unitario))/((SELECT Existencia FROM productos WHERE ID_Producto=New.FK_Producto)+New.Cantidad) WHERE precios.FK_Producto=New.FK_Producto;
    ELSE
    	UPDATE precios SET Costo_Actual=New.Precio_Unitario,Costo_Promedio=New.Precio_Unitario WHERE precios.FK_Producto=New.FK_Producto;
    END IF;
    
	UPDATE productos SET Existencia=Existencia+New.Cantidad WHERE ID_Producto=New.FK_Producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `ID_Empleado` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Ap_Pat` varchar(30) NOT NULL,
  `Ap_Mat` varchar(30) NOT NULL,
  `Domicilio` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Ciudad` varchar(40) NOT NULL,
  `Estado` varchar(40) NOT NULL,
  `Pais` varchar(40) NOT NULL,
  `CP` int(11) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `FK_Puesto` int(11) NOT NULL,
  `SDI` double NOT NULL,
  `Alergias` varchar(200) NOT NULL,
  `TipoSangre` varchar(5) NOT NULL,
  `Emergencia` varchar(100) NOT NULL,
  `TelEmergencia` varchar(30) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `FechaBaja` date NOT NULL,
  `FechaReingreso` date NOT NULL,
  `Estatus` int(11) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID_Empleado`, `Codigo`, `Nombre`, `Ap_Pat`, `Ap_Mat`, `Domicilio`, `Colonia`, `Ciudad`, `Estado`, `Pais`, `CP`, `Telefono`, `Email`, `FK_Puesto`, `SDI`, `Alergias`, `TipoSangre`, `Emergencia`, `TelEmergencia`, `FechaIngreso`, `FechaBaja`, `FechaReingreso`, `Estatus`, `Eliminado`) VALUES
(1, 'dnsj323', 'Juan RamÃ³n', 'GarcÃ­a', 'Ãngel', 'Pedro Velazquez #99', 'Caja Popular', 'Arandas', 'Jalisco', 'Mexico', 47180, '3481167983', 'jramongarciaangel@gmail.com', 1, 500, 'Ninguna', 'A', 'MartÃ­n GarcÃ­a', '3481045689', '2018-09-03', '0000-00-00', '0000-00-00', 0, 0),
(2, 'asf2334', 'prueba', 'dsfg', 'sdf', 'sdfg$colonia=fdvfdfvd', 'dsd', 'sdf', 'sdfgg', 'sdf', 47160, '6514566', 'sdf@dsffd', 4, 400, 'dsfg', 'A-', 'sdfvgbg', '61656', '2018-09-03', '0000-00-00', '0000-00-00', 0, 0),
(3, 'gfd324324', 'aSdfg', 'sdfg', 'sdfgg', 'vbcn', '', 'sdffv', 'szdvbg', 'dfvbg', 47150, 'sdzxcv', 'sdfQ@sadf', 1, 400, 'sdfbg', 'B ', 'sdffdfv', '545625136', '2018-09-03', '0000-00-00', '0000-00-00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `ID_Entrega` int(11) NOT NULL,
  `Folio` varchar(30) NOT NULL,
  `FK_Empleado` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Fecha` datetime NOT NULL,
  `Cancelada` tinyint(1) NOT NULL,
  `Eliminada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`ID_Entrega`, `Folio`, `FK_Empleado`, `Total`, `Fecha`, `Cancelada`, `Eliminada`) VALUES
(2, 'EGHJ1', 1, 61.53, '2018-11-19 18:59:30', 0, 0),
(3, 'EGHJ2', 1, 27.84, '2018-11-19 19:02:42', 0, 0),
(4, 'EGHJ3', 2, 22.69, '2018-11-19 19:04:16', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas_detalles`
--

CREATE TABLE `entregas_detalles` (
  `ID_Entrega_Detalle` int(11) NOT NULL,
  `FK_Entrega` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Cantidad` double NOT NULL,
  `Costo` double NOT NULL,
  `Subtotal` double NOT NULL,
  `IVA` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entregas_detalles`
--

INSERT INTO `entregas_detalles` (`ID_Entrega_Detalle`, `FK_Entrega`, `FK_Producto`, `Cantidad`, `Costo`, `Subtotal`, `IVA`, `Total`) VALUES
(1, 2, 1, 2, 6.52, 13.04, 16, 15.13),
(2, 2, 4, 5, 8, 40, 16, 46.4),
(3, 3, 4, 3, 8, 24, 16, 27.84),
(4, 4, 1, 3, 6.52, 19.56, 16, 22.69);

--
-- Disparadores `entregas_detalles`
--
DELIMITER $$
CREATE TRIGGER `quitar_entregas` AFTER INSERT ON `entregas_detalles` FOR EACH ROW BEGIN
	UPDATE productos SET Existencia = Existencia - New.Cantidad WHERE ID_Producto = New.FK_Producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folios`
--

CREATE TABLE `folios` (
  `ID_Folio` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Serie` varchar(4) NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `folios`
--

INSERT INTO `folios` (`ID_Folio`, `Nombre`, `Serie`, `Tipo`) VALUES
(1, 'Almacen General', 'OCAG', 1),
(4, 'Prueba2', 'OCPP', 1),
(5, 'Prueba', 'CPP', 2),
(8, 'AlmacÃ©n General', 'CPG', 2),
(18, 'Prueba4', 'OCYU', 1),
(19, 'Entrega Prueba', 'EGHJ', 3),
(20, 'gfcjbknmjl', 'UIOY', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generales`
--

CREATE TABLE `generales` (
  `ID_General` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Domicilio` varchar(150) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Ciudad` varchar(40) NOT NULL,
  `Estado` varchar(40) NOT NULL,
  `Pais` varchar(40) NOT NULL,
  `CP` int(11) NOT NULL,
  `RazonSocial` varchar(60) NOT NULL,
  `RFC` varchar(60) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generales`
--

INSERT INTO `generales` (`ID_General`, `Nombre`, `Domicilio`, `Colonia`, `Ciudad`, `Estado`, `Pais`, `CP`, `RazonSocial`, `RFC`, `Telefono`, `Email`) VALUES
(1, 'Gigantes Agroindustria', 'Carretera TepatitlÃ¡n Yahualica Km 4', '', 'TepatitlÃ¡n de Morelos', 'Jalisco', 'MÃ©xico', 47600, 'fvc', 'dsvvdfdfvfdvzfd', 'Tel. (378) 7888250-59', 'ventas@gigantesagroindustria.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `ID_Orden` int(11) NOT NULL,
  `Folio` varchar(30) NOT NULL,
  `FK_Proveedor` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Fecha` datetime NOT NULL,
  `Convertida` tinyint(1) NOT NULL,
  `Eliminada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`ID_Orden`, `Folio`, `FK_Proveedor`, `Total`, `Fecha`, `Convertida`, `Eliminada`) VALUES
(1, 'OCAG1', 2, 423.4, '2018-10-21 14:58:07', 1, 0),
(2, 'OCP1', 1, 700, '2018-10-21 15:04:01', 1, 0),
(3, 'OCPP1', 2, 400, '2018-10-28 21:04:04', 1, 0),
(4, 'OCAG2', 2, 162.4, '2018-10-30 12:51:03', 1, 0),
(5, 'OCAG3', 2, 63.8, '2018-11-04 18:27:13', 0, 0),
(6, 'OCAG4', 1, 24.36, '2018-11-19 19:16:02', 0, 0),
(7, 'OCAG5', 1, 24.36, '2018-11-19 19:27:28', 0, 0),
(8, 'OCAG6', 1, 98.6, '2018-11-19 19:28:13', 0, 0),
(9, 'OCPP2', 2, 59.16, '2018-11-19 19:33:58', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra_detalle`
--

CREATE TABLE `orden_compra_detalle` (
  `ID_Orden_Detalle` int(11) NOT NULL,
  `FK_Orden_Compra` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Cantidad` double NOT NULL,
  `Precio_Unitario` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Descuento` double NOT NULL,
  `IVA` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_compra_detalle`
--

INSERT INTO `orden_compra_detalle` (`ID_Orden_Detalle`, `FK_Orden_Compra`, `FK_Producto`, `Cantidad`, `Precio_Unitario`, `Subtotal`, `Descuento`, `IVA`, `Total`) VALUES
(1, 1, 1, 50, 6.5, 325, 0, 16, 377),
(2, 1, 4, 5, 8, 40, 0, 16, 46.4),
(3, 2, 3, 200, 3.5, 700, 0, 0, 700),
(4, 3, 3, 100, 4, 400, 0, 0, 400),
(5, 4, 1, 20, 7, 140, 0, 16, 162.4),
(6, 5, 5, 10, 5.5, 55, 0, 16, 63.8),
(7, 6, 5, 3, 7, 21, 0, 16, 24.36),
(8, 7, 5, 3, 7, 21, 0, 16, 24.36),
(9, 8, 4, 10, 8.5, 85, 0, 16, 98.6),
(10, 9, 4, 6, 8.5, 51, 0, 16, 59.16);

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
  `Empleados` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`ID_Permiso`, `FK_Usuario`, `Productos`, `Clientes`, `Ventas`, `Proveedores`, `Compras`, `Produccion`, `Entregas`, `Reportes`, `Etiquetas`, `Empleados`) VALUES
(2, 4, '1*0*0*0*1*0*', '1*0*0*0*', '1*1*0*0*', '1*0*0*0*', '1*0*0*0*', '0*0*0*0*', '0*0*0*0*', '1*', '1*', '0*0*0*0*');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `ID_Precio` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Costo_Actual` double NOT NULL,
  `Costo_Promedio` double NOT NULL,
  `Precio1` double NOT NULL,
  `Precio2` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`ID_Precio`, `FK_Producto`, `Costo_Actual`, `Costo_Promedio`, `Precio1`, `Precio2`) VALUES
(1, 1, 7, 6.5212765957446805, 0, 0),
(2, 2, 0, 0, 0, 0),
(3, 3, 4, 3.5625, 0, 0),
(4, 4, 8, 8, 0, 0),
(5, 5, 0, 0, 0, 0);

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
  `IVA` double NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Codigo`, `Nombre`, `UME`, `Categoria`, `Existencia`, `Max`, `Min`, `IVA`, `Activo`, `Eliminado`) VALUES
(1, 'ABC123', 'JabÃ³n', 'Pieza', 'Insumo', 470, 300, 50, 16, 1, 0),
(2, 'TUI123', 'Huevo liquido', 'Litro', 'Producto Terminado', 2255, 10000, 1000, 0, 1, 0),
(3, 'ERT123', 'Huevo frÃ¡gil', 'Kg', 'Materia Prima', 800, 200, 20000, 0, 1, 0),
(4, 'KUI123', 'Prueba', 'Pieza', 'Insumo', 205, 100, 10, 16, 1, 0),
(5, 'GHY123', 'Guantes', 'Litro', 'Insumo', 20, 50, 10, 16, 1, 0);

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `agrear_precio` AFTER INSERT ON `productos` FOR EACH ROW BEGIN
	INSERT INTO precios VALUES(null,New.ID_Producto,0,0,0,0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Domicilio` varchar(150) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
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

INSERT INTO `proveedores` (`ID_Proveedor`, `Codigo`, `Nombre`, `Domicilio`, `Colonia`, `Ciudad`, `Estado`, `Pais`, `CP`, `RazonSocial`, `RFC`, `Telefono`, `Email`, `Contacto`, `TelContacto`, `Activo`, `Eliminado`) VALUES
(1, 'SZDSFDF234', 'sdfbgsdfg', 'sdfg', 'saddsdc', 'dsftgfr', 'sdfvb', 'sdfvg', 4145, 'sdfvg', 'sdf', 'sdfv', 'sdf@sdf', 'sdfbg', '5114554', 1, 0),
(2, 'SDGF3454', 'sdf', 'sdf', 'dsnlkds', 'gdfgfhb', 'sadfg', 'dsfg', 4561, 'dsfg', 'dfg', 'sdfg', 'dsfg@sdfg', 'sdf', '234324343', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `ID_Puesto` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `FK_Area` int(11) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`ID_Puesto`, `Codigo`, `Nombre`, `FK_Area`, `Activo`, `Eliminado`) VALUES
(1, 'safcdsfcs', 'Soporte', 2, 1, 0),
(2, 'd44ds', 'puesto2', 3, 0, 1),
(3, 'kbj345', 'puesto3', 4, 1, 1),
(4, 'kdf546', 'Gerente Compras', 5, 1, 0),
(5, 'aafd456', 'puesto3', 4, 0, 1),
(6, 'jgjky656', 'puesto4', 4, 1, 1);

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
	INSERT INTO permisos VALUES('',New.ID_Usuario,'0*0*0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*0*0*0*','0*','0*','0*0*0*0*','0*0*'); 
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
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `FK_Orden` (`FK_Orden`),
  ADD KEY `FK_Proveedor` (`FK_Proveedor`);

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`ID_Compras_Detalle`),
  ADD KEY `FK_Compra` (`FK_Compra`),
  ADD KEY `FK_Producto` (`FK_Producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_Empleado`),
  ADD KEY `FK_Puesto` (`FK_Puesto`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`ID_Entrega`),
  ADD KEY `FK_Empleado` (`FK_Empleado`);

--
-- Indices de la tabla `entregas_detalles`
--
ALTER TABLE `entregas_detalles`
  ADD PRIMARY KEY (`ID_Entrega_Detalle`),
  ADD KEY `FK_Entrega` (`FK_Entrega`),
  ADD KEY `FK_Producto` (`FK_Producto`);

--
-- Indices de la tabla `folios`
--
ALTER TABLE `folios`
  ADD PRIMARY KEY (`ID_Folio`),
  ADD UNIQUE KEY `Serie` (`Serie`);

--
-- Indices de la tabla `generales`
--
ALTER TABLE `generales`
  ADD PRIMARY KEY (`ID_General`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`ID_Orden`),
  ADD KEY `FK_Proveedor` (`FK_Proveedor`);

--
-- Indices de la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  ADD PRIMARY KEY (`ID_Orden_Detalle`),
  ADD KEY `FK_Orden_Compra` (`FK_Orden_Compra`),
  ADD KEY `FK_Producto` (`FK_Producto`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID_Permiso`),
  ADD KEY `FK_Usuario` (`FK_Usuario`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`ID_Precio`),
  ADD KEY `FK_Producto` (`FK_Producto`);

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
  MODIFY `ID_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  MODIFY `ID_Compras_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `ID_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `ID_Entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `entregas_detalles`
--
ALTER TABLE `entregas_detalles`
  MODIFY `ID_Entrega_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `folios`
--
ALTER TABLE `folios`
  MODIFY `ID_Folio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `generales`
--
ALTER TABLE `generales`
  MODIFY `ID_General` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `ID_Orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  MODIFY `ID_Orden_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `ID_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `ID_Precio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `ID_Puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`FK_Orden`) REFERENCES `orden_compra` (`ID_Orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`FK_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD CONSTRAINT `compras_detalle_ibfk_1` FOREIGN KEY (`FK_Compra`) REFERENCES `compras` (`ID_Compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_detalle_ibfk_2` FOREIGN KEY (`FK_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`FK_Puesto`) REFERENCES `puestos` (`ID_Puesto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`FK_Empleado`) REFERENCES `empleados` (`ID_Empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entregas_detalles`
--
ALTER TABLE `entregas_detalles`
  ADD CONSTRAINT `entregas_detalles_ibfk_1` FOREIGN KEY (`FK_Entrega`) REFERENCES `entregas` (`ID_Entrega`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entregas_detalles_ibfk_2` FOREIGN KEY (`FK_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`FK_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_compra_detalle`
--
ALTER TABLE `orden_compra_detalle`
  ADD CONSTRAINT `orden_compra_detalle_ibfk_1` FOREIGN KEY (`FK_Orden_Compra`) REFERENCES `orden_compra` (`ID_Orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_detalle_ibfk_2` FOREIGN KEY (`FK_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`FK_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `precios_ibfk_1` FOREIGN KEY (`FK_Producto`) REFERENCES `productos` (`ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`FK_Area`) REFERENCES `areas` (`ID_Area`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
