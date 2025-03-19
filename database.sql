-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versió del servidor:          5.7.41 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versió:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table plataforma_test.alimento
DROP TABLE IF EXISTS `alimento`;
CREATE TABLE IF NOT EXISTS `alimento` (
                                          `id` int(11) NOT NULL AUTO_INCREMENT,
    `activo_hosteltactil` tinyint(1) NOT NULL DEFAULT '1',
    `portada` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `descripcion_manual` varchar(300) NOT NULL,
    `precio` varchar(20) NOT NULL,
    `categoria` varchar(50) NOT NULL,
    `categoria_id` bigint(20) unsigned DEFAULT NULL,
    `oferta` tinyint(1) NOT NULL,
    `portada_oferta` varchar(150) DEFAULT NULL,
    `estado` varchar(50) NOT NULL,
    `descripcion_hosteltactil` text,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.alimento: ~0 rows (approximately)
DELETE FROM `alimento`;

-- Dumping structure for table plataforma_test.alimento_combinado
DROP TABLE IF EXISTS `alimento_combinado`;
CREATE TABLE IF NOT EXISTS `alimento_combinado` (
                                                    `alimento_id` bigint(20) unsigned NOT NULL,
    `combinado_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.alimento_combinado: ~0 rows (approximately)
DELETE FROM `alimento_combinado`;

-- Dumping structure for table plataforma_test.carrito
DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
                                         `id` int(11) NOT NULL AUTO_INCREMENT,
    `idalimento` int(11) NOT NULL,
    `iduser` int(10) unsigned DEFAULT NULL,
    `producto` varchar(250) NOT NULL,
    `createAt` datetime NOT NULL,
    `estado` varchar(50) NOT NULL,
    `cantidad` int(11) NOT NULL,
    `precio` decimal(7,2) NOT NULL,
    `comentario` varchar(200) DEFAULT NULL,
    `uuid` varchar(255) DEFAULT NULL,
    `type_id` int(10) unsigned NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.carrito: ~0 rows (approximately)
DELETE FROM `carrito`;

-- Dumping structure for table plataforma_test.carrito_subproductos
DROP TABLE IF EXISTS `carrito_subproductos`;
CREATE TABLE IF NOT EXISTS `carrito_subproductos` (
                                                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `registro_id` bigint(20) unsigned NOT NULL,
    `subproducto_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.carrito_subproductos: ~0 rows (approximately)
DELETE FROM `carrito_subproductos`;

-- Dumping structure for table plataforma_test.combinado
DROP TABLE IF EXISTS `combinado`;
CREATE TABLE IF NOT EXISTS `combinado` (
                                           `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombrecombi` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table plataforma_test.combinado: ~4 rows (approximately)
DELETE FROM `combinado`;
INSERT INTO `combinado` (`id`, `nombrecombi`) VALUES
                                                  (1, 'COMBI PIZZA'),
                                                  (2, 'PRUEBA'),
                                                  (3, 'INGRED. HAMBURG'),
                                                  (4, 'COMBINADO TPV');

-- Dumping structure for table plataforma_test.combinado_subproducto
DROP TABLE IF EXISTS `combinado_subproducto`;
CREATE TABLE IF NOT EXISTS `combinado_subproducto` (
                                                       `combinado_id` bigint(20) unsigned NOT NULL,
    `subproducto_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.combinado_subproducto: ~14 rows (approximately)
DELETE FROM `combinado_subproducto`;
INSERT INTO `combinado_subproducto` (`combinado_id`, `subproducto_id`, `created_at`, `updated_at`) VALUES
                                                                                                       (1, 1145519361, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (1, 1244506753, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (1, 621830657, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (1, 648428417, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (1, 1663741697, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (4, 27, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (3, 1633641473, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (3, 97394305, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (3, 889128449, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (2, 1145519361, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (2, 1244506753, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (2, 621830657, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (2, 648428417, '2023-11-16 14:30:45', '2023-11-16 14:30:45'),
                                                                                                       (2, 1663741697, '2023-11-16 14:30:45', '2023-11-16 14:30:45');

-- Dumping structure for table plataforma_test.config_general
DROP TABLE IF EXISTS `config_general`;
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
    `hosteltactil_api` varchar(255) DEFAULT NULL,
    `hosteltactil_token` varchar(4000) DEFAULT NULL,
    `hosteltactil_idlocal` varchar(255) DEFAULT NULL,
    `hosteltactil_tarifa` int(10) unsigned NOT NULL DEFAULT '1',
    `carta` varchar(255) DEFAULT NULL,
    `gastos_de_envio_d` int(10) unsigned DEFAULT NULL,
    `gastos_de_envio_id` int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.config_general: ~1 rows (approximately)
DELETE FROM `config_general`;
INSERT INTO `config_general` (`id`, `nombre_empresa`, `logo`, `cr`, `ubicacion`, `correo`, `telefono1`, `telefono2`, `facebook`, `twitter`, `instagram`, `horarios`, `iframe`, `categorias_menu`, `color_texto_menu`, `color_fondo_menu`, `facebook_iframe`, `stripe_public`, `stripe_private`, `counter`, `hosteltactil_api`, `hosteltactil_token`, `hosteltactil_idlocal`, `hosteltactil_tarifa`, `carta`, `gastos_de_envio_d`, `gastos_de_envio_id`) VALUES
    (1, 'Tu Ristorante', '61f16a6bdf25d.png', 'Efipos Delivery  © 2021 Privacy Policy', 'Algeciras (Cádiz)', 'info@efiposdelivery.com', '(+34) 634-808235', '(+34) 722-391313', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', '9:30am-8:30pm', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51559.36245493664!2d-5.492873877024269!3d36.13100775336723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0c9496ba5d5751%3A0xa626ca859cd81ce9!2sAlgeciras%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1637771647831!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', 'Pizzas, Hamburguesas, Bebidas, Tostadas, Ensaladas', '#ffd966', '#cc0000', '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fenespanol&tabs=timeline&width=340&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=775587709299584" width="340" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>', 'pk_test_9204944525b58275', 'sk_test_bce400facb406e4b', 0, 'http://46.183.119.158:20200/api', 'HjtBBUCxd6mNkxApKo3GNXyPdLMFbF35wJ6pt_Q-FDrv2-Ubl2551Sdz_NseNb81q8p97usjLagA63WFaKw4nxxlr2gcBozU119HGvysts0q09XLcI4pjlHUWWFO0yUG3hDfNmaCYfDeridsdZvJGngxKxAAgb20NL-BRaFroZVgcer9sbaj-mt9OkSGYj3WpAV5_3P37ylGNqZuxItgHekb669gvpugxg3cYdTuS0oE_9HDRmd-zOVd-lyBgK3A_ZO7rW-PmDRFqWxhusuFJdbHJNtAyjGUpuPDsA1w-h6_cghOejzfh87M87czU-3sLvqKRUFgAj_3P0H3QElJVFFI-ULkzxG4yiXRA4hgXI2LQbEPR1ishGx_vjfZ3Xm8tFgpBLhUr4nDINdzu8XRUxoEvNCVOUbCaK1IwLb7saPlluQAiJ8ZdzN57qarpw9-0YooeaxgVACinyPYQuuIJvct9mk7DKpJHOvbZMZH1og', '1143', 1, '659ead96ce84b.pdf', NULL, 1647359745);

-- Dumping structure for table plataforma_test.contacto
DROP TABLE IF EXISTS `contacto`;
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

-- Dumping data for table plataforma_test.contacto: ~0 rows (approximately)
DELETE FROM `contacto`;

-- Dumping structure for table plataforma_test.currencies
DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
                                            `iso` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.currencies: ~1 rows (approximately)
DELETE FROM `currencies`;
INSERT INTO `currencies` (`iso`, `created_at`, `updated_at`) VALUES
    ('eur', '2022-01-20 16:47:07', '2022-01-20 16:47:07');

-- Dumping structure for table plataforma_test.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
                                             `id` bigint(20) unsigned NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table plataforma_test.faq
DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
                                     `id` int(11) NOT NULL,
    `pregunta` varchar(150) NOT NULL,
    `respuesta` longtext NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.faq: ~7 rows (approximately)
DELETE FROM `faq`;
INSERT INTO `faq` (`id`, `pregunta`, `respuesta`) VALUES
                                                      (1, 'Can I track my order?', 'Yes, you can! After placing your order you will receive an order confirmation via email. Each order starts production 24 hours after your order is placed. Within 72 hours of you placing your order, you will receive an expected delivery date. When the order ships, you will receive another email with the tracking number and a link to trace the order online with the carrier.'),
                                                      (2, 'How can I change something in my order?', 'If you need to change something in your order, please contact us immediately. We usually process orders within 2-4 hours, and once we have processed your order, we will be unable to make any changes.'),
                                                      (3, 'How can I pay for my order?', 'We accept Visa, MasterCard, and American Express credit and debit cards for your convenience.'),
                                                      (4, 'Can I return an item?', 'Please contact our administrators for more information.'),
                                                      (5, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
                                                      (6, 'How long will my order take to be delivered? e', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.'),
                                                      (7, 'How long will my order take to be delivered?', 'Delivery times will depend on your location. Once payment is confirmed your order will be packaged. Delivery can be expected within 10 business days.');

-- Dumping structure for table plataforma_test.galeria
DROP TABLE IF EXISTS `galeria`;
CREATE TABLE IF NOT EXISTS `galeria` (
                                         `id` int(11) NOT NULL AUTO_INCREMENT,
    `foto` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `resena` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.galeria: ~7 rows (approximately)
DELETE FROM `galeria`;
INSERT INTO `galeria` (`id`, `foto`, `titulo`, `resena`) VALUES
                                                             (1, '5eca91a71d780.jpeg', 'Salads', 'We offer a vast variety of salads, both classic and modern, including world favorites.'),
                                                             (2, '5eca94497ac3d.jpeg', 'Snacks', 'Looking for a tasty snack? Fast Food menu has something to offer!'),
                                                             (6, '5eca9741a97ed.jpeg', 'Sandwiches', 'Our sandwiches are perfect if you want to have a quick bite at affordable price.'),
                                                             (7, '5eca976d92a83.jpeg', 'Mini Hamburgers', 'Finish the design for blog listings and articles, including mixed meda'),
                                                             (8, '5eca979010907.jpeg', 'Pizzas', 'Various types of our pizza always taste awesome, even if ordered online.'),
                                                             (9, '5eca97afb3bed.jpeg', 'Desserts', 'From tiramisu to cheesecakes, in Fast Food menu you will find a lot of tasty desserts.'),
                                                             (11, '61fac9011ede5.jpeg', 'Prueba', 'Esto es una prueba');

-- Dumping structure for table plataforma_test.inicio
DROP TABLE IF EXISTS `inicio`;
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

-- Dumping data for table plataforma_test.inicio: ~1 rows (approximately)
DELETE FROM `inicio`;
INSERT INTO `inicio` (`id`, `titulo_cabecera`, `titulo_principal`, `precio`, `titulo_producto`, `foot_img_uno`, `foot_img_dos`, `foot_img_tres`, `foot_img_cuatro`) VALUES
    (1, 'Miercoles', 'PIZZA DAY', '6.00€', 'Todas nuestras pizzas', '5ec15aa3e95d3.jpeg', '5ec15aa3ea063.jpeg', '5ec15aa3ea7e3.jpeg', '5ec15aa3ead45.jpeg');

-- Dumping structure for table plataforma_test.locales
DROP TABLE IF EXISTS `locales`;
CREATE TABLE IF NOT EXISTS `locales` (
                                         `id` int(11) NOT NULL,
    `nombre` varchar(150) NOT NULL,
    `ciudad` varchar(50) NOT NULL,
    `direccion` varchar(500) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.locales: ~0 rows (approximately)
DELETE FROM `locales`;

-- Dumping structure for table plataforma_test.menu_comida
DROP TABLE IF EXISTS `menu_comida`;
CREATE TABLE IF NOT EXISTS `menu_comida` (
                                             `id` int(11) NOT NULL AUTO_INCREMENT,
    `activo` tinyint(1) NOT NULL DEFAULT '1',
    `titulo` varchar(50) NOT NULL,
    `preview` varchar(250) DEFAULT NULL,
    `enlace` varchar(300) DEFAULT NULL,
    `fondo` varchar(250) DEFAULT NULL,
    `activo_hosteltactil` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.menu_comida: ~13 rows (approximately)
DELETE FROM `menu_comida`;
INSERT INTO `menu_comida` (`id`, `activo`, `titulo`, `preview`, `enlace`, `fondo`, `activo_hosteltactil`) VALUES
                                                                                                              (1, 1, 'BEBIDAS', NULL, NULL, NULL, 1),
                                                                                                              (2, 1, 'PIZZA', '5ec6ee1e0059d.png', 'https://backoffice.efiposdelivery.com/menu/pizzas', '5ec6ee1e00c91.jpeg', 1),
                                                                                                              (3, 1, 'HAMBURGUESA', '5ec83835e4b86.png', 'https://backoffice.efiposdelivery.com/menu/hamburguesas', '5ec83835e59b8.jpeg', 1),
                                                                                                              (4, 1, 'POSTRES', '5ec8386490d96.png', 'https://backoffice.efiposdelivery.com/menu/bebidas', '5ec8386491268.jpeg', 1),
                                                                                                              (5, 1, 'TOSTAS', '5ec8387616a89.png', 'https://backoffice.efiposdelivery.com/menu/tostadas', '5ec8387616fa8.jpeg', 1),
                                                                                                              (6, 1, 'ENSALADAS', '5ec83894e13fe.png', 'https://backoffice.efiposdelivery.com/menu/ensaladas', '5ec83894e191e.jpeg', 1),
                                                                                                              (7, 1, 'INGREDIENTES PIZZA', '5ec83a56f0a9c.png', 'https://backoffice.efiposdelivery.com/menu/postres', '5ec83a56f1122.jpeg', 1),
                                                                                                              (8, 1, 'INGREDIENTES HAMBURGUESAS', NULL, NULL, NULL, 1),
                                                                                                              (9, 1, 'FHFG', '61f96035bc17e.png', 'https://backoffice.efiposdelivery.com/menu/patatas', '61f96035c1a60.jpeg', 0),
                                                                                                              (10, 1, 'SALSAS PIZZA', NULL, NULL, NULL, 1),
                                                                                                              (11, 1, 'SALSAS HAMBURGUESAS', '65856b25a1d05.jpeg', 'http://localhost/menu/ingredientes_hamburg', NULL, 1),
                                                                                                              (12, 1, 'CATEGRÍA DE PRUEBA', NULL, NULL, NULL, 1),
                                                                                                              (13, 0, 'ENVIO', '65b77c3eac147.png', 'http://localhost:8000/menu/envio', NULL, 1);

-- Dumping structure for table plataforma_test.menu_single
DROP TABLE IF EXISTS `menu_single`;
CREATE TABLE IF NOT EXISTS `menu_single` (
                                             `id` int(11) NOT NULL,
    `tipo` varchar(50) NOT NULL,
    `titulo_comida` varchar(250) NOT NULL,
    `precio` varchar(20) NOT NULL,
    `ingredientes` longtext NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.menu_single: ~0 rows (approximately)
DELETE FROM `menu_single`;

-- Dumping structure for table plataforma_test.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.migrations: ~17 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (3, '2023_10_31_073916_add_categoria_id_to_alimento_table', 1),
                                                          (4, '2023_10_30_091159_create_initial_structure', 1),
                                                          (5, '2023_10_31_073916_add_categoria_id_to_alimento_table', 1),
                                                          (6, '2023_11_11_125032_add_hosteltactilconfig_to_config_general_table', 1),
                                                          (7, '2023_11_11_132617_add_description_hosteltactil_to_alimento_table', 1),
                                                          (8, '2023_11_14_073431_add_activo_to_alimento_table', 1),
                                                          (9, '2023_12_14_105139_add_gastos_de_envio_to_config_general_table', 2),
                                                          (10, '2023_12_14_105229_add_telefono_to_pedidos_table', 2),
                                                          (12, '2023_12_18_155925_add_uuid_to_carrito_table', 3),
                                                          (13, '2023_12_20_100757_add_tipo_envio_to_carrito_table', 4),
                                                          (14, '2023_12_21_121148_create_pedidos_index_table', 5),
                                                          (15, '2023_12_22_100611_drop_pedidos_index_table', 6),
                                                          (16, '2023_12_22_111154_add_fields_to_pedidos_table', 7),
                                                          (17, '2023_12_22_111856_add_fields2_to_pedidos_table', 8),
                                                          (18, '2024_01_10_143908_add_carta_to_config_general__table', 9),
                                                          (19, '2024_01_17_110012_change_gastos_de_envio_to_config_table', 10),
                                                          (20, '2024_01_17_110013_change_gastos_de_envio_to_config_table', 11);

-- Dumping structure for table plataforma_test.navegacion
DROP TABLE IF EXISTS `navegacion`;
CREATE TABLE IF NOT EXISTS `navegacion` (
                                            `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(150) NOT NULL,
    `icono` varchar(50) NOT NULL,
    `enlace` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.navegacion: ~2 rows (approximately)
DELETE FROM `navegacion`;
INSERT INTO `navegacion` (`id`, `titulo`, `icono`, `enlace`) VALUES
                                                                 (1, 'PARA PEDIR', 'thin-icon-house', 'http://www.tiendaefipos.es/public/ordenar-online'),
                                                                 (3, 'CONTACTO', 'thin-icon-phone-support', 'http://www.tiendaefipos.es/public/contacto');

-- Dumping structure for table plataforma_test.ofertas
DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE IF NOT EXISTS `ofertas` (
                                         `id` int(11) NOT NULL AUTO_INCREMENT,
    `portada` varchar(250) NOT NULL,
    `titulo` varchar(250) NOT NULL,
    `subtitulo` varchar(300) NOT NULL,
    `precio` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.ofertas: ~0 rows (approximately)
DELETE FROM `ofertas`;

-- Dumping structure for table plataforma_test.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
                                                 `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table plataforma_test.pedidos
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
                                         `id` int(11) NOT NULL AUTO_INCREMENT,
    `iduser` int(10) unsigned DEFAULT NULL,
    `fecha` varchar(250) NOT NULL,
    `direccion` longtext NOT NULL,
    `total_pagado` decimal(7,2) NOT NULL,
    `estado` varchar(50) NOT NULL,
    `mes` varchar(20) NOT NULL,
    `year` varchar(5) NOT NULL,
    `tiempo_estimado` varchar(250) NOT NULL,
    `telefono` varchar(255) DEFAULT NULL,
    `uuid` varchar(255) DEFAULT NULL,
    `name` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.pedidos: ~0 rows (approximately)
DELETE FROM `pedidos`;

-- Dumping structure for table plataforma_test.pedido_detalle
DROP TABLE IF EXISTS `pedido_detalle`;
CREATE TABLE IF NOT EXISTS `pedido_detalle` (
                                                `id` int(11) NOT NULL AUTO_INCREMENT,
    `idpedido` int(11) NOT NULL,
    `producto` varchar(250) NOT NULL,
    `precio` decimal(7,2) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.pedido_detalle: ~0 rows (approximately)
DELETE FROM `pedido_detalle`;

-- Dumping structure for table plataforma_test.seccion_tres
DROP TABLE IF EXISTS `seccion_tres`;
CREATE TABLE IF NOT EXISTS `seccion_tres` (
                                              `id` int(11) NOT NULL AUTO_INCREMENT,
    `icono` varchar(50) NOT NULL,
    `titulo` varchar(50) NOT NULL,
    `descripcion` longtext NOT NULL,
    `estado` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.seccion_tres: ~4 rows (approximately)
DELETE FROM `seccion_tres`;
INSERT INTO `seccion_tres` (`id`, `icono`, `titulo`, `descripcion`, `estado`) VALUES
                                                                                  (1, 'thin-icon-time', 'ENTREGA RÁPIDA', 'En 30 minutos tienes tu pedido calentito y en casa.', 1),
                                                                                  (2, 'thin-icon-book', 'CARTA AMPLIA', 'Para todos los gustos y sabores. Consulta nuestros alérgenos.', 1),
                                                                                  (3, 'thin-icon-love', 'HECHO CON AMOR', 'Como lo hacía tu abuela en casa, riquísimo.', 1),
                                                                                  (4, 'thin-icon-lightbulb', 'PARA TÍ', '¿Alguna sugerencia? Pregunta a nuestros chefs.', 1);

-- Dumping structure for table plataforma_test.seccion_uno
DROP TABLE IF EXISTS `seccion_uno`;
CREATE TABLE IF NOT EXISTS `seccion_uno` (
                                             `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(50) NOT NULL,
    `subtitulo` varchar(50) NOT NULL,
    `portada` varchar(250) NOT NULL,
    `estado` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.seccion_uno: ~3 rows (approximately)
DELETE FROM `seccion_uno`;
INSERT INTO `seccion_uno` (`id`, `titulo`, `subtitulo`, `portada`, `estado`) VALUES
                                                                                 (1, 'Ingredientes Frescos', 'en todos nuestros productos', '61f26543b805e.png', 1),
                                                                                 (2, 'Pedidos Online', 'Disponible de 9 AM - 11 PM', '61f2662e69761.png', 1),
                                                                                 (3, 'Prueba Nuestros PopSweet', 'Todos los viernes solo 1€', '61f265dc3b6c1.png', 1);

-- Dumping structure for table plataforma_test.slider
DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
                                        `id` int(11) NOT NULL AUTO_INCREMENT,
    `portada` varchar(150) NOT NULL,
    `titulo` varchar(150) NOT NULL,
    `subtitulo` varchar(150) NOT NULL,
    `estado` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table plataforma_test.slider: ~3 rows (approximately)
DELETE FROM `slider`;
INSERT INTO `slider` (`id`, `portada`, `titulo`, `subtitulo`, `estado`) VALUES
                                                                            (1, '5ecdbe18892d1.jpeg', 'AHORA DOBLE', 'LA TREMENDA', 'CON QUESO'),
                                                                            (2, '61f3bd831767c.jpeg', 'DESDE MÉXICO', 'LA CAPITAL', 'MUY PICANTE'),
                                                                            (3, '5ecdbfa781232.jpeg', 'NUEVA PIZZA', 'LA CAPITÁN NEMO', 'RECIÉN SACADA DEL MAR');

-- Dumping structure for table plataforma_test.subproductos
DROP TABLE IF EXISTS `subproductos`;
CREATE TABLE IF NOT EXISTS `subproductos` (
                                              `id` int(11) NOT NULL AUTO_INCREMENT,
    `activo_hosteltactil` tinyint(1) NOT NULL DEFAULT '1',
    `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
    `precio` float NOT NULL,
    `estado` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
    `img_path` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1663741699 DEFAULT CHARSET=utf8;

-- Dumping data for table plataforma_test.subproductos: ~18 rows (approximately)
DELETE FROM `subproductos`;
INSERT INTO `subproductos` (`id`, `activo_hosteltactil`, `nombre`, `precio`, `estado`, `img_path`) VALUES
                                                                                                       (25, 0, 'Test', 1, 'Baja', '6477378696db3.png'),
                                                                                                       (26, 0, 'Test2', 1, 'Baja', '6477379bd7669.png'),
                                                                                                       (27, 1, 'TOMATE', 0, 'Disponible', ''),
                                                                                                       (39, 0, 'Pimiento', 0.3, 'Baja', ''),
                                                                                                       (40, 0, 'Aguacate', 0.4, 'Baja', ''),
                                                                                                       (41, 0, 'Mostaza', 0.2, 'Baja', ''),
                                                                                                       (44, 0, 'QUESO', 0, 'Baja', ''),
                                                                                                       (45, 0, 'TOMATE', 0, 'Baja', ''),
                                                                                                       (46, 0, 'MAYONESA', 0, 'Baja', ''),
                                                                                                       (97394305, 1, 'LECHUGA', 0, 'Baja', NULL),
                                                                                                       (621830657, 1, 'CEBOLLA', 0, 'Baja', NULL),
                                                                                                       (648428417, 1, 'JALAPEÑOS', 0, 'Baja', NULL),
                                                                                                       (889128449, 1, 'QUESO', 0, 'Baja', NULL),
                                                                                                       (1145519361, 1, 'ATUN', 0, 'Baja', NULL),
                                                                                                       (1244506753, 1, 'PIMIENTO', 0, 'Baja', NULL),
                                                                                                       (1633641473, 1, 'TOMATE', 0, 'Baja', NULL),
                                                                                                       (1663741697, 1, 'QUESO EXTRA', 0, 'Baja', NULL),
                                                                                                       (1663741698, 0, 'a', 20, 'Baja', '');

-- Dumping structure for table plataforma_test.type_orders
DROP TABLE IF EXISTS `type_orders`;
CREATE TABLE IF NOT EXISTS `type_orders` (
                                             `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.type_orders: ~2 rows (approximately)
DELETE FROM `type_orders`;
INSERT INTO `type_orders` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
                                                                                  (1, 'Stripe', 'img/type-orders/repartidor.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57'),
                                                                                  (2, 'Recogida', 'img/type-orders/restaurante.png', '2022-01-20 16:44:57', '2022-01-20 16:44:57');

-- Dumping structure for table plataforma_test.users
DROP TABLE IF EXISTS `users`;
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
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table plataforma_test.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `direccion`, `telefono`, `perfil`, `remember_token`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                          (10, 'Administrador', 'efiposdelivery@gmail.com', '2021-11-22 17:34:24', '$2y$10$6GgstlV/9FTzFrcwJ.Vc6OuQas91DLPvIWGhVrKgiOfbzvqLCQOv6', 'ADMIN', 'asd', NULL, 'perfil.png', NULL, NULL, NULL),
                                                                                                                                                                          (12, 'Juan', 'Juan.sastre@gmail.com', NULL, '$2y$10$X1YR9ViV15/EQ76g43VQa.y/DAQG41fktBN/exrIBtTD.dSiwXsga', 'USER', 'Avd. Andalucia, 2 4ºC', '677673740', 'perfil.png', NULL, NULL, NULL),
                                                                                                                                                                          (16, 'Ismael Ríos González', 'ismaelrios@gmail.com', NULL, '$2y$10$9FmMMe6gTsW8kS3dF9dxFuxnvd2U1bDPpHTXY4bCz5hvceKYZyquy', 'ADMIN', 'C/ Paco de Lucía Nº12', '601 11 11 11', 'perfil.png', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
