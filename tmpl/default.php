<?php
/**
 * Bearsampp_Pricing-Table
 * Version : 2025.5.10
 * Created by : Bearsampp
 * Email : support@bearsampp.com
 * URL : www.bearsampp.com
 * License GPLv3.0 - http://www.gnu.org/licenses/gpl-3.0.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Update for Joomla 5: Use namespaced classes
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;
use Joomla\Registry\Registry;

// Make sure $app is defined
$app = Factory::getApplication();

// Make sure $module is defined
if (!isset($module)) {
    $module = $app->input->get('module');
}

// Make sure $params is defined
if (!isset($params)) {
    if (isset($module->params)) {
        $params = new Registry($module->params);
    } else {
        $params = new Registry();
    }
}

// Make sure we have a module ID
$bearsampp_moduleid = isset($module->id) ? $module->id : 0;

$baseurl = Uri::base(); // Updated from JURI::base()

$bearsampp_num_images     = $params->get('bearsampp_num_images', 3);
$bearsampp_image_margin_y = $params->get('bearsampp_image_margin_y', 20);
$bearsampp_image_margin_x = $params->get('bearsampp_image_margin_x', 20);
$bearsampp_column_bg      = $params->get('bearsampp_column_bg', '#ffffff');
$bearsampp_header_bg      = $params->get('bearsampp_header_bg', '#2c3e50');
$bearsampp_highlight_bg   = $params->get('bearsampp_highlight_bg', '#e74c3c');
$bearsampp_title_color    = $params->get('bearsampp_title_color', '#ffffff');
$bearsampp_price_color    = $params->get('bearsampp_price_color', '#2c3e50');
$bearsampp_pricesub_color = $params->get('bearsampp_pricesub_color', '#95a5a6');
$bearsampp_features_color = $params->get('bearsampp_features_color', '#7f8c8d');
$bearsampp_button_color   = $params->get('bearsampp_button_color', '#3498db');

$image_ref      = array();
$bearsampp_title      = array();
$bearsampp_subtitle   = array();
$bearsampp_price      = array();
$bearsampp_features   = array();
$bearsampp_buttontext = array();
$bearsampp_buttonurl  = array();
$bearsampp_highlight  = array();

$max_images = 15;
for ($i = 1; $i <= $max_images; $i++) {
    if ($params->get('bearsampp_title' . $i)) {
        $image_ref[]        = $i;
        $bearsampp_title[$i]      = $params->get('bearsampp_title' . $i);
        $bearsampp_subtitle[$i]   = $params->get('bearsampp_subtitle' . $i);
        $bearsampp_price[$i]      = $params->get('bearsampp_price' . $i);
        $bearsampp_features[$i]   = $params->get('bearsampp_features' . $i);
        $bearsampp_buttontext[$i] = $params->get('bearsampp_buttontext' . $i);
        $bearsampp_buttonurl[$i]  = $params->get('bearsampp_buttonurl' . $i);
        $bearsampp_highlight[$i]  = $params->get('bearsampp_highlight' . $i);
    }
}

// Load CSS/JS
// Update for Joomla 5: Use Factory::getDocument() instead of JFactory
$document = Factory::getDocument();
$document->addStyleSheet(Uri::base() . 'modules/MOD_BEARSAMPP_pricing_tables/css/style.css');

// Styling from module parameters
$bearsampp_css = '';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .bearsampp_pricing_tables { padding:' . $bearsampp_image_margin_y . 'px ' . $bearsampp_image_margin_x . 'px; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan { background-color:' . $bearsampp_column_bg . '; box-shadow: inset 0 0 0 5px ' . $bearsampp_header_bg . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' header { background-color: ' . $bearsampp_header_bg . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' header:after { border-color: ' . $bearsampp_header_bg . ' transparent transparent transparent; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-title { color:' . $bearsampp_title_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-price { color:' . $bearsampp_price_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-type { color:' . $bearsampp_pricesub_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-features { color:' . $bearsampp_features_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-select a { background-color: ' . $bearsampp_button_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .plan-select a:hover { background: ' . $bearsampp_button_color . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .featured.plan { }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .featured .plan-select a { background-color: ' . $bearsampp_highlight_bg . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .featured header { background-color: ' . $bearsampp_highlight_bg . '; }';
$bearsampp_css .= ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .featured header:after { border-color: ' . $bearsampp_highlight_bg . ' transparent transparent transparent; }';

// Put styling in header
$document->addStyleDeclaration($bearsampp_css);

/* Columns */
if ($bearsampp_num_images == '1') :
    $style = ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .bearsampp_pricing_tables { width: 100%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bearsampp_num_images == '2') :
    $style = ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .bearsampp_pricing_tables { width: 50%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bearsampp_num_images == '3') :
    $style = ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .bearsampp_pricing_tables { width: 33.3%; } ';
    $document->addStyleDeclaration($style);
