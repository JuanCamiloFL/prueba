-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-11-2024 a las 13:22:29
-- Versión del servidor: 11.3.2-MariaDB
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyect_c`
--

DELIMITER $$
--
-- Funciones
--
DROP FUNCTION IF EXISTS `UC_Words`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `UC_Words` (`str` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET latin1 COLLATE latin1_swedish_ci  BEGIN  
  DECLARE c CHAR(1);  
  DECLARE s VARCHAR(255);  
  DECLARE i INT DEFAULT 1;  
  DECLARE bool INT DEFAULT 1;  
  DECLARE punct CHAR(17) DEFAULT ' ()[]{},.-_!@;:?/';  
  SET s = LCASE( str );  
  WHILE i < LENGTH( str ) DO  
     BEGIN  
       SET c = SUBSTRING( s, i, 1 );  
       IF LOCATE( c, punct ) > 0 THEN  
        SET bool = 1;  
      ELSEIF bool=1 THEN  
        BEGIN  
          IF c >= 'a' AND c <= 'z' THEN  
             BEGIN  
               SET s = CONCAT(LEFT(s,i-1),UCASE(c),SUBSTRING(s,i+1));  
               SET bool = 0;  
             END;  
           ELSEIF c >= '0' AND c <= '9' THEN  
            SET bool = 0;  
          END IF;  
        END;  
      END IF;  
      SET i = i+1;  
    END;  
  END WHILE;  
  RETURN s;  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `f_nacimiento` date NOT NULL,
  `nombre_empleado` varchar(50) NOT NULL,
  `apellido_empleado` varchar(50) NOT NULL,
  `cedula_empleado` bigint(20) NOT NULL,
  `correo_empleado` varchar(50) NOT NULL,
  `telefono_empleado` bigint(20) NOT NULL,
  `direccion_empleado` varchar(250) NOT NULL,
  `estado_empleado` int(1) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `foto_empleado` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `correo_empleado` (`correo_empleado`),
  KEY `id_grupo` (`id_grupo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `f_nacimiento`, `nombre_empleado`, `apellido_empleado`, `cedula_empleado`, `correo_empleado`, `telefono_empleado`, `direccion_empleado`, `estado_empleado`, `id_grupo`, `foto_empleado`, `created_at`, `updated_at`) VALUES
(1, '1980-07-21', 'Jair', 'Ramirez', 123456, 'jr@gmail.com', 3222010101, 'Cra 54 89-34', 0, 1, '/Proyecto Camilo/imagenes/usuarios/Jr.png', '2021-07-22 02:15:25', '2024-11-02 02:17:03'),
(2, '1979-05-10', 'Andres', 'Contreras', 1234567, 'romano@gmail.com', 3222010102, 'Diag 45 89-65', 1, 3, '/Proyecto Camilo/imagenes/usuarios/usr_202108040014.png', '2021-07-15 20:54:03', '2024-11-02 02:17:23'),
(3, '2003-05-10', 'Marcela', 'Benjumea', 19698745, 'marce@gmail.com', 3698574, 'Cra 85', 0, 3, '/Proyecto Camilo/imagenes/usuarios/est_202411020220.png', '2024-11-02 02:20:24', '0000-00-00 00:00:00'),
(4, '2003-09-10', 'Camilo', 'Cifuentes', 98745666, 'dante@gmail.com', 96857411, 'Carar', 1, 1, '/Proyecto Camilo/imagenes/usuarios/images.jpg', '2024-11-02 02:31:29', '2024-11-02 03:02:20'),
(5, '1985-06-10', 'Julian Andres', 'Fernandez', 88888888, 'jul@gmail.com', 36985745, 'Cra 78', 1, 2, '/Proyecto Camilo/imagenes/usuarios/est_202411020302.png', '2024-11-02 03:02:20', '2024-11-02 12:54:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_nivel` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_nivel`, `created_at`, `updated_at`) VALUES
(1, 'Activo', '2021-08-19 01:48:43', '2024-11-02 12:40:09'),
(2, 'Inactivo', '2021-08-19 01:48:43', '2024-11-02 12:40:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `numero_grupo` varchar(50) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `numero_grupo`, `nombre_grupo`, `created_at`, `updated_at`) VALUES
(1, 'Logistica', 'D101', '2021-08-19 01:46:18', '2024-11-01 18:56:27'),
(2, 'Recursos Humanos', 'D102', '2021-08-19 01:46:18', '2024-11-01 18:56:37'),
(3, 'Sistemas', 'D103', '2021-08-19 01:46:18', '2024-11-01 18:56:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

DROP TABLE IF EXISTS `niveles`;
CREATE TABLE IF NOT EXISTS `niveles` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_nivel` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id_nivel`, `nombre_nivel`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2021-08-19 01:48:43', '0000-00-00 00:00:00'),
(2, 'Usuario', '2021-08-19 01:48:43', '2024-11-01 23:28:11'),
(3, 'Invitado', '2021-08-19 01:48:43', '2024-11-01 23:28:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `pass_usuario` varchar(255) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `codigo_usuario` bigint(20) NOT NULL,
  `estado_usuario` varchar(15) NOT NULL,
  `foto_usuario` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  KEY `nivel_usuario` (`id_nivel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `pass_usuario`, `id_nivel`, `codigo_usuario`, `estado_usuario`, `foto_usuario`, `created_at`, `updated_at`) VALUES
(1, 'jr@gmail.com', '123456', 1, 1, '1', '/Proyecto Camilo/imagenes/usuarios/jr.png', '2021-07-17 23:59:45', '2024-11-02 02:16:29'),
(2, 'romano@gmail.com', '1234567', 2, 2, '1', '/Proyecto Camilo/imagenes/usuarios/usr_202108040014.png', '2021-07-19 02:33:45', '2024-11-02 02:17:23'),
(3, 'marce@gmail.com', '19698745', 2, 3, '0', '/Proyecto Camilo/imagenes/usuarios/est_202411020220.png', '2024-11-02 02:20:24', '0000-00-00 00:00:00'),
(4, 'dante@gmail.com', '98745666', 1, 4, '1', '/Proyecto Camilo/imagenes/usuarios/images.jpg', '2024-11-02 02:31:29', '2024-11-02 03:02:20'),
(5, 'jul@gmail.com', '88888888', 1, 5, '1', '/Proyecto Camilo/imagenes/usuarios/est_202411020302.png', '2024-11-02 03:02:20', '0000-00-00 00:00:00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id_nivel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
