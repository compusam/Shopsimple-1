-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2014 at 06:44 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopsimple_cscore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL DEFAULT '0.00000',
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `category_order` int(10) unsigned NOT NULL,
  `category_status` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `id_parent`, `name`, `description`, `thumb_img`, `full_img`, `last_update`, `category_order`, `category_status`) VALUES
(1, 0, 'Artículos de Viaje', '', 'viaje.png', '', 1372783986, 1, 1),
(2, 0, 'Aventura', '', 'viaje.png', '', 1372783987, 2, 1),
(3, 0, 'Hogar', '', 'hogar.png', '', 1372783988, 3, 1),
(4, 0, 'Entretenimiento', '', 'entretenimiento.png', '', 1372783989, 4, 1),
(5, 0, 'Para Él', '', 'parael.png', '', 1372783990, 5, 1),
(6, 0, 'Para Ella', '', 'paraella.png', '', 1372783991, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `user_id`, `credit`, `last_update`) VALUES
(1, 1, 2, 1385996266);

-- --------------------------------------------------------

--
-- Table structure for table `credits_history`
--

CREATE TABLE IF NOT EXISTS `credits_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_period` int(10) unsigned NOT NULL,
  `id_username` int(10) unsigned NOT NULL,
  `credits` int(10) unsigned NOT NULL,
  `payments` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `credits_history`
--

INSERT INTO `credits_history` (`id`, `id_period`, `id_username`, `credits`, `payments`) VALUES
(1, 11, 1, 100, 0),
(2, 12, 1, 0, 74),
(3, 12, 1, 50, 0),
(4, 12, 1, 0, 74);

-- --------------------------------------------------------

--
-- Table structure for table `credits_periods`
--

CREATE TABLE IF NOT EXISTS `credits_periods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `from_date` int(10) unsigned NOT NULL,
  `to_date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `credits_periods`
--

INSERT INTO `credits_periods` (`id`, `name`, `from_date`, `to_date`) VALUES
(1, 'Enero', 1385877600, 1359698399),
(2, 'Febrero', 1359698400, 1362117599),
(3, 'Marzo', 1362117600, 1364795999),
(4, 'Abril', 1364796000, 1367384399),
(5, 'mayo', 1367384400, 1370062799),
(6, 'junio', 1370062800, 1372654799),
(7, 'julio', 1372654800, 1375333199),
(8, 'agosto', 1375333200, 1378011599),
(9, 'septiembre', 1378011600, 1380603599),
(10, 'octubre', 1380603600, 1383285599),
(11, 'noviembre', 1383285600, 1385877599),
(12, 'diciembre', 1385877600, 1388555999);

-- --------------------------------------------------------

--
-- Table structure for table `order_check`
--

CREATE TABLE IF NOT EXISTS `order_check` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_security` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_check`
--

