<?php

namespace CostaRicaMap;

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
define('COSTA_RICA_MAP_PLUGIN_DIR', \plugin_dir_path(__FILE__));
define('COSTA_RICA_MAP_PLUGIN_URL', \plugin_dir_url(__FILE__));

/**
 * Main plugin class
 */
class Plugin
{
    /**
     * Plugin instance.
     *
     * @var Plugin
     */
    private static $instance = null;

    /**
     * Get plugin instance.
     *
     * @return Plugin
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->init();
    }

    /**
     * Initialize plugin
     */
    private function init()
    {
        // Include admin functionality
        require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/admin.php';

        // Add hooks
        \add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        \add_shortcode('costa_rica_map', array($this, 'shortcode'));
    }

    /**
     * Activate plugin
     */
    public static function activate()
    {
        require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/tour-functions.php';
        Tours\register_tour_cpt();
        \flush_rewrite_rules();
    }

    /**
     * Deactivate plugin
     */
    public static function deactivate()
    {
        \unregister_post_type('tour');
        \flush_rewrite_rules();
    }

    /**
     * Enqueue scripts and styles.
     */
    public function enqueue_scripts()
    {
        \wp_enqueue_style(
            'costa-rica-map-style',
            COSTA_RICA_MAP_PLUGIN_URL . 'build/index.css',
            array(),
            COSTA_RICA_MAP_VERSION
        );

        \wp_enqueue_script(
            'costa-rica-map-script',
            COSTA_RICA_MAP_PLUGIN_URL . 'build/index.js',
            array(),
            COSTA_RICA_MAP_VERSION,
            true
        );

        \wp_localize_script(
            'costa-rica-map-script',
            'costaRicaMapData',
            array(
                'ajaxurl' => \admin_url('admin-ajax.php'),
                'nonce' => \wp_create_nonce('costa_rica_map_nonce'),
            )
        );
    }

    /**
     * Register shortcode for the map.
     */
    public function shortcode()
    {
        ob_start();
?>
        <div id="costa-rica-map" style="height: 500px;"></div>
        <div id="tour-info"></div>
<?php
        return ob_get_clean();
    }
}

// Initialize plugin
\register_activation_hook(__FILE__, array(__NAMESPACE__ . '\\Plugin', 'activate'));
\register_deactivation_hook(__FILE__, array(__NAMESPACE__ . '\\Plugin', 'deactivate'));

// Start the plugin
Plugin::get_instance();
