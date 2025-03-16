<?php

namespace CostaRicaMap\Ajax;

/**
 * AJAX Functions
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * AJAX handler for getting tour data
 */
function get_tours()
{
    // Verify nonce
    \check_ajax_referer('costa_rica_map_nonce', 'nonce');

    $args = array(
        'post_type' => 'tour',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );

    // Add zone filter if provided
    if (isset($_GET['zone'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'zone',
                'field'    => 'slug',
                'terms'    => \sanitize_text_field($_GET['zone']),
            ),
        );
    }

    $tours = \get_posts($args);
    $data = array();

    foreach ($tours as $tour) {
        $latitude = \get_post_meta($tour->ID, '_tour_latitude', true);
        $longitude = \get_post_meta($tour->ID, '_tour_longitude', true);
        $custom_url = \get_post_meta($tour->ID, '_tour_custom_url', true);

        if ($latitude && $longitude) {
            $data[] = array(
                'id' => $tour->ID,
                'title' => $tour->post_title,
                'excerpt' => \get_the_excerpt($tour),
                'permalink' => !empty($custom_url) ? $custom_url : \get_permalink($tour->ID),
                'latitude' => (float) $latitude,
                'longitude' => (float) $longitude,
                'zones' => \wp_get_post_terms($tour->ID, 'zone', array('fields' => 'names')),
            );
        }
    }

    \wp_send_json_success($data);
}

/**
 * Initialize AJAX handlers
 */
function init()
{
    // Register AJAX handlers
    \add_action('wp_ajax_get_tours', __NAMESPACE__ . '\\get_tours');
    \add_action('wp_ajax_nopriv_get_tours', __NAMESPACE__ . '\\get_tours');
}

// Initialize
init();
