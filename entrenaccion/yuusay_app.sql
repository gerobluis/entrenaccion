-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-02-2014 a las 19:10:13
-- Versión del servidor: 5.5.32-cll-lve
-- Versión de PHP: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yuusay_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bussiness`
--

CREATE TABLE IF NOT EXISTS `bussiness` (
  `id_bussiness` int(11) NOT NULL AUTO_INCREMENT,
  `bussiness_user` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bussiness_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nm_bussiness` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rfc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_scope` int(11) DEFAULT NULL,
  `bussiness_phone` int(11) DEFAULT NULL,
  `location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_average_market` int(11) DEFAULT NULL,
  `tagline` text COLLATE utf8_unicode_ci,
  `logo` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `background` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_bussiness`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `bussiness`
--

INSERT INTO `bussiness` (`id_bussiness`, `bussiness_user`, `bussiness_password`, `nm_bussiness`, `rfc`, `id_scope`, `bussiness_phone`, `location`, `id_average_market`, `tagline`, `logo`, `background`) VALUES
(1, NULL, NULL, 'Sfera', NULL, NULL, NULL, 'Calzada del Valle #100', NULL, NULL, 'http://yuusay.com/app/logo/sfera.jpg', NULL),
(2, NULL, NULL, 'Mr Pulpo', NULL, NULL, NULL, 'Padre Mier #1000', NULL, NULL, 'http://yuusay.com/app/logo/mrpulpo.jpg', NULL),
(3, NULL, NULL, 'Horno 3', NULL, NULL, NULL, 'Parque Fundidora', NULL, NULL, 'http://yuusay.com/app/logo/horno3.jpg', NULL),
(4, NULL, NULL, 'Marco', NULL, NULL, NULL, 'Museo de Arte Contemporaneo', NULL, NULL, 'http://yuusay.com/app/logo/marco.jpg', NULL),
(5, NULL, NULL, 'La Bodeguita Del Medio', NULL, NULL, NULL, 'Ricardo Margain #320', NULL, NULL, 'http://yuusay.com/app/logo/labodeguitadelmedio.jpg', NULL),
(6, NULL, NULL, 'Maverick', NULL, NULL, NULL, 'Centrito Valle', NULL, NULL, 'http://yuusay.com/app/logo/maverick.jpg', NULL),
(7, NULL, NULL, 'Curry Sulan', NULL, NULL, NULL, 'Centrito Valle', NULL, NULL, 'http://yuusay.com/app/logo/currysultan.jpg', NULL),
(8, NULL, NULL, 'Jhon Sushi', NULL, NULL, NULL, 'La Calle del Sushi', NULL, NULL, 'http://yuusay.com/app/logo/sushitogo.png', NULL),
(9, NULL, NULL, 'Pista de Hielo Fundidora', NULL, NULL, NULL, 'Fundidora', NULL, NULL, 'http://yuusay.com/app/logo/pista-de-hielo-fundidora.jpg', NULL),
(10, NULL, NULL, 'Cafe Punta del Cielo', NULL, NULL, NULL, 'Plaza Real', NULL, NULL, 'http://yuusay.com/app/logo/cafepuntadelcielo.jpg', NULL),
(11, NULL, NULL, 'Canvas', NULL, NULL, NULL, 'Rio Caura', NULL, NULL, 'http://yuusay.com/app/logo/canvas.jpg', NULL),
(12, NULL, NULL, 'Smart Nutrition', NULL, NULL, NULL, 'Smart Nutrition Garza la Guera', NULL, NULL, 'http://yuusay.com/app/logo/smartnutrition.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `nm_category` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkout`
--

CREATE TABLE IF NOT EXISTS `checkout` (
  `id_checkout` int(11) NOT NULL AUTO_INCREMENT,
  `id_offer` int(11) DEFAULT NULL,
  `id_experience` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `initial_location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `final_location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `initial_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `final_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fl_shared` int(11) DEFAULT NULL,
  `checkout_yuupoints` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_checkout`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `id_code` int(11) NOT NULL AUTO_INCREMENT,
  `number_code` int(11) DEFAULT NULL,
  `code_uses` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiences`
--

CREATE TABLE IF NOT EXISTS `experiences` (
  `id_experience` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_offer` int(11) DEFAULT NULL,
  `initial_location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `final_location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_what` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_who` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_when` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_where` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id_offer` int(11) NOT NULL AUTO_INCREMENT,
  `nm_offer` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offer_copy` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_offer_type` int(11) DEFAULT NULL,
  `offer_img` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `offer_tags` text COLLATE utf8_unicode_ci,
  `offer_yuupoints` int(11) DEFAULT NULL,
  `invitations` int(11) DEFAULT NULL,
  `id_business` int(11) DEFAULT NULL,
  `offer_promo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_offer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `offers`
--

INSERT INTO `offers` (`id_offer`, `nm_offer`, `offer_copy`, `id_offer_type`, `offer_img`, `id_category`, `offer_tags`, `offer_yuupoints`, `invitations`, `id_business`, `offer_promo`) VALUES
(1, 'Tu conjunto de invierno ya esta listo\r ', 'Porque sabemos lo importante que es para ti verte linda y lucir fantastica visita nuestra tienda Sfera y Sferizate en esta temporada decembrina', NULL, 'http://yuusay.com/app/img/cafepuntadelcielo.jpg', NULL, NULL, 50, 5, 1, '50% de descuento\r\n'),
(2, 'Define modas, rompe tendencias\r\n', 'Hay gente que nacio para seguir, pero sabemos que tu naciste para ser seguido, marca moda y  crea una nueva tendencia con esta promocion exclusiva para ti ', NULL, 'http://yuusay.com/app/img/canvas.jpg', NULL, NULL, 100, 6, 2, '$199.00 por camisa\r\n'),
(3, 'Al rojo vivo\r\n', 'Conoce la historia del acero y como fue evolucionando hasta llegar a lo que es hoy en dia, experimenta el estar dentro de un horno encendido\r ', NULL, 'http://yuusay.com/app/img/currysultan.jpg', NULL, NULL, 200, 1, 3, '$50 pesos por persona\r\n'),
(4, 'Mejor me cuelgo\r\n', 'El arte abstracto es una forma de expresion muy complicada de explicar, te invitamos mejor a que nos digas si esta presentacion te provoca llorar o ganas de colgar tu ropa lavada ', NULL, 'http://yuusay.com/app/img/horno3.jpg', NULL, NULL, 250, 2, 4, '$60 pesos por persona\r\n'),
(5, 'El festival de la salsa\r\n', 'Quien mejor que Cuba para mostrarte el sabor latino como se debe, ven a disfrutar de la increible musica en vivo del son cubano y un delicioso festin ', NULL, 'http://yuusay.com/app/img/labodeguitadeenmedio.jpg', NULL, NULL, 100, 4, 5, '$150 pesos por persona\r\n'),
(6, 'Ayudanos a limpiar\r\n', 'Porque sabemos lo importante que es para ti verte linda y lucir fantastica visita nuestra tienda Sfera y Sferizate en esta temporada decembrina', NULL, 'http://yuusay.com/app/img/marco.jpg', NULL, NULL, 150, 3, 6, '2x1 en todos los consumos de bebidas\r\n'),
(7, 'Mejor que el kamasutra\r\n', ' Sorprende a tu pareja con una comida fantastica que curara hambre y levantara su apetito sexual, somos la segunda opcion despues del viagra.\r ', NULL, 'http://yuusay.com/app/img/maverick.jpg', NULL, NULL, 300, 4, 7, 'Menu para 2 personas por 400 pesos\r '),
(8, 'El desayuno oriental de tu vida\r\n', 'Porque sabemos que despiertas con un increible antojo de sushis envueltos en donas, esta promocion es exclusiva para ti!\r ', NULL, 'http://yuusay.com/app/img/mrpulpo.jpg', NULL, NULL, 100, 4, 8, 'Platillo 110 pesos por persona\r\n'),
(9, 'Frio como el hielo\r\n', 'Esta promocion te dejara helado de la emocion, ven y disfruta con nosotros una experiencia unica e inigualable y aprende a patinar sobre hielo.\r ', NULL, 'http://yuusay.com/app/img/pistadehielo.jpg', NULL, NULL, 500, 5, 9, '$45 pesos por persona\r '),
(10, 'Adictos al cafe\r\n', 'Sabemos porque te muerdes las unas, y no es por estres, es porque no aguantas las ganas de venir y tomarte un cafe con nosotros y disfrutar de su exquisito sabor.\r ', NULL, 'http://yuusay.com/app/img/sfera.jpg', NULL, NULL, 290, 2, 10, '$40 pesos por cafe\r\n'),
(11, 'Te veras como princesa\r ', 'Tu evento importante esta a punto de ocurrir, y queremos que te veas fantastica, ven con nosotros y prometemos hacer de ese bello rostro tuyo un lienzo y hacer una obra de arte.\r ', NULL, 'http://yuusay.com/app/img/smartnutrition.jpg', NULL, NULL, 100, 4, 11, '30% de descuento\r\n'),
(12, 'Vive mas\r\n', 'Cuida tu cuerpo, mente y espiritu con una alimentacion balanceada y deliciosa, acompananos y te prepararemos un plan a la medida para mejorar tu salud y tus habitos alimenticios\r ', NULL, 'http://yuusay.com/app/img/sushitogo.jpg', NULL, NULL, 600, 5, 12, '$250 por consulta \r\n'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offer_type`
--

CREATE TABLE IF NOT EXISTS `offer_type` (
  `id_offer_type` int(11) NOT NULL AUTO_INCREMENT,
  `nm_offer_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_offer_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id_preference` int(11) NOT NULL AUTO_INCREMENT,
  `id_preference_group` int(11) DEFAULT NULL,
  `preference_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_preference`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferences_group`
--

CREATE TABLE IF NOT EXISTS `preferences_group` (
  `id_preference_group` int(11) NOT NULL AUTO_INCREMENT,
  `preference_group_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_preference_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scope`
--

CREATE TABLE IF NOT EXISTS `scope` (
  `id_scope` int(11) NOT NULL AUTO_INCREMENT,
  `nm_scope` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_scope`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_gender` int(11) DEFAULT NULL,
  `id_preferences` int(11) DEFAULT NULL,
  `id_norifications` int(11) DEFAULT NULL,
  `nm_user` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `friends` text COLLATE utf8_unicode_ci,
  `location` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_yuupoints` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_preferences`
--

CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id_user_preference` int(11) NOT NULL AUTO_INCREMENT,
  `id_preferences` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_preference`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
