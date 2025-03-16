<?php

namespace CostaRicaMap\Admin;

/**
 * Admin Functions
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Load Post Type
require_once \plugin_dir_path(__FILE__) . 'tour-functions.php';

// Load Taxonomy
require_once \plugin_dir_path(__FILE__) . 'zone-functions.php';

// Load Meta Boxes
require_once \plugin_dir_path(__FILE__) . 'meta-functions.php';

// Load AJAX Handlers
require_once \plugin_dir_path(__FILE__) . 'ajax-functions.php';

// Initialize admin functionality
function init()
{
    // Add any admin-specific initialization here
    \add_action('admin_init', __NAMESPACE__ . '\\register_admin_settings');
}

/**
 * Register admin settings
 */
function register_admin_settings()
{
    // Add any admin settings registration here
}

// Initialize
init();
