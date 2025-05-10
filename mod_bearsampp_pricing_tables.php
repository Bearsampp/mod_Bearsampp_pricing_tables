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
use Joomla\CMS\HTML\HTMLHelper;

// Load admin CSS if in admin area
$app = Factory::getApplication();
if ($app->isClient('administrator')) {
    // Use WebAssetManager for Joomla 4/5 compatibility
    $wa = $app->getDocument()->getWebAssetManager();
    $wa->registerAndUseStyle('mod_bearsampp_pricing_tables.admin', 'modules/mod_bearsampp_pricing_tables/css/admin.css');
    
    // Add inline styles for highlighting
    $wa->addInlineStyle('
        .btn-group input[id^="jform_params_bearsampp_highlight"][value="yes"]:checked ~ label {
            color: #28a745 !important;
            font-weight: bold;
        }
        
        .btn-group input[id^="jform_params_bearsampp_highlight"] ~ label {
            color: rgba(220, 53, 69, 0.5) !important;
        }
    ');
}

// Include helper file
require_once __DIR__ . '/helper.php';

// Load the layout
require ModuleHelper::getLayoutPath('mod_bearsampp_pricing_tables');
