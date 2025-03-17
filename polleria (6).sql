-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2025 a las 04:26:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_pedido`
--

CREATE TABLE `auditoria_pedido` (
  `id_auditoria` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebida`
--

CREATE TABLE `bebida` (
  `id_bebida` int(11) NOT NULL,
  `tipo_bebida` varchar(100) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bebida`
--

INSERT INTO `bebida` (`id_bebida`, `tipo_bebida`, `nombre`, `precio`, `imagen`) VALUES
(1, 'Refresco', 'Coca Cola', 4.50, 'coca_cola.png'),
(2, 'Refresco', 'Pepsi', 3.40, 'pepsi.png'),
(3, 'Agua', 'Agua Mineral', 1.50, 'agua_mineral.png'),
(4, 'Jugo', 'Jugo de Naranja', 4.00, 'jugo_naranja.png'),
(5, 'Jugo', 'Jugo de Manzana', 4.10, 'jugo_manzana.png'),
(6, 'Refresco', 'Sprite', 3.60, 'sprite.png'),
(7, 'Cerveza', 'Corona', 5.00, 'corona.png'),
(8, 'Cerveza', 'Heineken', 5.20, 'heineken.png'),
(9, 'Café', 'Café Americano', 6.80, 'cafe_americano.png'),
(10, 'Café', 'Café Expreso', 6.30, 'cafe_expreso.png'),
(11, 'Trago', 'Mojito', 5.50, 'mojito.png'),
(12, 'Trago', 'Margarita', 5.00, 'margarita.png'),
(13, 'Trago', 'Piña Colada', 7.80, 'pina_colada.png'),
(14, 'Trago', 'Bloody Mary', 6.20, 'bloody_mary.png'),
(15, 'Trago', 'Caipirinha', 5.90, 'caipirinha.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `codigo_cuenta` varchar(20) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado_pago` varchar(50) DEFAULT 'Pendiente',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuenta`
--

CREATE TABLE `detalle_cuenta` (
  `id_detalle_cuenta` int(11) NOT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  `id_plato` int(11) DEFAULT NULL,
  `id_bebida` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `tipo_producto` enum('plato','bebida') DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `tipo_producto`, `id_producto`, `nombre_producto`, `cantidad`, `precio_unitario`, `precio_total`) VALUES
(1, 1, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 9, 35.00, 315.00),
(2, 1, 'plato', 6, 'Parrilla de Pollo', 9, 65.00, 585.00),
(3, 1, 'plato', 7, 'Parrilla Mixta', 9, 85.00, 765.00),
(4, 1, 'bebida', 5, 'Jugo de Manzana', 8, 4.10, 32.80),
(5, 2, 'plato', 8, 'Costillas BBQ', 1, 90.00, 90.00),
(6, 2, 'plato', 11, 'Churrasco de Res', 1, 80.00, 80.00),
(7, 2, 'plato', 4, 'Pollo a la Brasa 1/8 de Pollo a la Brasa', 1, 15.00, 15.00),
(8, 2, 'plato', 7, 'Parrilla Mixta', 1, 85.00, 85.00),
(9, 2, 'bebida', 3, 'Agua Mineral', 1, 1.50, 1.50),
(10, 2, 'bebida', 6, 'Sprite', 1, 3.60, 3.60),
(11, 2, 'bebida', 8, 'Heineken', 1, 5.20, 5.20),
(12, 3, 'plato', 17, 'Hamburguesa con Queso', 1, 23.00, 23.00),
(13, 3, 'bebida', 9, 'Café Americano', 1, 6.80, 6.80),
(14, 4, 'plato', 5, 'Parrilla de Res', 1, 70.00, 70.00),
(15, 4, 'plato', 18, 'Hamburguesa Doble', 1, 30.00, 30.00),
(16, 4, 'bebida', 6, 'Sprite', 1, 3.60, 3.60),
(17, 4, 'bebida', 13, 'Piña Colada', 1, 7.80, 7.80),
(18, 4, 'bebida', 11, 'Mojito', 1, 5.50, 5.50),
(19, 5, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 1, 35.00, 35.00),
(20, 5, 'bebida', 4, 'Jugo de Naranja', 1, 4.00, 4.00),
(21, 6, 'plato', 30, 'Piqueo de Tequeños', 1, 27.00, 27.00),
(22, 7, 'plato', 27, 'Piqueo de Salchipapas', 1, 25.00, 25.00),
(23, 7, 'plato', 10, 'Parrilla de Cordero', 1, 95.00, 95.00),
(24, 7, 'bebida', 10, 'Café Expreso', 1, 6.30, 6.30),
(25, 7, 'bebida', 9, 'Café Americano', 1, 6.80, 6.80),
(26, 8, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 7, 35.00, 245.00),
(27, 8, 'plato', 7, 'Parrilla Mixta', 9, 85.00, 765.00),
(28, 9, 'plato', 1, 'Pollo a la Brasa  Pollo Entero', 4, 60.00, 240.00),
(29, 9, 'plato', 46, 'Chaufa de Pollo', 3, 30.00, 90.00),
(30, 9, 'bebida', 7, 'Corona', 2, 5.00, 10.00),
(31, 9, 'bebida', 13, 'Piña Colada', 3, 7.80, 23.40),
(32, 10, 'plato', 6, 'Parrilla de Pollo', 1, 65.00, 65.00),
(33, 11, 'plato', 1, 'Pollo a la Brasa  Pollo Entero', 1, 60.00, 60.00),
(34, 12, 'plato', 1, 'Pollo a la Brasa  Pollo Entero', 1, 60.00, 60.00),
(35, 13, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 1, 35.00, 35.00),
(36, 14, 'bebida', 8, 'Heineken', 1, 5.20, 5.20),
(37, 15, 'plato', 12, 'Churrasco de Pollo', 1, 70.00, 70.00),
(38, 16, 'plato', 16, 'Hamburguesa BBQ', 1, 22.00, 22.00),
(39, 17, 'plato', 1, 'Pollo a la Brasa  Pollo Entero', 1, 60.00, 60.00),
(40, 18, 'plato', 49, 'Lomo Saltado a lo Pobre', 1, 30.00, 30.00),
(41, 18, 'bebida', 7, 'Corona', 1, 5.00, 5.00),
(42, 19, 'plato', 4, 'Pollo a la Brasa 1/8 de Pollo a la Brasa', 1, 15.00, 15.00),
(43, 20, 'bebida', 8, 'Heineken', 1, 5.20, 5.20),
(44, 21, 'plato', 3, 'Pollo a la Brasa  1/4 de Pollo a la Brasa', 1, 20.00, 20.00),
(45, 21, 'bebida', 5, 'Jugo de Manzana', 1, 4.10, 4.10),
(46, 22, 'plato', 18, 'Hamburguesa Doble', 1, 30.00, 30.00),
(47, 22, 'bebida', 15, 'Caipirinha', 1, 5.90, 5.90),
(48, 23, 'plato', 5, 'Parrilla de Res', 1, 70.00, 70.00),
(49, 23, 'plato', 1, 'Pollo a la Brasa  Pollo Entero', 1, 60.00, 60.00),
(50, 23, 'plato', 3, 'Pollo a la Brasa  1/4 de Pollo a la Brasa', 1, 20.00, 20.00),
(51, 23, 'bebida', 4, 'Jugo de Naranja', 1, 4.00, 4.00),
(52, 24, 'plato', 5, 'Parrilla de Res', 1, 70.00, 70.00),
(53, 24, 'bebida', 3, 'Agua Mineral', 1, 1.50, 1.50),
(54, 25, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 1, 35.00, 35.00),
(64, 29, 'plato', 2, 'Pollo a la Brasa Medio Pollo', 1, 35.00, 35.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `fecha_contratacion` date NOT NULL DEFAULT curdate(),
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_persona`, `fecha_contratacion`, `rol`) VALUES
(1, 1, '2025-03-15', 'Administrador'),
(2, 2, '2025-03-15', 'Cajero'),
(3, 3, '2025-03-15', 'Mesero'),
(4, 4, '2025-03-15', 'JefeCocina'),
(6, 6, '2025-03-15', 'Mesero'),
(7, 7, '2025-03-15', 'JefeCocina'),
(9, 9, '0000-00-00', 'Administrador'),
(10, 11, '0000-00-00', 'Mesero'),
(11, 14, '0000-00-00', 'Mesero'),
(12, 16, '0000-00-00', 'Mesero'),
(13, 17, '0000-00-00', 'Mesero'),
(14, 18, '0000-00-00', 'Administrador'),
(15, 19, '2025-03-16', 'Mesero'),
(16, 20, '2025-03-16', 'Cajero'),
(17, 21, '2025-03-16', 'Cajero'),
(18, 65, '2025-03-16', 'Cajero'),
(19, 66, '2025-03-16', 'Cajero'),
(21, 68, '2025-03-16', 'Administrador'),
(22, 69, '2025-03-16', 'Mesero'),
(23, 70, '2025-03-17', 'Mesero'),
(24, 71, '2025-03-17', 'Cajero'),
(25, 72, '2025-03-17', 'Administrador'),
(26, 73, '2025-03-17', 'Cajero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `ruc` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_cajero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `numero_mesa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `numero_mesa`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `monto_pagado` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_mesero` int(11) DEFAULT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `estado` enum('En cola','Listo','Entregado','Anulado') DEFAULT 'En cola',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_mesero`, `id_mesa`, `estado`, `fecha`) VALUES
(1, NULL, NULL, 'Anulado', '2025-03-15 15:17:05'),
(2, NULL, NULL, 'Anulado', '2025-03-15 15:33:29'),
(3, NULL, NULL, 'Anulado', '2025-03-15 15:34:21'),
(4, NULL, NULL, 'En cola', '2025-03-15 15:44:29'),
(5, NULL, NULL, 'En cola', '2025-03-15 16:07:00'),
(6, NULL, NULL, 'En cola', '2025-03-15 16:17:09'),
(7, NULL, NULL, 'En cola', '2025-03-15 16:24:16'),
(8, NULL, NULL, 'En cola', '2025-03-15 16:25:48'),
(9, NULL, NULL, 'Anulado', '2025-03-15 16:30:45'),
(10, NULL, NULL, 'Anulado', '2025-03-15 16:37:00'),
(11, NULL, NULL, 'Anulado', '2025-03-15 16:48:37'),
(12, NULL, NULL, 'Anulado', '2025-03-15 17:07:02'),
(13, NULL, NULL, 'Anulado', '2025-03-15 17:07:43'),
(14, NULL, NULL, 'En cola', '2025-03-15 17:08:34'),
(15, NULL, NULL, 'Anulado', '2025-03-15 17:12:24'),
(16, NULL, NULL, 'En cola', '2025-03-15 17:17:44'),
(17, NULL, NULL, 'En cola', '2025-03-15 17:27:28'),
(18, NULL, NULL, 'En cola', '2025-03-15 17:49:15'),
(19, NULL, NULL, 'En cola', '2025-03-15 18:03:33'),
(20, NULL, NULL, 'Anulado', '2025-03-15 18:08:06'),
(21, NULL, NULL, 'En cola', '2025-03-15 18:14:24'),
(22, NULL, NULL, 'En cola', '2025-03-15 18:14:57'),
(23, NULL, NULL, 'En cola', '2025-03-15 19:33:51'),
(24, NULL, NULL, 'En cola', '2025-03-16 07:46:13'),
(25, NULL, NULL, 'En cola', '2025-03-16 07:46:23'),
(29, NULL, NULL, 'En cola', '2025-03-16 23:29:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `dni`, `nombre`, `apellido`, `edad`, `direccion`, `telefono`) VALUES
(1, '71488519', 'Leydy Mercedes', 'Camacho Navarro', 20, 'Calle Amazonas 820 Castilla', '963937957'),
(2, '71488516', 'Francisco Eduardo ', 'Castillo Garcia', 24, 'Calle Amazonas 810 Castilla', '963937957'),
(3, '71488510', 'Walter Hugo', 'Huarache Arrieta', 24, 'Calle Amazonas 805 Castilla', '44856465'),
(4, '71488500', 'Erick Franco', 'Calle Castillo ', 20, 'Calle Amazonas 802 Castilla', '44856024'),
(5, '71488028', 'Greicy Judith', 'Silva Atoche', 24, 'Calle Amazonas 054 Castilla', '45484465'),
(6, '5316565', 'Chester', 'Camacho', 10, 'calee amanco', '4485602555'),
(7, '545451514', 'Luna', 'Camacho', 5, 'Calle Amazonas 742 Castilla', '44856451'),
(8, '71488554', 'Jhamir ', 'Garcia ', 20, 'Calle Amazonas 715 Castilla', '44856055'),
(9, '71488515', 'Daniel', 'Navarrio', 45, 'Calle Amazonas 805 Castilla', '5555555555'),
(11, '666', '6666', '5555', 55, 'Calle Amazonas 820 Castilla', '666'),
(14, '6664', '6666', '5555', 55, 'Calle Amazonas 820 Castilla', '666'),
(16, '71488514', 'sssssssss', 'rfff', 5, 'Calle Amazonas 805 Castilla', '51525'),
(17, '02675829', 'e', 'eeee', 4, 'eee', '444'),
(18, '0838383', 'House', 'Miau', 45, 'Calle Amazonas 56', '97883936'),
(19, '71488590', 'CHao', 'JUSS', 34, 'Calle Amazonas 805 Castilla', '5667777'),
(20, '71488533', 'Lidia', '5555', 34, 'Calle Amazonas 805 Castilla', '51525'),
(21, '053738233', 'Leyey', 'Miarjd', 34, 'Calle Amazonas 4440 Castilla', '9788393444'),
(65, '6666', '6666', '6666', 6, '66666666666', '66666666666'),
(66, 'rds', 'ddd', 'dddddd', 55, 'dddd', 'rrr'),
(68, '71488798', 'Lidia', 'Navarro Juarez', 60, 'Calle Amazonas 820 Castilla', '953920423'),
(69, '05748484', 'Princesa ', 'Silva Atoche', 17, 'San Martin ', '8499438303'),
(70, '7148566', 'd', 'Navarro ', 45, 'Calle Amazonas 156 Castilla', '5555555555'),
(71, '545', 'frrr', 'rrrr', 56, 'rttttt', '5555'),
(72, '02675345', 'Rojo Azul', 'Navarro Daniel', 23, 'Calle Amazonas 454 Castilla', '96393795'),
(73, '3444', 'Edu', 'Casr', 45, 'Calle Amazonas ', '454');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `id_plato` int(11) NOT NULL,
  `tipo_plato` varchar(100) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`id_plato`, `tipo_plato`, `nombre`, `precio`, `imagen`) VALUES
(1, 'Brasas', 'Pollo a la Brasa  Pollo Entero', 60.00, 'pollo-a-la-brasa ENTERO.png'),
(2, 'Brasas', 'Pollo a la Brasa Medio Pollo', 35.00, 'Polloalabrasa_MedioPollo.jpg'),
(3, 'Brasas', 'Pollo a la Brasa  1/4 de Pollo a la Brasa', 20.00, 'pollo_a_la brasa_cuartodepollo.png'),
(4, 'Brasas', 'Pollo a la Brasa 1/8 de Pollo a la Brasa', 15.00, 'octavodepollo.png'),
(5, 'Parrillas', 'Parrilla de Res', 70.00, 'parrilla_res.png'),
(6, 'Parrillas', 'Parrilla de Pollo', 65.00, 'parillapollo.png'),
(7, 'Parrillas', 'Parrilla Mixta', 85.00, 'parrilamixta.jpg'),
(8, 'Parrillas', 'Costillas BBQ', 90.00, 'costillasbbq.jpg'),
(9, 'Parrillas', 'Parrilla de Cerdo', 75.00, 'parrilla_cerdo.png'),
(10, 'Parrillas', 'Parrilla de Cordero', 95.00, 'parrilla_cordero.png'),
(11, 'Parrillas', 'Churrasco de Res', 80.00, 'churrasco.jpg'),
(12, 'Parrillas', 'Churrasco de Pollo', 70.00, 'churrasco_pollo.png'),
(13, 'Parrillas', 'Brochetas Mixtas', 65.00, 'brochetas_mixtas.png'),
(15, 'Hamburguesas', 'Hamburguesa Clásica', 20.00, 'hamburguesa_clasica.png'),
(16, 'Hamburguesas', 'Hamburguesa BBQ', 22.00, 'hamburguesa_bbq.png'),
(17, 'Hamburguesas', 'Hamburguesa con Queso', 23.00, 'hamburguesa_queso.png'),
(18, 'Hamburguesas', 'Hamburguesa Doble', 30.00, 'hamburguesa_doble.png'),
(19, 'Hamburguesas', 'Hamburguesa Vegetariana', 18.00, 'hamburguesa_vegetariana.png'),
(20, 'Hamburguesas', 'Hamburguesa de Pollo', 20.00, 'hamburguesa_pollo.png'),
(22, 'Hamburguesas', 'Hamburguesa Hawaiana', 26.00, 'hamburguesa_hawaiana.png'),
(24, 'Hamburguesas', 'Hamburguesa Suprema', 35.00, 'hamburguesa_suprema.png'),
(26, 'Piqueos', 'Piqueo de Papas Fritas', 20.00, 'piqueo_papas.png'),
(27, 'Piqueos', 'Piqueo de Salchipapas', 25.00, 'piqueo_salchipapas.png'),
(28, 'Piqueos', 'Piqueo de Nuggets', 28.00, 'piqueo_nuggets.png'),
(29, 'Piqueos', 'Piqueo de Alitas BBQ', 30.00, 'piqueo_alitas_bbq.png'),
(30, 'Piqueos', 'Piqueo de Tequeños', 27.00, 'piqueo_tequeños.jpg'),
(32, 'Piqueos', 'Piqueo de Nachos', 22.00, 'piqueo_nachos.png'),
(34, 'Piqueos', 'Piqueo de Anticuchos', 32.00, 'piqueo_anticuchos.png'),
(36, 'Acompañamientos', 'Ensalada César', 15.00, 'ensalada_cesar.png'),
(37, 'Acompañamientos', 'Arroz Blanco', 8.00, 'arroz_blanco.png'),
(38, 'Acompañamientos', 'Ensalada Rusa', 12.00, 'ensalada_rusa.png'),
(39, 'Acompañamientos', 'Tostones', 14.00, 'tostones.png'),
(40, 'Acompañamientos', 'Yuca Frita', 12.00, 'yuca_frita.png'),
(41, 'Acompañamientos', 'Camote Frito', 10.00, 'camote_frito.png'),
(42, 'Acompañamientos', 'Plátano Frito', 10.00, 'platano_frito.png'),
(43, 'Acompañamientos', 'Ensalada Mixta', 14.00, 'ensalada_mixta.png'),
(44, 'Acompañamientos', 'Puré de Papas', 12.00, 'pure_papas.png'),
(45, 'Fusión Criolla', 'Pollo Saltado a lo Pobre', 32.90, 'pollo_a_lo_pobre.png'),
(46, 'Fusión Criolla', 'Chaufa de Pollo', 30.00, 'chaufa.png\r\n'),
(48, 'Fusión Criolla', 'Lomo Saltado', 33.00, 'lomosaltado.png'),
(49, 'Fusión Criolla', 'Lomo Saltado a lo Pobre', 30.00, 'lomo_pobre.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_empleado`, `correo`, `contraseña`, `rol`) VALUES
(1, 1, 'leydy.mercedes@example.com', 'LeydyAdministrador10', 'Administrador'),
(2, 2, 'francisco.eduardo@example.com', 'FranciscoCajero65', 'Cajero'),
(3, 3, 'walter.hugo@example.com', 'WalterMesero24', 'Mesero'),
(4, 4, 'erick.franco@example.com', 'ErickJefeCocina86', 'JefeCocina'),
(6, 6, 'chester.camacho@example.com', 'ChesterMesero10', 'Mesero'),
(7, 7, 'luna.camacho@example.com', 'LunaJefeCocina5', 'JefeCocina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria_pedido`
--
ALTER TABLE `auditoria_pedido`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `bebida`
--
ALTER TABLE `bebida`
  ADD PRIMARY KEY (`id_bebida`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD UNIQUE KEY `codigo_cuenta` (`codigo_cuenta`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `idx_cuenta_estado_pago` (`estado_pago`);

--
-- Indices de la tabla `detalle_cuenta`
--
ALTER TABLE `detalle_cuenta`
  ADD PRIMARY KEY (`id_detalle_cuenta`),
  ADD KEY `id_cuenta` (`id_cuenta`),
  ADD KEY `id_plato` (`id_plato`),
  ADD KEY `id_bebida` (`id_bebida`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `idx_detalle_pedido_tipo_producto` (`tipo_producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cajero` (`id_cajero`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cuenta` (`id_cuenta`),
  ADD KEY `idx_pago_metodo_pago` (`metodo_pago`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_mesero` (`id_mesero`),
  ADD KEY `id_mesa` (`id_mesa`),
  ADD KEY `idx_pedido_estado` (`estado`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria_pedido`
--
ALTER TABLE `auditoria_pedido`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bebida`
--
ALTER TABLE `bebida`
  MODIFY `id_bebida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_cuenta`
--
ALTER TABLE `detalle_cuenta`
  MODIFY `id_detalle_cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `id_plato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria_pedido`
--
ALTER TABLE `auditoria_pedido`
  ADD CONSTRAINT `auditoria_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_cuenta`
--
ALTER TABLE `detalle_cuenta`
  ADD CONSTRAINT `detalle_cuenta_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_cuenta_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `plato` (`id_plato`) ON DELETE SET NULL,
  ADD CONSTRAINT `detalle_cuenta_ibfk_3` FOREIGN KEY (`id_bebida`) REFERENCES `bebida` (`id_bebida`) ON DELETE SET NULL;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cajero`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_mesero`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
