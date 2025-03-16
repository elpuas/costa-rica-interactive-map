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
        'name'               => \__('Tours', 'costa-rica-map'),
        'singular_name'      => \__('Tour', 'costa-rica-map'),
        'menu_name'          => \__('Tours', 'costa-rica-map'),
        'add_new'            => \__('Add New', 'costa-rica-map'),
        'add_new_item'       => \__('Add New Tour', 'costa-rica-map'),
        'edit_item'          => \__('Edit Tour', 'costa-rica-map'),
        'new_item'           => \__('New Tour', 'costa-rica-map'),
        'view_item'          => \__('View Tour', 'costa-rica-map'),
        'search_items'       => \__('Search Tours', 'costa-rica-map'),
        'not_found'          => \__('No tours found', 'costa-rica-map'),
        'not_found_in_trash' => \__('No tours found in Trash', 'costa-rica-map'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tour'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-location-alt',
        'show_in_rest'       => true,
        'rest_base'          => 'tours',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    \register_post_type('tour', $args);
}

/**
 * Initialize the tour post type
 */
function init()
{
    // Register post type on init
    \add_action('init', __NAMESPACE__ . '\\register_tour_cpt');
}

// Initialize
init();
