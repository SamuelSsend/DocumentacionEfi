-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.41 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.5.0.6702
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura para tabla plataforma_test.alimento
CREATE TABLE IF NOT EXISTS `alimento` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `portada` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `descripcion` varchar(300) NOT NULL,
    `precio` varchar(20) NOT NULL,
    `categoria` varchar(50) NOT NULL,
    `oferta` tinyint(1) NOT NULL,
    `portada_oferta` varchar(150) DEFAULT NULL,
    `estado` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1663741698 DEFAULT CHARSET=utf8mb4;


-- Volcando estructura para tabla plataforma_test.alimento_combinado
CREATE TABLE IF NOT EXISTS `alimento_combinado` (
    `alimento_id` bigint(20) unsigned NOT NULL,
    `combinado_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.alimento_combinado: ~6 rows (aproximadamente)
INSERT INTO `alimento_combinado` (`alimento_id`, `combinado_id`, `created_at`, `updated_at`) VALUES
                                                                                                 (1000027, 6, NULL, NULL),
                                                                                                 (1000028, 1, NULL, NULL),
                                                                                                 (1000028, 6, NULL, NULL),
                                                                                                 (1000029, 19, NULL, NULL),
                                                                                                 (1000030, 20, NULL, NULL),
                                                                                                 (1000032, 40, NULL, NULL);

-- Volcando estructura para tabla plataforma_test.carrito
CREATE TABLE IF NOT EXISTS `carrito` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idalimento` int(11) NOT NULL,
    `iduser` int(11) NOT NULL,
    `producto` varchar(250) NOT NULL,
    `createAt` datetime NOT NULL,
    `estado` varchar(50) NOT NULL,
    `cantidad` int(11) NOT NULL,
    `precio` decimal(7,2) NOT NULL,
    `comentario` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.carrito: ~2 rows (aproximadamente)
INSERT INTO `carrito` (`id`, `idalimento`, `iduser`, `producto`, `createAt`, `estado`, `cantidad`, `precio`, `comentario`) VALUES
                                                                                                                               (155, 1000032, 16, 'Producto Prueba', '2023-06-09 00:00:00', 'En el carrito', 1, 5.00, NULL),
                                                                                                                               (161, 1000032, 10, 'Algo nuevo', '2023-10-06 00:00:00', 'En el carrito', 1, 5.00, NULL);

-- Volcando estructura para tabla plataforma_test.carrito_subproductos
CREATE TABLE IF NOT EXISTS `carrito_subproductos` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `registro_id` bigint(20) unsigned NOT NULL,
    `subproducto_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.carrito_subproductos: ~5 rows (aproximadamente)
INSERT INTO `carrito_subproductos` (`id`, `registro_id`, `subproducto_id`, `created_at`, `updated_at`) VALUES
                                                                                                           (60, 155, 27, '2023-06-09 08:59:02', '2023-06-09 08:59:02'),
                                                                                                           (61, 155, 46, '2023-06-09 08:59:02', '2023-06-09 08:59:02'),
                                                                                                           (62, 155, 44, '2023-06-09 08:59:02', '2023-06-09 08:59:02'),
                                                                                                           (64, 161, 27, '2023-10-06 09:49:13', '2023-10-06 09:49:13'),
                                                                                                           (65, 161, 46, '2023-10-06 09:49:13', '2023-10-06 09:49:13');

-- Volcando estructura para tabla plataforma_test.combinado
CREATE TABLE IF NOT EXISTS `combinado` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombrecombi` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla plataforma_test.combinado: ~5 rows (aproximadamente)
INSERT INTO `combinado` (`id`, `nombrecombi`) VALUES
                                                  (1, 'Ingredientes Pizza'),
                                                  (20, 'testcombinado'),
                                                  (31, 'Combinado Prueba'),
                                                  (39, 'Combinado 5'),
                                                  (40, 'Combinado TPV');

-- Volcando estructura para tabla plataforma_test.combinado_subproducto
CREATE TABLE IF NOT EXISTS `combinado_subproducto` (
    `combinado_id` bigint(20) unsigned NOT NULL,
    `subproducto_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.combinado_subproducto: ~38 rows (aproximadamente)
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

-- Volcando estructura para tabla plataforma_test.config_general
CREATE TABLE IF NOT EXISTS `config_general` (
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
    `counter` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.config_general: ~1 rows (aproximadamente)
INSERT INTO `config_general` (`id`, `nombre_empresa`, `logo`, `cr`, `ubicacion`, `correo`, `telefono1`, `telefono2`, `facebook`, `twitter`, `instagram`, `horarios`, `iframe`, `categorias_menu`, `color_texto_menu`, `color_fondo_menu`, `facebook_iframe`, `stripe_public`, `stripe_private`, `counter`) VALUES
    (1, 'Tu Ristorante', '61f16a6bdf25d.png', 'Efipos Delivery  © 2021 Privacy Policy', 'Algeciras (Cádiz)', 'info@efiposdelivery.com', '(+34) 634-808235', '(+34) 722-391313', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', '9:30am-8:30pm', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51559.36245493664!2d-5.492873877024269!3d36.13100775336723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0c9496ba5d5751%3A0xa626ca859cd81ce9!2sAlgeciras%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1637771647831!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', 'Pizzas, Hamburguesas, Bebidas, Tostadas, Ensaladas', '#ffd966', '#cc0000', '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fenespanol&tabs=timeline&width=340&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=775587709299584" width="340" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>', 'pk_test_9204944525b58275', 'sk_test_bce400facb406e4b', 0);

-- Volcando estructura para tabla plataforma_test.contacto
CREATE TABLE IF NOT EXISTS `contacto` (
    `id` int(11) NOT NULL,
    `nombres` varchar(50) NOT NULL,
    `apellidos` varchar(50) NOT NULL,
    `mensaje` varchar(500) NOT NULL,
    `correo` varchar(50) NOT NULL,
    `createAt` date NOT NULL,
    `telefono` int(9) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.contacto: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
    `iso` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.currencies: ~0 rows (aproximadamente)
INSERT INTO `currencies` (`iso`, `created_at`, `updated_at`) VALUES
    ('eur', '2022-01-20 16:47:07', '2022-01-20 16:47:07');

-- Volcando estructura para tabla plataforma_test.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` bigint(20) unsigned NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.faq
CREATE TABLE IF NOT EXISTS `faq` (
    `id` int(11) NOT NULL,
    `pregunta` varchar(150) NOT NULL,
    `respuesta` longtext NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.faq: ~7 rows (aproximadamente)
INSERT INTO `faq` (`id`, `pregunta`, `respuesta`) VALUES
                                                      (1, 'Can I track my order?', 'Yes, you can! After placing your order you will receive an order confirmation via email. Each order starts production 24 hours after your order is placed. Within 72 hours of you placing your order, you will receive an expected delivery date. When the order ships, you will receive another email with the tracking number and a link to trace the order online with the carrier.'),
                                                      (2, 'How can I change something in my order?', 'If you need to change something in your order, please contact us immediately. We usually process orders within 2-4 hours, and once we have processed your order, we will be unable to make any changes.'),
                                                      (3, 'How can I pay for my order?', 'We accept Visa, MasterCard, and American Express credit and debit cards for your convenience.'),
                                                      (4, 'Can I return an item?', 'Please contact our administrators for more information.'),
                                                      (5, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
                                                      (6, 'How long will my order take to be delivered? e', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
                                                      (7, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.');

-- Volcando estructura para tabla plataforma_test.galeria
CREATE TABLE IF NOT EXISTS `galeria` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `foto` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `resena` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.galeria: ~7 rows (aproximadamente)
INSERT INTO `galeria` (`id`, `foto`, `titulo`, `resena`) VALUES
                                                             (1, '5eca91a71d780.jpeg', 'Salads', 'We offer a vast variety of salads, both classic and modern, including world favorites.'),
                                                             (2, '5eca94497ac3d.jpeg', 'Snacks', 'Looking for a tasty snack? Fast Food menu has something to offer!'),
                                                             (6, '5eca9741a97ed.jpeg', 'Sandwiches', 'Our sandwiches are perfect if you want to have a quick bite at affordable price.'),
                                                             (7, '5eca976d92a83.jpeg', 'Mini Hamburgers', 'Finish the design for blog listings and articles, including mixed meda'),
                                                             (8, '5eca979010907.jpeg', 'Pizzas', 'Various types of our pizza always taste awesome, even if ordered online.'),
                                                             (9, '5eca97afb3bed.jpeg', 'Desserts', 'From tiramisu to cheesecakes, in Fast Food menu you will find a lot of tasty desserts.'),
                                                             (11, '61fac9011ede5.jpeg', 'Prueba', 'Esto es una prueba');

-- Volcando estructura para tabla plataforma_test.inicio
CREATE TABLE IF NOT EXISTS `inicio` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo_cabecera` varchar(50) NOT NULL,
    `titulo_principal` varchar(100) NOT NULL,
    `precio` varchar(10) NOT NULL,
    `titulo_producto` varchar(50) NOT NULL,
    `foot_img_uno` varchar(250) NOT NULL,
    `foot_img_dos` varchar(250) NOT NULL,
    `foot_img_tres` varchar(250) NOT NULL,
    `foot_img_cuatro` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.inicio: ~0 rows (aproximadamente)
INSERT INTO `inicio` (`id`, `titulo_cabecera`, `titulo_principal`, `precio`, `titulo_producto`, `foot_img_uno`, `foot_img_dos`, `foot_img_tres`, `foot_img_cuatro`) VALUES
    (1, 'Miercoles', 'PIZZA DAY', '6.00€', 'Todas nuestras pizzas', '5ec15aa3e95d3.jpeg', '5ec15aa3ea063.jpeg', '5ec15aa3ea7e3.jpeg', '5ec15aa3ead45.jpeg');

-- Volcando estructura para tabla plataforma_test.locales
CREATE TABLE IF NOT EXISTS `locales` (
    `id` int(11) NOT NULL,
    `nombre` varchar(150) NOT NULL,
    `ciudad` varchar(50) NOT NULL,
    `direccion` varchar(500) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.locales: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.menu_comida
CREATE TABLE IF NOT EXISTS `menu_comida` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(50) NOT NULL,
    `preview` varchar(250) DEFAULT NULL,
    `enlace` varchar(300) DEFAULT NULL,
    `fondo` varchar(250) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.menu_comida: ~9 rows (aproximadamente)
INSERT INTO `menu_comida` (`id`, `titulo`, `preview`, `enlace`, `fondo`) VALUES
                                                                             (1, 'BEBIDAS', NULL, NULL, NULL),
                                                                             (2, 'PIZZA', '5ec6ee1e0059d.png', 'https://backoffice.efiposdelivery.com/menu/pizzas', '5ec6ee1e00c91.jpeg'),
                                                                             (3, 'HAMBURGUESA', '5ec83835e4b86.png', 'https://backoffice.efiposdelivery.com/menu/hamburguesas', '5ec83835e59b8.jpeg'),
                                                                             (4, 'POSTRES', '5ec8386490d96.png', 'https://backoffice.efiposdelivery.com/menu/bebidas', '5ec8386491268.jpeg'),
                                                                             (5, 'TOSTAS', '5ec8387616a89.png', 'https://backoffice.efiposdelivery.com/menu/tostadas', '5ec8387616fa8.jpeg'),
                                                                             (6, 'ENSALADAS', '5ec83894e13fe.png', 'https://backoffice.efiposdelivery.com/menu/ensaladas', '5ec83894e191e.jpeg'),
                                                                             (7, 'INGREDIENTES PIZZA', '5ec83a56f0a9c.png', 'https://backoffice.efiposdelivery.com/menu/postres', '5ec83a56f1122.jpeg'),
                                                                             (8, 'INGREDIENTES HAMBURG', NULL, NULL, NULL),
                                                                             (9, 'FHFG', '61f96035bc17e.png', 'https://backoffice.efiposdelivery.com/menu/patatas', '61f96035c1a60.jpeg'),
                                                                             (10, 'COMBINADO TPV', NULL, NULL, NULL),
                                                                             (11, 'INGREDIENTES HAMBURG', NULL, NULL, NULL);

-- Volcando estructura para tabla plataforma_test.menu_single
CREATE TABLE IF NOT EXISTS `menu_single` (
    `id` int(11) NOT NULL,
    `tipo` varchar(50) NOT NULL,
    `titulo_comida` varchar(250) NOT NULL,
    `precio` varchar(20) NOT NULL,
    `ingredientes` longtext NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.menu_single: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.migrations: ~2 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
    (3, '2023_10_31_073916_add_categoria_id_to_alimento_table', 1);

-- Volcando estructura para tabla plataforma_test.navegacion
CREATE TABLE IF NOT EXISTS `navegacion` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(150) NOT NULL,
    `icono` varchar(50) NOT NULL,
    `enlace` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.navegacion: ~2 rows (aproximadamente)
INSERT INTO `navegacion` (`id`, `titulo`, `icono`, `enlace`) VALUES
                                                                 (1, 'PARA PEDIR', 'thin-icon-house', 'http://www.tiendaefipos.es/public/ordenar-online'),
                                                                 (3, 'CONTACTO', 'thin-icon-phone-support', 'http://www.tiendaefipos.es/public/contacto');

-- Volcando estructura para tabla plataforma_test.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `portada` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `subtitulo` varchar(300) NOT NULL,
    `precio` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.ofertas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `iduser` int(11) NOT NULL,
    `fecha` varchar(250) NOT NULL,
    `direccion` longtext NOT NULL,
    `total_pagado` decimal(7,2) NOT NULL,
    `estado` varchar(50) NOT NULL,
    `mes` varchar(20) NOT NULL,
    `year` varchar(5) NOT NULL,
    `tiempo_estimado` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.pedidos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla plataforma_test.pedido_detalle
CREATE TABLE IF NOT EXISTS `pedido_detalle` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idpedido` int(11) NOT NULL,
    `producto` varchar(250) NOT NULL,
    `precio` decimal(7,2) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.pedido_detalle: ~10 rows (aproximadamente)
INSERT INTO `pedido_detalle` (`id`, `idpedido`, `producto`, `precio`) VALUES
                                                                          (18, 10, 'Classic Cheddar', 15.90),
                                                                          (19, 10, 'Pepperoni', 15.90),
                                                                          (20, 11, 'Sicilian', 15.90),
                                                                          (21, 11, 'Hawaiian', 15.90),
                                                                          (22, 11, 'Pepperoni', 15.90),
                                                                          (23, 12, 'Classic Cheddar', 15.90),
                                                                          (24, 12, 'Classic Cheddar', 15.90),
                                                                          (25, 12, 'Sicilian', 15.90),
                                                                          (26, 12, 'Tarta de Queso', 5.00),
                                                                          (27, 13, 'Classic Cheddar', 15.90);

-- Volcando estructura para tabla plataforma_test.seccion_tres
CREATE TABLE IF NOT EXISTS `seccion_tres` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `icono` varchar(50) NOT NULL,
    `titulo` varchar(50) NOT NULL,
    `descripcion` longtext NOT NULL,
    `estado` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.seccion_tres: ~4 rows (aproximadamente)
INSERT INTO `seccion_tres` (`id`, `icono`, `titulo`, `descripcion`, `estado`) VALUES
                                                                                  (1, 'thin-icon-time', 'ENTREGA RÁPIDA', 'En 30 minutos tienes tu pedido calentito y en casa.', 1),
                                                                                  (2, 'thin-icon-book', 'CARTA AMPLIA', 'Para todos los gustos y sabores. Consulta nuestros alérgenos.', 1),
                                                                                  (3, 'thin-icon-love', 'HECHO CON AMOR', 'Como lo hacía tu abuela en casa, riquísimo.', 1),
                                                                                  (4, 'thin-icon-lightbulb', 'PARA TÍ', '¿Alguna sugerencia? Pregunta a nuestros chefs.', 1);

-- Volcando estructura para tabla plataforma_test.seccion_uno
CREATE TABLE IF NOT EXISTS `seccion_uno` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(50) NOT NULL,
    `subtitulo` varchar(50) NOT NULL,
    `portada` varchar(250) NOT NULL,
    `estado` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.seccion_uno: ~3 rows (aproximadamente)
INSERT INTO `seccion_uno` (`id`, `titulo`, `subtitulo`, `portada`, `estado`) VALUES
                                                                                 (1, 'Ingredientes Frescos', 'en todos nuestros productos', '61f26543b805e.png', 1),
                                                                                 (2, 'Pedidos Online', 'Disponible de 9 AM - 11 PM', '61f2662e69761.png', 1),
                                                                                 (3, 'Prueba Nuestros PopSweet', 'Todos los viernes solo 1€', '61f265dc3b6c1.png', 1);

-- Volcando estructura para tabla plataforma_test.slider
CREATE TABLE IF NOT EXISTS `slider` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `portada` varchar(150) NOT NULL,
    `titulo` varchar(150) NOT NULL,
    `subtitulo` varchar(150) NOT NULL,
    `estado` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla plataforma_test.slider: ~3 rows (aproximadamente)
INSERT INTO `slider` (`id`, `portada`, `titulo`, `subtitulo`, `estado`) VALUES
                                                                            (1, '5ecdbe18892d1.jpeg', 'AHORA DOBLE', 'LA TREMENDA', 'CON QUESO'),
                                                                            (2, '61f3bd831767c.jpeg', 'DESDE MÉXICO', 'LA CAPITAL', 'MUY PICANTE'),
                                                                            (3, '5ecdbfa781232.jpeg', 'NUEVA PIZZA', 'LA CAPITÁN NEMO', 'RECIÉN SACADA DEL MAR');

-- Volcando estructura para tabla plataforma_test.subproductos
CREATE TABLE IF NOT EXISTS `subproductos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
    `precio` float NOT NULL,
    `estado` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
    `img_path` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla plataforma_test.subproductos: ~0 rows (aproximadamente)
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

-- Volcando estructura para tabla plataforma_test.type_orders
CREATE TABLE IF NOT EXISTS `type_orders` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.type_orders: ~0 rows (aproximadamente)
INSERT INTO `type_orders` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
                                                                                  (1, 'Stripe', 'img/type-orders/repartidor.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57'),
                                                                                  (2, 'Recogida', 'img/type-orders/restaurante.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57');

-- Volcando estructura para tabla plataforma_test.users
CREATE TABLE IF NOT EXISTS `users` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `direccion` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
    `telefono` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
    `perfil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
    ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla plataforma_test.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `direccion`, `telefono`, `perfil`, `remember_token`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                          (10, 'Administrador', 'efiposdelivery@gmail.com', '2021-11-22 17:34:24', '$2y$10$6GgstlV/9FTzFrcwJ.Vc6OuQas91DLPvIWGhVrKgiOfbzvqLCQOv6', 'ADMIN', 'Calle Fuente Nueva, 41 4ºD', '627495344', 'perfil.png', NULL, NULL, NULL),
                                                                                                                                                                          (12, 'Juan', 'Juan.sastre@gmail.com', NULL, '$2y$10$X1YR9ViV15/EQ76g43VQa.y/DAQG41fktBN/exrIBtTD.dSiwXsga', 'USER', 'Avd. Andalucia, 2 4ºC', '677673740', 'perfil.png', NULL, NULL, NULL),
                                                                                                                                                                          (16, 'Ismael Ríos González', 'ismaelrios@gmail.com', NULL, '$2y$10$9FmMMe6gTsW8kS3dF9dxFuxnvd2U1bDPpHTXY4bCz5hvceKYZyquy', 'ADMIN', 'C/ Paco de Lucía Nº12', '601 11 11 11', 'perfil.png', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
