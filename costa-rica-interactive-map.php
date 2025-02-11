<?php

/**
 * Plugin Name: Costa Rica Interactive Map
 * Plugin URI: https://github.com/elpuas/costa-rica-interactive-map
 * Description: An interactive map of Costa Rica using Leaflet.js
 * Version: 1.0.0
 * Author: ElPuas Digital Crafts
 * Author URI: https://elpuasdigitalcrafts.com
 * Text Domain: costa-rica-map
 * License: GPL v2 or later
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('COSTA_RICA_MAP_VERSION', '1.0.0');
define('COSTA_RICA_MAP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('COSTA_RICA_MAP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include admin functionality
if (is_admin()) {
    require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/admin.php';
}

/**
 * Enqueue scripts and styles.
 */
function costa_rica_map_enqueue_scripts()
{
    // Enqueue our custom CSS which includes Leaflet CSS
    wp_enqueue_style(
        'costa-rica-map-style',
        COSTA_RICA_MAP_PLUGIN_URL . 'build/index.css',
        array(),
        COSTA_RICA_MAP_VERSION
    );

    // Enqueue our custom JavaScript which includes Leaflet
    wp_enqueue_script(
        'costa-rica-map-script',
        COSTA_RICA_MAP_PLUGIN_URL . 'build/index.js',
        array(),
        COSTA_RICA_MAP_VERSION,
        true
    );

    // Localize the script with data
    wp_localize_script(
        'costa-rica-map-script',
        'costaRicaMapData',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('costa_rica_map_nonce'),
        )
    );
}

/**
 * Register shortcode for the map.
 */
function costa_rica_map_shortcode()
{
    ob_start();
?>
    <div id="costa-rica-map" style="height: 500px;"></div>
    <div id="tour-info"></div>
<?php
    return ob_get_clean();
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'costa_rica_map_enqueue_scripts');
add_shortcode('costa_rica_map', 'costa_rica_map_shortcode');

/**
 * Initialize plugin
 */
function costa_rica_map_init()
{
    // Add initialization code here
}
add_action('init', 'costa_rica_map_init');