INSERT INTO `order_check` (`id`, `id_security`, `user_id`, `total`, `order_date`, `ip`, `order_status`) VALUES
(1, 0, 1, 74.00000, 1385995867, 2147483647, 3),
(2, 0, 1, 74.00000, 1386283050, 2130706433, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE IF NOT EXISTS `order_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `order_status` int(10) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `order_status`, `order_date`, `ip`) VALUES
(1, 1, 1, 1385995867, 2147483647),
(2, 2, 1, 1386283050, 2130706433);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL,
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(1, 1, 44, 1, 74.00000, 0.00000, 74.00000),
(2, 2, 44, 1, 74.00000, 0.00000, 74.00000);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_status` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name_status`, `description`) VALUES
(1, 'Nuevo', ''),
(2, 'Pendiente', ''),
(3, 'Enviado', ''),
(4, 'Liberado', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `method_id` (`method_id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `method_id`, `order_id`, `user_id`, `total`) VALUES
(1, 1, 1, 1, 74.00000),
(2, 1, 2, 1, 74.00000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'Puntos');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `permission` enum('allow','deny') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `id_role`, `id_resource`, `permission`) VALUES
(1, 1, 1, 'allow'),
(2, 1, 2, 'allow'),
(3, 1, 3, 'allow'),
(4, 1, 4, 'allow'),
(5, 1, 5, 'allow'),
(6, 1, 6, 'allow'),
(7, 1, 7, 'allow'),
(8, 1, 10, 'allow'),
(9, 1, 11, 'allow'),
(10, 1, 12, 'allow'),
(11, 1, 13, 'allow'),
(12, 1, 14, 'allow'),
(13, 1, 15, 'allow'),
(16, 1, 18, 'allow'),
(19, 1, 21, 'allow'),
(20, 1, 22, 'allow'),
(21, 1, 23, 'allow'),
(22, 1, 24, 'allow'),
(23, 1, 25, 'allow'),
(24, 1, 26, 'allow'),
(25, 1, 27, 'allow'),
(26, 1, 28, 'allow'),
(27, 1, 29, 'allow'),
(31, 1, 33, 'allow'),
(32, 1, 34, 'allow'),
(33, 1, 35, 'allow'),
(34, 1, 36, 'allow'),
(35, 1, 37, 'allow'),
(36, 1, 38, 'allow'),
(37, 1, 39, 'allow'),
(38, 1, 40, 'allow'),
(39, 1, 41, 'allow'),
(40, 1, 42, 'allow'),
(41, 1, 43, 'allow');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `other_sku` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned DEFAULT '0',
  `product_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `other_sku`, `description`, `thumb_image`, `full_image`, `last_update`, `product_status`) VALUES
(1, 'Mundial001', 'Generador de vapor vertical', 'Generador de vapor vertical  para desarrugar prendas a base de calor seco', 'resized/Mundial001_200x200.jpg', 'Mundial001.jpg', 0, 1),
(2, 'Mundial002', 'Blenda procesador', 'Procesador de alimentos multifuncional, incluye 20 accesorios', 'resized/Mundial002_200x200.jpg', 'Mundial002.jpg', 0, 1),
(3, 'Mundial003', 'Blenda Grill GR-300', 'Panini grill con apertura a 180Â°, termostasto, timer y parrillas desmontables', 'resized/Mundial003_200x200.jpg', 'Mundial003.jpg', 0, 1),
(4, 'Mundial005', 'Plancha de uso domÃ©stico', 'Plancha de uso domÃ©stico, golpe de vapor, vapor continuo, autopieza, 2.5mt de cordon elÃ©ctrico y suela de cerÃ¡mica', 'resized/Mundial005_200x200.jpg', 'Mundial005.jpg', 0, 1),
(5, 'Mundial006', 'BASCULA DIGITAL', 'BASCULA DIGITAL COLOR SILVER BASE NEGRA Y AGARRADERA', 'resized/Mundial006_200x200.jpg', 'Mundial006.jpg', 0, 1),
(6, 'Mundial008', 'RECORTADORA DE BARBA Y BIGOTE 14 PZ', 'RECORTADOR DE BARBA Y BIGOTE DE 14 PZ. CON REC. DE VELLOS DE NARIZ Y OIDOS COMO BONO', 'resized/Mundial008_200x200.jpg', 'Mundial008.jpg', 0, 1),
(7, 'Mundial009', 'JUEGO DE PELUQUERIA 10 PZ', 'JUEGO DE PELUQUERIA 10 PZ', 'resized/Mundial009_200x200.jpg', 'Mundial009.jpg', 0, 1),
(8, 'Mundial012', 'SECADORA IONICA 1875W', 'SECADORA IONICA 1875 W NEGRA C/ AZUL', 'resized/Mundial012_200x200.jpg', 'Mundial012.jpg', 0, 1),
(9, 'Mundial014', 'COMBO 4 EN 1 TENAZA, ESPIRAL Y WAFFLERA CON CERAMICA', 'COMBO 4 EN 1 TENAZA, ESPIRAL Y WAFFLERA CON CERAMICA', 'resized/Mundial014_200x200.jpg', 'Mundial014.jpg', 0, 1),
(10, 'Mundial016', 'LICUADORA OSTER 10 VEL VASO DE PLASTICO', 'LICUADORA OSTER 10 VEL VASO DE PLASTICO 1.400 LTS  450WATTS', 'resized/Mundial016_200x200.jpg', 'Mundial016.jpg', 0, 1),
(11, 'Mundial017', 'LICUADORA CLASICA 2 VEL BASE DE METAL VASO DE VIDRIO', 'LICUADORA CLASICA 2 VEL BASE DE METAL VASO DE VIDRIO 1.250 LTS 400 WATTS', 'resized/Mundial017_200x200.jpg', 'Mundial017.jpg', 0, 1),
(12, 'Mundial018', 'BATIDORA FUENTE DE SODAS OSTER', 'BATIDORA FUENTE DE SODAS OSTER', 'resized/Mundial018_200x200.jpg', 'Mundial018.jpg', 0, 1),
(13, 'Mundial019', 'HORNO TOSTADOR CAPACIDAD PARA 4 REBANADAS', 'HORNO TOSTADOR CAPACIDAD PARA 4 REBANADAS COTROL AJUSTABLE DE TEMPERATURA LUZ INDICADORA DE ENCENDIDO', 'resized/Mundial019_200x200.jpg', 'Mundial019.jpg', 0, 1),
(14, 'Mundial020', 'PLANCHA DE VAPOR OSTER SUEL CON ANTIADHERENTE', 'PLANCHA DE VAPOR OSTER SUEL CON ANTIADHERENTE', 'resized/Mundial020_200x200.jpg', 'Mundial020.jpg', 0, 1),
(15, 'Mundial028', 'Quesadilla Maker, para 6 rebanadas.', 'Quesadilla Maker, para 6 rebanadas, almacenaje vertical, parrillas antiadherentes faciles de limpiar, luz de encendido y precalentado, recetario incluido', 'resized/Mundial028_200x200.jpg', 'Mundial028.jpg', 0, 1),
(16, 'Mundial029', 'Sandwichera Proctor Silex 2 panes.', 'Sandwichera Proctor Silex 2 panes, luz indicadora de  precalentado y encendido.', 'resized/Mundial029_200x200.jpg', 'Mundial029.jpg', 0, 1),
(17, 'Mundial030', 'Olla de lenta cocciÃ³n 4 litros HB', 'Olla de lenta cocciÃ³n 4 litros HB', 'resized/Mundial030_200x200.jpg', 'Mundial030.jpg', 0, 1),
(18, 'Mundial032', 'Tostador Proctor Silex de 4 panes', 'Tostador Proctor Silex de 4 panes paredes frÃ­as al tacto, selector de nivel de tostado.', 'resized/Mundial032_200x200.jpg', 'Mundial032.jpg', 0, 1),
(19, 'Mundial033', 'Batidora de inmersiÃ²n Hamilton Beach, 2 velocidades.', 'Batidora de inmersiÃ²n Hamilton Beach, 2 velocidades, incluye tazÃ²n procesador de alimentos, batidor de globo y mezclador, 225 watts.', 'resized/Mundial033_200x200.jpg', 'Mundial033.jpg', 0, 1),
(20, 'Mundial037', 'Cafetera blanca Proctor Silex de 12 tazas.', 'Cafetera blanca Proctor Silex de 12 tazas, pausa automatica al servir.', 'resized/Mundial037_200x200.jpg', 'Mundial037.jpg', 0, 1),
(21, 'Mundial040', 'Batidora Hamilton Beach de Pedestal y manual, 6 velocidades', 'Batidora Hamilton Beach de Pedestal y manual, 6 velocidades, 275 watts, tazÃ³n de vidrio de 4 litros.', 'resized/Mundial040_200x200.jpg', 'Mundial040.jpg', 0, 1),
(22, 'Mundial043', 'SARTÃN 12 CM TENDENCIAS', 'Antiadherente DuraflonÂ® TecnologÃ­a Antiadherente de Alto Rendimiento, para uso constante, Aluminio 100%, el mejor conductor del calor, Medidas: 12 cm, Mango de baquelita remachado aislante al calor', 'resized/Mundial043_200x200.jpg', 'Mundial043.jpg', 0, 1),
(23, 'Mundial044', 'SARTÃN OVALADO 30 CM', 'Antiadherente DuraflonÂ® TecnologÃ­a Antiadherente de Alto Rendimiento, para uso constante, Aluminio 100%, el mejor conductor del calor, Medidas: 30 cm.  Mango de baquelita aislante al calor', 'resized/Mundial044_200x200.jpg', 'Mundial044.jpg', 0, 1),
(24, 'Mundial045', 'PLANCHA C/SARTÃN 18 CM', 'Plancha: Medidas: 28 cm Espesor: 2.1 mm SartÃ©n: Medidas: 18 cm Espesor: 1.0 mm', 'resized/Mundial045_200x200.jpg', 'Mundial045.jpg', 0, 1),
(25, 'Mundial046', 'BATERÃA  SAZÃN 6 PZAS', 'Antiadherente DuraflonÂ® TecnologÃ­a Antiadherente de Alto Rendimiento, para uso constante Aluminio 100%, el mejor conductor del calor', 'resized/Mundial046_200x200.jpg', 'Mundial046.jpg', 0, 1),
(26, 'Mundial047', 'JUEGO DE 5 UTENSILIOS', 'Juego de 5 Utensilios Nylon Negro', 'resized/Mundial047_200x200.jpg', 'Mundial047.jpg', 0, 1),
(27, 'Mundial048', 'VAPORERA 22 CM', '100% Aluminio el mejor conductor del calor. Conserva el valor nutritivo de los alimentos. FÃ¡cil de limpiar. Incluye una parrilla.Capacidad 5,8L', 'resized/Mundial048_200x200.jpg', 'Mundial048.jpg', 0, 1),
(28, 'Mundial066', 'GORRA RAINBOW', 'Gorra de Poliester', 'resized/Mundial066_200x200.jpg', 'Mundial066.jpg', 0, 1),
(29, 'Mundial068', 'MOCHILA CAMBRIDGE', 'Mochila Poliestes 30x43x14 cm', 'resized/Mundial068_200x200.jpg', 'Mundial068.jpg', 0, 1),
(30, 'Mundial069', 'HIELERA DE 1 SIX VINYL', 'HIELERA DE 1 SIX VINYL Naylon medida 21x16x16cm', 'resized/Mundial069_200x200.jpg', 'Mundial069.jpg', 0, 1),
(31, 'Mundial070', 'MALETA LAOS', 'Maleta Travel PoliÃ©ster medidas 61x29x31cm', 'resized/Mundial070_200x200.jpg', 'Mundial070.jpg', 0, 1),
(32, 'Mundial075', 'TV LCD 32" LG', 'Contraste DinÃ¡mico70,000:1HDSiResoluciÃ³n1280 x 720 pixeles', 'resized/Mundial075_200x200.jpg', 'Mundial075.jpg', 0, 1),
(33, 'Mundial078', 'TV 50" PLASMA LG', 'PANTALLA PLASMA TV HD 50 PULGADAS CON MARCO TRUSLIM', 'resized/Mundial078_200x200.jpg', 'Mundial078.jpg', 0, 1),
(34, 'Mundial079', 'HOME TEATHER SAMSUNGÂ  HTE-330KÂ  5.1 DVD,USB,HDMI', 'DVD Home Theater con Karaoke Potencia total de 330 W', 'resized/Mundial079_200x200.jpg', 'Mundial079.jpg', 0, 1),
(35, 'Mundial083', 'Reproductor Dvd Ultra Delgado Sr 115bc', 'DVD+RW/R/RDL, CD-RW/R, MP3, JPG, AVANZADO SISTEMA DE PROTECCIÃN CONTRA EL POLVO', 'resized/Mundial083_200x200.jpg', 'Mundial083.jpg', 0, 1),
(36, 'Mundial084', 'MALETA MING', 'Maleta con Bolsa de red lateral.', 'resized/Mundial084_200x200.jpg', 'Mundial084.jpg', 0, 1),
(37, 'Mundial086', 'BOCINA HUB DEIRA', 'Hub para 3 puertos version 2.0, carga ipod, incluye cable auxiliar y cable usb.', 'resized/Mundial086_200x200.jpg', 'Mundial086.jpg', 0, 1),
(38, 'Mundial087', 'MALETA SPORT', 'MALETA SPORT Incluye bolsa frontal', 'resized/Mundial087_200x200.jpg', 'Mundial087.jpg', 0, 1),
(39, 'Mundial089', 'Maleta Energy', 'Bolsa Principal, 2 bolsas frontales y 2 laterales', 'resized/Mundial089_200x200.jpg', 'Mundial089.jpg', 0, 1),
(40, 'Mundial090', 'Maleta Luxor', 'Maleta con cuatro compartimientos interiores,con funda para laptop', 'resized/Mundial090_200x200.jpg', 'Mundial090.jpg', 0, 1),
(41, 'Mundial097', 'BÃSCULA DIGITALÂ ', 'BÃSCULA DIGITALÂ COLOR GRIS', 'resized/Mundial097_200x200.jpg', 'Mundial097.jpg', 0, 1),
(42, 'Mundial098', 'Juego de DominÃ³', 'JUEGO DE DOMINO ESTUCHE PLATA Y FICHAS BLANCAS', 'resized/Mundial098_200x200.jpg', 'Mundial098.jpg', 0, 1),
(43, 'Mundial099', 'MALETIN DE POKER', 'MALETIN DE POKER', 'resized/Mundial099_200x200.jpg', 'Mundial099.jpg', 0, 1),
(44, 'Mundial100', 'AlcancÃ­a', 'ALCANCIA FORMA DE PUERQUITO AZULÂ ', 'resized/Mundial100_200x200.jpg', 'Mundial100.jpg', 0, 1),
(45, 'Mundial101', 'SET DE HERRAMIENTASÂ ', 'Contiene: flexÃ³metro de 2 metros, desarmador plano y de cruz, martillo, verificador de corriente y pinzas. Incluye estuche.', 'resized/Mundial101_200x200.jpg', 'Mundial101.jpg', 0, 1),
(46, 'Mundial102', 'Martillo Multiusos', 'martillo, pinzas, navaja, tijeras, desarmador, cierra y lima. Incluye estuche.', 'resized/Mundial102_200x200.jpg', 'Mundial102.jpg', 0, 1),
(47, 'Mundial103', 'Set de Herramientas ST', 'Incluye flexÃ³metro, desarmador, 3 llaves allen, 10 puntas para desarmador. Incluye estuche.', 'resized/Mundial103_200x200.jpg', 'Mundial103.jpg', 0, 1),
(48, 'Mundial104', 'Cilindro Crayon', 'ncluye taza en la tapa.', 'resized/Mundial104_200x200.jpg', 'Mundial104.jpg', 0, 1),
(49, 'Mundial105', 'Cilindro de PlÃ¡stico', 'Cilindro de Plastico', 'resized/Cilindro_de_Pl_s_5195891e619e9_200x200.jpg', 'Cilindro_de_Pl_s_5195891e6680a.jpg', 0, 1),
(50, 'Mundial106', 'Cilindro translucido', 'Cilindro de plÃ¡stico translucido de 750ml', 'resized/Mundial106_200x200.jpg', 'Mundial106.jpg', 0, 1),
(51, 'Mundial107', 'TARRO REDONDO', 'TARRO REDONDO ACERO-INOX 355ML FROST-AZU', 'resized/Mundial107_200x200.jpg', 'Mundial107.jpg', 0, 1),
(52, 'Mundial108', 'TERMO ACERO-INOX', 'TERMO ACERO-INOX 1/2LT BALA SATIN-AZU', 'resized/Mundial108_200x200.jpg', 'Mundial108.jpg', 0, 1),
(53, 'Mundial109', 'REPRODUCTOR DE MP3', 'Incluye estuche, cable usb, audifonos y software de instalacion.Pantalla Digital.', 'resized/Mundial109_200x200.jpg', 'Mundial109.jpg', 0, 1),
(54, 'Mundial110', 'BOCINA MP3', 'Bocina para MP3 y MP4 No incluye baterias (3 pilas AAA).', 'resized/Mundial110_200x200.jpg', 'Mundial110.jpg', 0, 1),
(55, 'Mundial111', 'Tablet Samsung', 'Tablet Galaxy tab.2 7 android 4.0 memoria 8GB titanum silver wifi', 'resized/Mundial111_200x200.jpg', 'Mundial111.jpg', 0, 1),
(56, 'Mundial112', 'IPAD 4GEN WI-FI 16GB', 'IPAD 4GEN WI-FI 16GB', 'resized/Mundial112_200x200.jpg', 'Mundial112.jpg', 0, 1),
(57, 'Mundial113', 'IPAD 4GEN WI-FI 32GB', 'IPAD 4GEN WI-FI 32GB', 'resized/Mundial113_200x200.jpg', 'Mundial113.jpg', 0, 1),
(58, 'Mundial114', 'XBOX  + KINECT', 'XBOX SLIM 4GB + KINECT', 'resized/Mundial114_200x200.jpg', 'Mundial114.jpg', 0, 1),
(59, 'Mundial115', 'PS VITA SONY', 'Tu PS Vita es compatible con mÃ¡s de 250 tÃ­tulos digitales del PSPÂ®. Ve a la PlayStationÂ®Store en tu PS Vita y accede a la librerÃ­a de juegos mÃ¡s grande para el PS Vita y PSPÂ® disponibles para descarga instantÃ¡nea. CaracterÃ­sticas: CÃ¡mara delantera y trasera. Sensor de movimiento. Panel tÃ¡ctil trasero. Juego de plataforma cruzada (PS3)', 'resized/Mundial115_200x200.jpg', 'Mundial115.jpg', 0, 1),
(60, 'Mundial118', 'Reloj Runner azul', 'Reloj unisex con movimientos con tecnologÃ­a de precisiÃ³n Japonesa, color azul correas de caucho de silicona con resistencia al agua hasta por 1atm', 'resized/Reloj_Runner_azu_519fa5a758093_200x200.jpg', 'Reloj_Runner_azu_519fa5a75c6f1.jpg', 0, 1),
(61, 'Mundial119', 'Reloj Dial', 'Reloj de caballeroÂ  con tecnologÃ­a de precisiÃ³n japonesa,Â  cabezal de 39mm correas metÃ¡licas 30m de resistencia al agua', 'resized/Reloj_Dial_519fa4743f661_200x200.jpg', 'Reloj_Dial_519fa474430ff.jpg', 0, 1),
(62, 'Mundial120', 'Reloj  Fun', 'Reloj de caballeroÂ  con tecnologÃ­a de precisiÃ³n japonesa, correas de plÃ¡stico, 30m resistente al agua', 'resized/Reloj__Fun_519fa4d6c2a4b_200x200.jpg', 'Reloj__Fun_519fa4d6ced9e.jpg', 0, 1),
(63, 'Mundial122', 'Reloj  Geo1', 'Reloj de caballero . Con Caja metal plateado <br /> .Banda pielÂ  negro liso <br /> .Mecanismo JaponÃ©s anÃ¡logo', 'resized/Reloj__Geo1_519fa52e54e0c_200x200.jpg', 'Reloj__Geo1_519fa52e5b397.jpg', 0, 1),
(64, 'Mundial123', 'Reloj Geo2', 'Reloj deÂ  Dama . Con Caja metal plateado <br /> .Banda pielÂ  negro liso <br /> .Mecanismo JaponÃ©s anÃ¡logo', 'resized/Reloj_Geo2_519fa5f99fa71_200x200.jpg', 'Reloj_Geo2_519fa5f9a63f2.jpg', 0, 1),
(65, 'Mundial124', 'Reloj PLT', 'Reloj de Caballero', 'resized/Reloj_PLT_519fa6425e420_200x200.jpg', 'Reloj_PLT_519fa642645c9.jpg', 0, 1),
(66, 'Mundial125', 'Reloj Venti1', 'Reloj de Caballero Venti con correas de plastico y carÃ¡tula metÃ¡lica', 'resized/Reloj_Venti1_519fa6bbadd50_200x200.jpg', 'Reloj_Venti1_519fa6bbb5e3a.jpg', 0, 1),
(67, 'Mundial126', 'Reloj Venti2', 'Reloj deDama Venti con correas de plastico y carÃ¡tula metÃ¡lica', 'resized/Reloj_Venti2_519fa7721e424_200x200.jpg', 'Reloj_Venti2_519fa77225d39.jpg', 0, 1),
(68, 'Mundial127', 'Reloj Bons', 'Reloj de Caballero Bons con correas deÂ  tela y carÃ¡tula metÃ¡lica', 'resized/Reloj_Bons_519fa7ac7ac5d_200x200.jpg', 'Reloj_Bons_519fa7ac819cc.jpg', 0, 1),
(69, 'Mundial128', 'Monedero de Wal-Mart por $500 pesos', 'Monedero de Wal-Mart por $500 pesos', 'resized/Monedero_de_Wal__519fa7f1172f8_200x200.jpg', 'Monedero_de_Wal__519fa7f1226b5.jpg', 0, 1),
(70, 'Mundial129', 'Monedero de Liverpool por $500 pesos', 'Monedero de Liverpool por $500 pesos', 'resized/Monedero_de_Live_519fa90cedeb1_200x200.jpg', 'Monedero_de_Live_519fa90d02cf8.jpg', 0, 1),
(71, 'Mundial130', 'Monedero de Wal-Mart por $1,000 pesos', 'Monedero de Wal-Mart por $1,000 pesos', 'resized/Monedero_de_Wal__519fa9515327d_200x200.jpg', 'Monedero_de_Wal__519fa95164fb9.jpg', 0, 1),
(72, 'Mundial131', 'Monedero de Liverpool por $1,000 pesos', 'Monedero de Liverpool por $1,000 pesos', 'resized/Monedero_de_Live_519fa995ddda4_200x200.jpg', 'Monedero_de_Live_519fa995e81b3.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_id`, `product_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 4, 5),
(6, 4, 6),
(7, 4, 7),
(8, 4, 8),
(9, 4, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13),
(14, 3, 14),
(15, 2, 15),
(16, 2, 16),
(17, 2, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21),
(22, 3, 22),
(23, 3, 23),
(24, 3, 24),
(25, 3, 25),
(26, 3, 26),
(27, 3, 27),
(28, 4, 28),
(29, 4, 29),
(30, 4, 30),
(31, 4, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35),
(36, 4, 36),
(37, 1, 37),
(38, 4, 38),
(39, 4, 39),
(40, 4, 40),
(41, 4, 41),
(42, 1, 42),
(43, 1, 43),
(44, 6, 44),
(45, 5, 45),
(46, 5, 46),
(47, 5, 47),
(48, 6, 48),
(49, 6, 49),
(50, 6, 50),
(51, 6, 51),
(52, 6, 52),
(53, 1, 53),
(54, 1, 54),
(55, 1, 55),
(56, 1, 56),
(57, 1, 57),
(58, 1, 58),
(59, 1, 59),
(60, 4, 60),
(61, 4, 61),
(62, 4, 62),
(63, 4, 63),
(64, 4, 64),
(65, 4, 65),
(66, 4, 66),
(67, 4, 67),
(68, 4, 68),
(69, 3, 69),
(70, 3, 70),
(71, 3, 71),
(72, 3, 72);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE IF NOT EXISTS `product_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `currency` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `price`, `currency`, `last_update`) VALUES
(1, 1, 5186.00000, 'Puntos', 0),
(2, 2, 1983.00000, 'Puntos', 0),
(3, 3, 2641.00000, 'Puntos', 0),
(4, 4, 1049.00000, 'Puntos', 0),
(5, 5, 974.00000, 'Puntos', 0),
(6, 6, 1483.00000, 'Puntos', 0),
(7, 7, 794.00000, 'Puntos', 0),
(8, 8, 1360.00000, 'Puntos', 0),
(9, 9, 1132.00000, 'Puntos', 0),
(10, 10, 1231.00000, 'Puntos', 0),
(11, 11, 2654.00000, 'Puntos', 0),
(12, 12, 5749.00000, 'Puntos', 0),
(13, 13, 1623.00000, 'Puntos', 0),
(14, 14, 700.00000, 'Puntos', 0),
(15, 15, 1018.00000, 'Puntos', 0),
(16, 16, 1334.00000, 'Puntos', 0),
(17, 17, 1158.00000, 'Puntos', 0),
(18, 18, 1018.00000, 'Puntos', 0),
(19, 19, 1097.00000, 'Puntos', 0),
(20, 20, 746.00000, 'Puntos', 0),
(21, 21, 1543.00000, 'Puntos', 0),
(22, 22, 254.00000, 'Puntos', 0),
(23, 23, 579.00000, 'Puntos', 0),
(24, 24, 921.00000, 'Puntos', 0),
(25, 25, 1009.00000, 'Puntos', 0),
(26, 26, 298.00000, 'Puntos', 0),
(27, 27, 605.00000, 'Puntos', 0),
(28, 28, 128.00000, 'Puntos', 0),
(29, 29, 605.00000, 'Puntos', 0),
(30, 30, 153.00000, 'Puntos', 0),
(31, 31, 2663.00000, 'Puntos', 0),
(32, 32, 15883.00000, 'Puntos', 0),
(33, 33, 30916.00000, 'Puntos', 0),
(34, 34, 7085.00000, 'Puntos', 0),
(35, 35, 1711.00000, 'Puntos', 0),
(36, 36, 382.00000, 'Puntos', 0),
(37, 37, 1502.00000, 'Puntos', 0),
(38, 38, 382.00000, 'Puntos', 0),
(39, 39, 501.00000, 'Puntos', 0),
(40, 40, 3004.00000, 'Puntos', 0),
(41, 41, 992.00000, 'Puntos', 0),
(42, 42, 476.00000, 'Puntos', 0),
(43, 43, 1354.00000, 'Puntos', 0),
(44, 44, 74.00000, 'Puntos', 0),
(45, 45, 625.00000, 'Puntos', 0),
(46, 46, 377.00000, 'Puntos', 0),
(47, 47, 496.00000, 'Puntos', 0),
(48, 48, 99.00000, 'Puntos', 0),
(49, 49, 179.00000, 'Puntos', 0),
(50, 50, 248.00000, 'Puntos', 0),
(51, 51, 298.00000, 'Puntos', 0),
(52, 52, 347.00000, 'Puntos', 0),
(53, 53, 1537.00000, 'Puntos', 0),
(54, 54, 287.00000, 'Puntos', 0),
(55, 55, 20181.00000, 'Puntos', 0),
(56, 56, 26051.00000, 'Puntos', 0),
(57, 57, 31190.00000, 'Puntos', 0),
(58, 58, 17711.00000, 'Puntos', 0),
(59, 59, 16652.00000, 'Puntos', 0),
(60, 60, 1470.00000, 'Puntos', 0),
(61, 61, 2213.00000, 'Puntos', 0),
(62, 62, 1145.00000, 'Puntos', 0),
(63, 63, 823.00000, 'Puntos', 0),
(64, 64, 823.00000, 'Puntos', 0),
(65, 65, 1211.00000, 'Puntos', 0),
(66, 66, 966.00000, 'Puntos', 0),
(67, 67, 966.00000, 'Puntos', 0),
(68, 68, 966.00000, 'Puntos', 0),
(69, 69, 1925.00000, 'Puntos', 0),
(70, 70, 1925.00000, 'Puntos', 0),
(71, 71, 3850.00000, 'Puntos', 0),
(72, 72, 3850.00000, 'Puntos', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `resource` varchar(125) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `id_parent`, `id_type`, `nombre`, `resource`, `descripcion`) VALUES
(1, 0, 1, 'application_index', 'Application\\Controller\\Index/index', ''),
(2, 1, 2, 'application_comoparticipar', 'Application\\Controller\\Index/comoparticipar', ''),
(3, 1, 2, 'application_mispuntos', 'Application\\Controller\\Index/mispuntos', ''),
(4, 1, 2, 'application_catalogo', 'Application\\Controller\\Index/catalogo', ''),
(5, 1, 2, 'application_canjeartupremio', 'Application\\Controller\\Index/canjeartupremio', ''),
(6, 1, 2, 'application_laselecciongepp', 'Application\\Controller\\Index/laselecciongepp', ''),
(7, 1, 2, 'application_tablaposicion', 'Application\\Controller\\Index/tablaposicion', ''),
(8, 1, 2, 'application_incentivos', 'Application\\Controller\\Index/incentivos', ''),
(9, 1, 2, 'application_reconocimientos', 'Application\\Controller\\Index/reconocimientos', ''),
(10, 1, 2, 'application_categoria', 'Application\\Controller\\Index/categoria', ''),
(11, 1, 2, 'application_producto', 'Application\\Controller\\Index/producto', ''),
(12, 1, 2, 'application_carrito', 'Application\\Controller\\Index/carrito', ''),
(13, 1, 2, 'application_checkout', 'Application\\Controller\\Index/checkout', ''),
(14, 0, 1, 'cscategorycmf_index', 'Cscategorycmf\\Controller\\Index/index', 'Categoy'),
(15, 0, 1, 'cscurrencypoints_index', 'Cscurrencypoints\\Controller\\Index/index', 'Cscurrencypoints'),
(18, 0, 1, 'csproductcmf_index', 'Csproductcmf\\Controller\\Index/index', 'csproductcmf'),
(21, 18, 2, 'csproductcmf_controller_index_producto', 'Csproductcmf\\Controller\\Index/producto', 'csproductcmf_controller_index_producto'),
(22, 0, 1, 'cscart_controller_index_carrito', 'Cscart\\Controller\\Index/carrito', 'cscart_controller_index_carrito'),
(23, 0, 1, 'cscheckout_controller_index_checkout', 'Cscheckout\\Controller\\Index/checkout', 'cscheckout_controller_index_checkout'),
(24, 0, 1, 'asignacion_controller_index_index', 'Asignacion\\Controller\\Index/index', 'asignacion_controller_index_index'),
(25, 24, 2, 'asignacion_controller_index_desasignaruta', 'Asignacion\\Controller\\Index/desasignaruta', 'asignacion_controller_index_desasignaruta'),
(26, 24, 2, 'asignacion_controller_index_asignaruta', 'Asignacion\\Controller\\Index/asignaruta', 'asignacion_controller_index_asignaruta'),
(27, 24, 2, 'asignacion_controller_index_buscaempleado', 'Asignacion\\Controller\\Index/buscaempleado', 'asignacion_controller_index_buscaempleado'),
(28, 24, 2, 'asignacion_controller_index_empleadoasi', 'Asignacion\\Controller\\Index/empleadoasi', 'asignacion_controller_index_empleadoasi'),
(29, 1, 2, 'application_controller_index_privacidad', 'Application\\Controller\\Index/privacidad', 'application_controller_index_privacidad'),
(33, 1, 2, 'application_controller_index_miperfil', 'Application\\Controller\\Index/miperfil', 'application_controller_index_miperfil'),
(34, 1, 2, 'application_controller_index_miperfil', 'Application\\Controller\\Index/miperfil', 'application_controller_index_miperfil'),
(35, 1, 2, 'EstadoCuenta_Controller_Index_pedidos', 'EstadoCuenta\\Controller\\Index/pedidos', 'EstadoCuenta_Controller_Index_pedidos'),
(36, 1, 2, 'EstadoCuenta_Controller_Index_tickets', 'EstadoCuenta\\Controller\\Index/tickets', 'EstadoCuenta_Controller_Index_tickets'),
(37, 1, 2, 'Application_Controller_Index_mecanica', 'Application\\Controller\\Index/mecanica', 'Application_Controller_Index_mecanica'),
(38, 1, 2, 'Application_Controller_Index_promociones', 'Application\\Controller\\Index/promociones', 'Application_Controller_Index_promociones'),
(39, 1, 2, 'Application_Controller_Index_apps', 'Application\\Controller\\Index/apps', 'Application_Controller_Index_apps'),
(40, 1, 2, 'Application_Controller_Index_ayuda', 'Application\\Controller\\Index/ayuda', 'Application_Controller_Index_ayuda'),
(41, 1, 2, 'EstadoCuenta¡_Controller_Index_micuenta ', 'EstadoCuenta\\Controller\\Index/micuenta ', 'EstadoCuenta¡_Controller_Index_micuenta '),
(42, 0, 1, 'cshelperzfcuser_miperfil', 'cshelperzfcuser/miperfil', 'cshelperzfcuser_miperfil'),
(43, 0, 1, 'cshelperzfcuser_getpoblaciones', 'cshelperzfcuser/getpoblaciones', 'cshelperzfcuser_getpoblaciones');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(40) NOT NULL,
  `id_parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `id_parent`) VALUES
(1, 'administrator', 0),
(2, 'public', 0),
(3, 'registered', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `gid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `display_name`, `password`, `state`, `gid`) VALUES
(1, 'admin', 'desarrolladorpc@logolinemail.com.mx', 'Eduardo', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
