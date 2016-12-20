-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2016 a las 20:25:18
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

CREATE TABLE `department` (
  `Code` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Boss` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `department`
--

INSERT INTO `department` (`Code`, `Name`, `Boss`) VALUES
(1, 'prueba', NULL),
(2, 'Tecnology', '49865860C'),
(3, 'Accounting', '41745391T'),
(4, 'Sales', NULL),
(5, 'Purchases', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `DNI` varchar(9) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TelePhone` int(9) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Code_Dep` int(11) NOT NULL,
  `role` set('big_boss','dep_boss','employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`DNI`, `Name`, `Surname`, `Email`, `TelePhone`, `Password`, `Code_Dep`, `role`) VALUES
('41745391T', 'Marcos', 'Arena', 'marenacavaller@gmail.com', 615931540, '32a9f3f6987be377df7bf3a2a9ce0e89f4aa6587', 3, 'dep_boss'),
('49865860C', 'Sebastian', 'Rodriguez', 'sebanacional@hotmail.com', 662391815, '123456', 1, 'big_boss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Time_Start` datetime NOT NULL,
  `Time_Finish` datetime DEFAULT NULL,
  `State` set('Open','Pending','Finished') NOT NULL,
  `Employee` varchar(9) NOT NULL,
  `Department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`ID`, `Name`, `Description`, `Time_Start`, `Time_Finish`, `State`, `Employee`, `Department`) VALUES
(1, 'Task1', 'That''s task1... Hurry up', '2016-12-20 20:23:31', '0000-00-00 00:00:00', 'Open', '41745391T', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Code`),
  ADD KEY `BossFK` (`Boss`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `Code_Dep` (`Code_Dep`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Employee` (`Employee`),
  ADD KEY `Department` (`Department`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `BossFK` FOREIGN KEY (`Boss`) REFERENCES `employees` (`DNI`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`Code_Dep`) REFERENCES `department` (`Code`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`Employee`) REFERENCES `employees` (`DNI`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`Department`) REFERENCES `department` (`Code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
