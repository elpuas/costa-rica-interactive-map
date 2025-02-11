<?php

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
function costa_rica_map_register_tour_cpt()
{
    $labels = array(
        'name'               => _x('Tours', 'post type general name', 'costa-rica-map'),
        'singular_name'      => _x('Tour', 'post type singular name', 'costa-rica-map'),
        'menu_name'          => _x('Tours', 'admin menu', 'costa-rica-map'),
        'add_new'            => _x('Add New', 'tour', 'costa-rica-map'),
        'add_new_item'       => __('Add New Tour', 'costa-rica-map'),
        'edit_item'          => __('Edit Tour', 'costa-rica-map'),
        'new_item'           => __('New Tour', 'costa-rica-map'),
        'view_item'          => __('View Tour', 'costa-rica-map'),
        'search_items'       => __('Search Tours', 'costa-rica-map'),
        'not_found'          => __('No tours found', 'costa-rica-map'),
        'not_found_in_trash' => __('No tours found in Trash', 'costa-rica-map'),
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
    );

    register_post_type('tour', $args);
}

// Hook into WordPress
add_action('init', 'costa_rica_map_register_tour_cpt');
