<?php

namespace CostaRicaMap\Admin;

/**
 * Admin functionality
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Include admin files
require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/tour-functions.php';
require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/zone-functions.php';
require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/meta-functions.php';
require_once COSTA_RICA_MAP_PLUGIN_DIR . 'admin/ajax-functions.php';
