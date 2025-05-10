<?php
/**
 * Bearsampp_Pricing-Table
 * 
 * @version     2025.5.10
 * @package     Bearsampp_Pricing-Table
 * @author      Bearsampp
 * @email       support@bearsampp.com
 * @website     https://www.bearsampp.com
 * @copyright   Copyright (c) 2025 Bearsampp
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

// Load admin CSS if in admin area
$app = Factory::getApplication();
if ($app->isClient('administrator')) {
    $document = $app->getDocument();
    $document->addStyleSheet(Uri::root(true) . '/modules/mod_bearsampp_pricing_tables/css/admin.css');
}

// Include helper file
require_once __DIR__ . '/helper.php';

// Load the layout
require ModuleHelper::getLayoutPath('mod_bearsampp_pricing_tables');
