<?php
/**
 * CULQI PHP SDK
 *
 * Init, cargamos todos los archivos necesarios
 *
 * @version   1.5.2
 * @package   Culqi
 * @copyright Copyright (c) 2015-2017 Culqi
 * @license   MIT
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://developers.culqi.com/ Culqi Developers
 */

// Errors
require_once dirname(__FILE__).'/Culqi/Error/Errors.php';
require_once dirname(__FILE__).'/Culqi/Client.php';
require_once dirname(__FILE__).'/Culqi/Resource.php';

// Culqi API
require_once dirname(__FILE__).'/Culqi/Transfers.php';
require_once dirname(__FILE__).'/Culqi/Cards.php';
require_once dirname(__FILE__).'/Culqi/Events.php';
require_once dirname(__FILE__).'/Culqi/Customers.php';
require_once dirname(__FILE__).'/Culqi/Tokens.php';
require_once dirname(__FILE__).'/Culqi/Charges.php';
require_once dirname(__FILE__).'/Culqi/Refunds.php';
require_once dirname(__FILE__).'/Culqi/Subscriptions.php';
require_once dirname(__FILE__).'/Culqi/Plans.php';
require_once dirname(__FILE__).'/Culqi/Iins.php';
require_once dirname(__FILE__).'/Culqi/Orders.php';
require_once dirname(__FILE__).'/Culqi/Culqi.php';
