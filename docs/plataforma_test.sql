-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2023 a las 13:19:21
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma_test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimento`
--

CREATE TABLE `alimento` (
  `id` int(11) NOT NULL,
  `portada` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `precio` varchar(20) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `oferta` tinyint(1) NOT NULL,
  `portada_oferta` varchar(150) DEFAULT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alimento`
--

INSERT INTO `alimento` (`id`, `portada`, `titulo`, `descripcion`, `precio`, `categoria`, `oferta`, `portada_oferta`, `estado`) VALUES
(1000001, '5ec41dee388c0.png', 'California Burger', 'Turkey / Alfalfa / Lettuce / Chicken Beef / Tomatoes', '11.00', 'Hamburguesas', 1, '', 'Disponible'),
(1000002, '5ec44fe0abbb0.png', 'Mexican Burger', 'All-natural chicken / Tomatoes / Arugula / Baguette', '9.50', 'Hamburguesas', 0, '', 'Disponible'),
(1000003, '5ec44ffb53fe9.png', 'Mini Burger', 'Smoked turkey breast / Bacon / Lettuce / Toast', '6.00', 'Hamburguesas', 0, '', 'Disponible'),
(1000004, '5ec45b26ece68.png', 'Chicken Burger', 'Roasted red peppers / Arugula / Basil / Baguette', '9.00', 'Hamburguesas', 0, '', 'Disponible'),
(1000005, '5ec45b5c51572.png', 'Double Burger', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '2.00', 'Hamburguesas', 0, '', 'Disponible'),
(1000006, '5ec53c578d572.png', 'Pizza Pepperoni', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '9.00', 'Pizzas', 0, '', 'Disponible'),
(1000007, '5ec53c7341728.png', 'Pizza Carbonara', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '11.00', 'Pizzas', 0, '', 'Disponible'),
(1000008, '5ec53c8658e90.png', 'Pizza Siciliana', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '10', 'Pizzas', 0, '', 'Disponible'),
(1000009, '5ec53ca642592.png', 'Pizza 4 Queso', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '7.50', 'Pizzas', 1, '', 'Disponible'),
(1000011, '5ec53d1bb745f.png', 'Chicken Caprese', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '9.00', 'Ensaladas', 1, '', 'Disponible'),
(1000012, '5ec53d2f0f35e.png', 'Ensalada Griega', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '9.00', 'Ensaladas', 1, '5ecbf695f3ab6.jpeg', 'Disponible'),
(1000013, '5ec53d47c7acf.png', 'Ensalada Turca', 'Cheddar cheese / Lettuce / Roast beef / Sesame bread', '8.00', 'Ensaladas', 1, '', 'Disponible'),
(1000017, '61f2d79fe9d44.png', 'Coca Cola', '33 cl', '1.50', 'Bebidas', 0, NULL, 'Disponible'),
(1000019, '61f2db6e26129.png', 'Tosta Ibérica', 'Tosta de aceite, tomate y jamón serrano.', '5', 'Tostadas', 0, NULL, 'Disponible'),
(1000020, '61f2dbc8dc4c6.png', 'Tosta Caprese', 'Tosta de tomate, queso y albahaca.', '5', 'Tostadas', 0, NULL, 'Disponible'),
(1000021, '61f2dc011586e.png', 'Coca Cola Zero', '33 cl', '1.50', 'Bebidas', 0, NULL, 'Disponible'),
(1000022, '61f2dc35db38a.png', 'Fanta Naranja', '33 cl', '1.50', 'Bebidas', 0, NULL, 'Disponible'),
(1000023, '61f2f102a2202.png', 'Tarta de Zanahoria', 'Tarta de queso', '5.50', 'Postres', 0, NULL, 'Disponible'),
(1000024, '61f8fff1cea0d.png', 'Helado', 'Riquísimo helado.', '4.50', 'Postres', 0, NULL, 'Disponible'),
(1000032, '6478856e1de40.jpeg', 'Producto Prueba', 'Un test', '5', 'Hamburguesas', 0, NULL, 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimento_combinado`
--

CREATE TABLE `alimento_combinado` (
  `alimento_id` bigint(20) UNSIGNED NOT NULL,
  `combinado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alimento_combinado`
--

INSERT INTO `alimento_combinado` (`alimento_id`, `combinado_id`, `created_at`, `updated_at`) VALUES
(1000027, 6, NULL, NULL),
(1000028, 1, NULL, NULL),
(1000028, 6, NULL, NULL),
(1000029, 19, NULL, NULL),
(1000030, 20, NULL, NULL),
(1000032, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `idalimento` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `createAt` datetime NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `comentario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `idalimento`, `iduser`, `producto`, `createAt`, `estado`, `cantidad`, `precio`, `comentario`) VALUES
(155, 1000032, 16, 'Producto Prueba', '2023-06-09 00:00:00', 'En el carrito', 1, '5.00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_subproductos`
--

CREATE TABLE `carrito_subproductos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registro_id` bigint(20) UNSIGNED NOT NULL,
  `subproducto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrito_subproductos`
--

INSERT INTO `carrito_subproductos` (`id`, `registro_id`, `subproducto_id`, `created_at`, `updated_at`) VALUES
(60, 155, 27, '2023-06-09 08:59:02', '2023-06-09 08:59:02'),
(61, 155, 46, '2023-06-09 08:59:02', '2023-06-09 08:59:02'),
(62, 155, 44, '2023-06-09 08:59:02', '2023-06-09 08:59:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combinado`
--

CREATE TABLE `combinado` (
  `id` int(11) NOT NULL,
  `nombrecombi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `combinado`
--

INSERT INTO `combinado` (`id`, `nombrecombi`) VALUES
(1, 'Ingredientes Pizza'),
(20, 'testcombinado'),
(31, 'Combinado Prueba'),
(39, 'Combinado 5'),
(40, 'Combinado TPV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combinado_subproducto`
--

CREATE TABLE `combinado_subproducto` (
  `combinado_id` bigint(20) UNSIGNED NOT NULL,
  `subproducto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `combinado_subproducto`
--

INSERT INTO `combinado_subproducto` (`combinado_id`, `subproducto_id`, `created_at`, `updated_at`) VALUES
(5, 6, NULL, NULL),
(6, 7, NULL, NULL),
(6, 8, NULL, NULL),
(7, 10, NULL, NULL),
(8, 11, NULL, NULL),
(8, 1, NULL, NULL),
(8, 5, NULL, NULL),
(9, 12, NULL, NULL),
(9, 1, NULL, NULL),
(9, 9, NULL, NULL),
(10, 13, NULL, NULL),
(10, 1, NULL, NULL),
(10, 9, NULL, NULL),
(6, 14, NULL, NULL),
(6, 13, NULL, NULL),
(14, 17, NULL, NULL),
(16, 18, NULL, NULL),
(16, 5, NULL, NULL),
(17, 19, NULL, NULL),
(17, 16, NULL, NULL),
(19, 22, NULL, NULL),
(19, 23, NULL, NULL),
(19, 20, NULL, NULL),
(19, 21, NULL, NULL),
(19, 24, NULL, NULL),
(20, 27, NULL, NULL),
(20, 26, NULL, NULL),
(31, 41, NULL, NULL),
(20, 25, NULL, NULL),
(31, 39, NULL, NULL),
(39, 27, NULL, NULL),
(39, 41, NULL, NULL),
(39, 44, NULL, NULL),
(39, 45, NULL, NULL),
(40, 27, NULL, NULL),
(40, 46, NULL, NULL),
(40, 44, NULL, NULL),
(40, 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_general`
--

CREATE TABLE `config_general` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `cr` varchar(150) NOT NULL,
  `ubicacion` longtext NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono1` varchar(30) NOT NULL,
  `telefono2` varchar(30) NOT NULL,
  `facebook` varchar(300) NOT NULL,
  `twitter` varchar(300) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `horarios` varchar(300) NOT NULL,
  `iframe` longtext NOT NULL,
  `categorias_menu` longtext NOT NULL,
  `color_texto_menu` varchar(20) NOT NULL,
  `color_fondo_menu` varchar(10) NOT NULL,
  `facebook_iframe` longtext NOT NULL,
  `stripe_public` varchar(50) NOT NULL,
  `stripe_private` varchar(50) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `config_general`
--

INSERT INTO `config_general` (`id`, `nombre_empresa`, `logo`, `cr`, `ubicacion`, `correo`, `telefono1`, `telefono2`, `facebook`, `twitter`, `instagram`, `horarios`, `iframe`, `categorias_menu`, `color_texto_menu`, `color_fondo_menu`, `facebook_iframe`, `stripe_public`, `stripe_private`, `counter`) VALUES
(1, 'Tu Ristorante', '61f16a6bdf25d.png', 'Efipos Delivery  © 2021 Privacy Policy', 'Algeciras (Cádiz)', 'info@efiposdelivery.com', '(+34) 634-808235', '(+34) 722-391313', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', '9:30am-8:30pm', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51559.36245493664!2d-5.492873877024269!3d36.13100775336723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0c9496ba5d5751%3A0xa626ca859cd81ce9!2sAlgeciras%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1637771647831!5m2!1ses!2ses\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'Pizzas, Hamburguesas, Bebidas, Tostadas, Ensaladas', '#ffd966', '#cc0000', '<iframe src=\"https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fenespanol&tabs=timeline&width=340&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=775587709299584\" width=\"340\" height=\"350\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allow=\"encrypted-media\"></iframe>', 'pk_test_9204944525b58275', 'sk_test_bce400facb406e4b', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `createAt` date NOT NULL,
  `telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `iso` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`iso`, `created_at`, `updated_at`) VALUES
('eur', '2022-01-20 16:47:07', '2022-01-20 16:47:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(150) NOT NULL,
  `respuesta` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `faq`
--

INSERT INTO `faq` (`id`, `pregunta`, `respuesta`) VALUES
(1, 'Can I track my order?', 'Yes, you can! After placing your order you will receive an order confirmation via email. Each order starts production 24 hours after your order is placed. Within 72 hours of you placing your order, you will receive an expected delivery date. When the order ships, you will receive another email with the tracking number and a link to trace the order online with the carrier.'),
(2, 'How can I change something in my order?', 'If you need to change something in your order, please contact us immediately. We usually process orders within 2-4 hours, and once we have processed your order, we will be unable to make any changes.'),
(3, 'How can I pay for my order?', 'We accept Visa, MasterCard, and American Express credit and debit cards for your convenience.'),
(4, 'Can I return an item?', 'Please contact our administrators for more information.'),
(5, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
(6, 'How long will my order take to be delivered? e', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
(7, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `resena` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `foto`, `titulo`, `resena`) VALUES
(1, '5eca91a71d780.jpeg', 'Salads', 'We offer a vast variety of salads, both classic and modern, including world favorites.'),
(2, '5eca94497ac3d.jpeg', 'Snacks', 'Looking for a tasty snack? Fast Food menu has something to offer!'),
(6, '5eca9741a97ed.jpeg', 'Sandwiches', 'Our sandwiches are perfect if you want to have a quick bite at affordable price.'),
(7, '5eca976d92a83.jpeg', 'Mini Hamburgers', 'Finish the design for blog listings and articles, including mixed meda'),
(8, '5eca979010907.jpeg', 'Pizzas', 'Various types of our pizza always taste awesome, even if ordered online.'),
(9, '5eca97afb3bed.jpeg', 'Desserts', 'From tiramisu to cheesecakes, in Fast Food menu you will find a lot of tasty desserts.'),
(11, '61fac9011ede5.jpeg', 'Prueba', 'Esto es una prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL,
  `titulo_cabecera` varchar(50) NOT NULL,
  `titulo_principal` varchar(100) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `titulo_producto` varchar(50) NOT NULL,
  `foot_img_uno` varchar(250) NOT NULL,
  `foot_img_dos` varchar(250) NOT NULL,
  `foot_img_tres` varchar(250) NOT NULL,
  `foot_img_cuatro` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id`, `titulo_cabecera`, `titulo_principal`, `precio`, `titulo_producto`, `foot_img_uno`, `foot_img_dos`, `foot_img_tres`, `foot_img_cuatro`) VALUES
(1, 'Miercoles', 'PIZZA DAY', '6.00€', 'Todas nuestras pizzas', '5ec15aa3e95d3.jpeg', '5ec15aa3ea063.jpeg', '5ec15aa3ea7e3.jpeg', '5ec15aa3ead45.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `direccion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_comida`
--

CREATE TABLE `menu_comida` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `preview` varchar(250) DEFAULT NULL,
  `enlace` varchar(300) DEFAULT NULL,
  `fondo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu_comida`
--

INSERT INTO `menu_comida` (`id`, `titulo`, `preview`, `enlace`, `fondo`) VALUES
(2, 'Pizzas', '5ec6ee1e0059d.png', 'https://backoffice.efiposdelivery.com/menu/pizzas', '5ec6ee1e00c91.jpeg'),
(3, 'Hamburguesas', '5ec83835e4b86.png', 'https://backoffice.efiposdelivery.com/menu/hamburguesas', '5ec83835e59b8.jpeg'),
(4, 'Bebidas', '5ec8386490d96.png', 'https://backoffice.efiposdelivery.com/menu/bebidas', '5ec8386491268.jpeg'),
(5, 'Tostadas', '5ec8387616a89.png', 'https://backoffice.efiposdelivery.com/menu/tostadas', '5ec8387616fa8.jpeg'),
(6, 'Ensaladas', '5ec83894e13fe.png', 'https://backoffice.efiposdelivery.com/menu/ensaladas', '5ec83894e191e.jpeg'),
(7, 'Postres', '5ec83a56f0a9c.png', 'https://backoffice.efiposdelivery.com/menu/postres', '5ec83a56f1122.jpeg'),
(9, 'Patatas', '61f96035bc17e.png', 'https://backoffice.efiposdelivery.com/menu/patatas', '61f96035c1a60.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_single`
--

CREATE TABLE `menu_single` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `titulo_comida` varchar(250) NOT NULL,
  `precio` varchar(20) NOT NULL,
  `ingredientes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2022_01_20_164951_create_type_orders_table', 2),
(7, '2022_01_20_165820_create_currencies_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `navegacion`
--

CREATE TABLE `navegacion` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `enlace` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `navegacion`
--

INSERT INTO `navegacion` (`id`, `titulo`, `icono`, `enlace`) VALUES
(1, 'PARA PEDIR', 'thin-icon-house', 'http://www.tiendaefipos.es/public/ordenar-online'),
(3, 'CONTACTO', 'thin-icon-phone-support', 'http://www.tiendaefipos.es/public/contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `portada` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `subtitulo` varchar(300) NOT NULL,
  `precio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `fecha` varchar(250) NOT NULL,
  `direccion` longtext NOT NULL,
  `total_pagado` decimal(7,2) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `year` varchar(5) NOT NULL,
  `tiempo_estimado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `id` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `producto` varchar(250) NOT NULL,
  `precio` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id`, `idpedido`, `producto`, `precio`) VALUES
(18, 10, 'Classic Cheddar', '15.90'),
(19, 10, 'Pepperoni', '15.90'),
(20, 11, 'Sicilian', '15.90'),
(21, 11, 'Hawaiian', '15.90'),
(22, 11, 'Pepperoni', '15.90'),
(23, 12, 'Classic Cheddar', '15.90'),
(24, 12, 'Classic Cheddar', '15.90'),
(25, 12, 'Sicilian', '15.90'),
(26, 12, 'Tarta de Queso', '5.00'),
(27, 13, 'Classic Cheddar', '15.90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_tres`
--

CREATE TABLE `seccion_tres` (
  `id` int(11) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` longtext NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seccion_tres`
--

INSERT INTO `seccion_tres` (`id`, `icono`, `titulo`, `descripcion`, `estado`) VALUES
(1, 'thin-icon-time', 'ENTREGA RÁPIDA', 'En 30 minutos tienes tu pedido calentito y en casa.', 1),
(2, 'thin-icon-book', 'CARTA AMPLIA', 'Para todos los gustos y sabores. Consulta nuestros alérgenos.', 1),
(3, 'thin-icon-love', 'HECHO CON AMOR', 'Como lo hacía tu abuela en casa, riquísimo.', 1),
(4, 'thin-icon-lightbulb', 'PARA TÍ', '¿Alguna sugerencia? Pregunta a nuestros chefs.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_uno`
--

CREATE TABLE `seccion_uno` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `subtitulo` varchar(50) NOT NULL,
  `portada` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seccion_uno`
--

INSERT INTO `seccion_uno` (`id`, `titulo`, `subtitulo`, `portada`, `estado`) VALUES
(1, 'Ingredientes Frescos', 'en todos nuestros productos', '61f26543b805e.png', 1),
(2, 'Pedidos Online', 'Disponible de 9 AM - 11 PM', '61f2662e69761.png', 1),
(3, 'Prueba Nuestros PopSweet', 'Todos los viernes solo 1€', '61f265dc3b6c1.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `portada` varchar(150) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `subtitulo` varchar(150) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `portada`, `titulo`, `subtitulo`, `estado`) VALUES
(1, '5ecdbe18892d1.jpeg', 'AHORA DOBLE', 'LA TREMENDA', 'CON QUESO'),
(2, '61f3bd831767c.jpeg', 'DESDE MÉXICO', 'LA CAPITAL', 'MUY PICANTE'),
(3, '5ecdbfa781232.jpeg', 'NUEVA PIZZA', 'LA CAPITÁN NEMO', 'RECIÉN SACADA DEL MAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subproductos`
--

CREATE TABLE `subproductos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `estado` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `subproductos`
--

INSERT INTO `subproductos` (`id`, `nombre`, `precio`, `estado`, `img_path`) VALUES
(25, 'Test', 1, 'Disponible', '6477378696db3.png'),
(26, 'Test2', 1, 'Disponible', '6477379bd7669.png'),
(27, 'Ketchup', 1, 'Disponible', ''),
(39, 'Pimiento', 0.3, 'Disponible', ''),
(40, 'Aguacate', 0.4, 'Disponible', ''),
(41, 'Mostaza', 0.2, 'Disponible', ''),
(44, 'Queso', 0.5, 'Disponible', ''),
(45, 'Tomate', 0.4, 'Disponible', ''),
(46, 'Mayonesa', 0.5, 'Disponible', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_orders`
--

CREATE TABLE `type_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `type_orders`
--

INSERT INTO `type_orders` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Stripe', 'img/type-orders/repartidor.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57'),
(2, 'Recogida', 'img/type-orders/restaurante.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `direccion` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `telefono` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `perfil` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `direccion`, `telefono`, `perfil`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'Administrador', 'efiposdelivery@gmail.com', '2021-11-22 17:34:24', '$2y$10$6GgstlV/9FTzFrcwJ.Vc6OuQas91DLPvIWGhVrKgiOfbzvqLCQOv6', 'ADMIN', 'Calle Fuente Nueva, 41 4ºD', '627495344', 'perfil.png', NULL, NULL, NULL),
(12, 'Juan', 'Juan.sastre@gmail.com', NULL, '$2y$10$X1YR9ViV15/EQ76g43VQa.y/DAQG41fktBN/exrIBtTD.dSiwXsga', 'USER', 'Avd. Andalucia, 2 4ºC', '677673740', 'perfil.png', NULL, NULL, NULL),
(16, 'Ismael Ríos González', 'ismaelrios@gmail.com', NULL, '$2y$10$9FmMMe6gTsW8kS3dF9dxFuxnvd2U1bDPpHTXY4bCz5hvceKYZyquy', 'ADMIN', 'C/ Paco de Lucía Nº12', '601 11 11 11', 'perfil.png', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimento`
--
ALTER TABLE `alimento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito_subproductos`
--
ALTER TABLE `carrito_subproductos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `combinado`
--
ALTER TABLE `combinado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config_general`
--
ALTER TABLE `config_general`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_comida`
--
ALTER TABLE `menu_comida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_single`
--
ALTER TABLE `menu_single`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `navegacion`
--
ALTER TABLE `navegacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_tres`
--
ALTER TABLE `seccion_tres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_uno`
--
ALTER TABLE `seccion_uno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subproductos`
--
ALTER TABLE `subproductos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_orders`
--
ALTER TABLE `type_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimento`
--
ALTER TABLE `alimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000033;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `carrito_subproductos`
--
ALTER TABLE `carrito_subproductos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `combinado`
--
ALTER TABLE `combinado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu_comida`
--
ALTER TABLE `menu_comida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `navegacion`
--
ALTER TABLE `navegacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `seccion_tres`
--
ALTER TABLE `seccion_tres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion_uno`
--
ALTER TABLE `seccion_uno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subproductos`
--
ALTER TABLE `subproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `type_orders`
--
ALTER TABLE `type_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
