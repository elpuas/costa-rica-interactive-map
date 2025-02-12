<?php

namespace CostaRicaMap\Tours;

/**
 * Tour Functions
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Register Custom Post Type for Tours
 */
function register_tour_cpt()
{
    $labels = array(
        'name'                  => \_x('Tours', 'Post type general name', 'costa-rica-map'),
        'singular_name'         => \_x('Tour', 'Post type singular name', 'costa-rica-map'),
        'menu_name'             => \_x('Tours', 'Admin Menu text', 'costa-rica-map'),
        'name_admin_bar'        => \_x('Tours', 'Add New on Toolbar', 'costa-rica-map'),
        'archives'              => \__('Tours Archives', 'costa-rica-map'),
        'all_items'             => \__('All Tours', 'costa-rica-map'),
        'add_new_item'          => \__('Add New Tour', 'costa-rica-map'),
        'add_new'               => \__('Add New', 'costa-rica-map'),
        'new_item'              => \__('New Tour', 'costa-rica-map'),
        'edit_item'             => \__('Edit Tour', 'costa-rica-map'),
        'update_item'           => \__('Update Tour', 'costa-rica-map'),
        'view_item'             => \__('View Tour', 'costa-rica-map'),
        'search_items'          => \__('Search Tours', 'costa-rica-map'),
        'not_found'             => \__('Not found', 'costa-rica-map'),
        'not_found_in_trash'    => \__('Not found in Trash', 'costa-rica-map'),
        'featured_image'        => \__('Featured Image', 'costa-rica-map'),
        'set_featured_image'    => \__('Set featured image', 'costa-rica-map'),
        'remove_featured_image' => \__('Remove featured image', 'costa-rica-map'),
        'use_featured_image'    => \__('Use as featured image', 'costa-rica-map'),
    );

    $args = array(
        'label'               => \__('Tour', 'costa-rica-map'),
        'description'         => \__('Tour Description', 'costa-rica-map'),
        'labels'             => $labels,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('zone'),
        'hierarchical'       => false,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 28,
        'menu_icon'          => 'dashicons-location-alt',
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'has_archive'        => 'tours',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_in_rest'       => true,
        'rest_base'          => 'tours',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'capability_type'    => 'post',
        'rewrite'            => array(
            'slug'       => 'tour',
            'with_front' => false,
        ),
    );

    \register_post_type('tour', $args);
}

// Register the CPT on init with priority 0
\add_action('init', __NAMESPACE__ . '\\register_tour_cpt', 0);

// Flush rewrite rules only once after plugin activation
function costa_rica_map_rewrite_flush()
{
    register_tour_cpt();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'costa_rica_map_rewrite_flush');