endif;
if ($bearsampp_num_images == '4') :
    $style = ' .bearsampp_pricing_tables' . $bearsampp_moduleid . ' .bearsampp_pricing_tables { width: 25%; } ';
    $document->addStyleDeclaration($style);
endif;
?>

<div class="bearsampp_pricing_tables<?php echo $bearsampp_moduleid; ?> bearsampp_pricing_tables-outer">
    <div class="bearsampp_pricing_tables-container">
    <?php
    $imagenr = 0;
    for ($i = 1; $i <= $bearsampp_num_images; $i++) {
        if (isset($image_ref[$imagenr])) {
            $cur_img = $image_ref[$imagenr];
            if (!empty($cur_img)) {
                ?>
                <div class="bearsampp_pricing_tables">
                    <div class="plan <?php
                    if (isset($bearsampp_highlight[$cur_img]) && $bearsampp_highlight[$cur_img] == 'yes') : ?>featured<?php
                    endif; ?>">
                        <header>
                            <h4 class="plan-title">
                                <?php echo htmlspecialchars($bearsampp_title[$cur_img] ?? ''); ?>
                            </h4>
                            <div class="plan-cost">
                                <span class="plan-price"><?php echo htmlspecialchars($bearsampp_price[$cur_img] ?? ''); ?></span>
                                <span class="plan-type"><?php echo htmlspecialchars($bearsampp_subtitle[$cur_img] ?? ''); ?></span>
                            </div>
                        </header>

                        <ul class="plan-features dot">
                            <?php
                            if (!empty($bearsampp_features[$cur_img])) {
                                $features = $bearsampp_features[$cur_img];
                                
                                // Process features based on their structure
                                if (is_object($features)) {
                                    // Handle subform data structure
                                    foreach ($features as $key => $item) {
                                        if (is_object($item) && isset($item->bearsampp_feature)) {
                                            echo '<li>' . htmlspecialchars($item->bearsampp_feature) . '</li>';
                                        }
                                    }
                                } elseif (is_array($features)) {
                                    // Handle array of features
                                    foreach ($features as $item) {
                                        if (is_object($item) && isset($item->bearsampp_feature)) {
                                            echo '<li>' . htmlspecialchars($item->bearsampp_feature) . '</li>';
                                        } elseif (is_string($item)) {
                                            echo '<li>' . htmlspecialchars($item) . '</li>';
                                        }
                                    }
                                } elseif (is_string($features)) {
                                    // Try to decode if it's a JSON string
                                    $decoded = json_decode($features);
                                    if (json_last_error() === JSON_ERROR_NONE && (is_array($decoded) || is_object($decoded))) {
                                        foreach ($decoded as $item) {
                                            if (is_object($item) && isset($item->bearsampp_feature)) {
                                                echo '<li>' . htmlspecialchars($item->bearsampp_feature) . '</li>';
                                            } elseif (is_string($item)) {
                                                echo '<li>' . htmlspecialchars($item) . '</li>';
                                            }
                                        }
                                    } else {
                                        // It's just a plain string
                                        echo '<li>' . htmlspecialchars($features) . '</li>';
                                    }
                                }
                            }
                            ?>
						</ul>

                        <div class="plan-select">
                            <a class="btn" href="<?php echo htmlspecialchars($bearsampp_buttonurl[$cur_img] ?? '#'); ?>">
                                <?php echo htmlspecialchars($bearsampp_buttontext[$cur_img] ?? ''); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            $imagenr++;
        }
    }
    ?>
    </div>
    <div class="clear"></div>
</div>
<?php
// Proper debugging code - uncomment to see what's in the features array
/*
echo '<pre style="text-align:left; background:#f5f5f5; padding:10px; margin:10px; border:1px solid #ccc;">';
echo "All features:<br>";
var_dump($bearsampp_features);
echo '</pre>';
*/
?>
