<?php
/**
 * Zone Functions
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Register Custom Taxonomy for Zones
 */
function costa_rica_map_register_zone_taxonomy() {
    $labels = array(
        'name'              => _x('Zones', 'taxonomy general name', 'costa-rica-map'),
        'singular_name'     => _x('Zone', 'taxonomy singular name', 'costa-rica-map'),
        'search_items'      => __('Search Zones', 'costa-rica-map'),
        'all_items'         => __('All Zones', 'costa-rica-map'),
        'parent_item'       => __('Parent Zone', 'costa-rica-map'),
        'parent_item_colon' => __('Parent Zone:', 'costa-rica-map'),
        'edit_item'         => __('Edit Zone', 'costa-rica-map'),
        'update_item'       => __('Update Zone', 'costa-rica-map'),
        'add_new_item'      => __('Add New Zone', 'costa-rica-map'),
        'new_item_name'     => __('New Zone Name', 'costa-rica-map'),
        'menu_name'         => __('Zones', 'costa-rica-map'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'          => array('slug' => 'zone'),
    );

    register_taxonomy('zone', array('tour'), $args);
}
add_action('init', 'costa_rica_map_register_zone_taxonomy'); 