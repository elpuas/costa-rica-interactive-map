<?php
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
function costa_rica_map_get_tours() {
    check_ajax_referer('costa_rica_map_nonce', 'nonce');

    $args = array(
        'post_type' => 'tour',
        'posts_per_page' => -1,
    );

    if (isset($_GET['zone'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'zone',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['zone']),
            ),
        );
    }

    $tours = get_posts($args);
    $data = array();

    foreach ($tours as $tour) {
        $latitude = get_post_meta($tour->ID, '_tour_latitude', true);
        $longitude = get_post_meta($tour->ID, '_tour_longitude', true);
        
        if ($latitude && $longitude) {
            $data[] = array(
                'id' => $tour->ID,
                'title' => $tour->post_title,
                'excerpt' => get_the_excerpt($tour),
                'permalink' => get_permalink($tour->ID),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'zones' => wp_get_post_terms($tour->ID, 'zone', array('fields' => 'names')),
            );
        }
    }

    wp_send_json_success($data);
}

// Hook into WordPress
add_action('wp_ajax_get_tours', 'costa_rica_map_get_tours');
add_action('wp_ajax_nopriv_get_tours', 'costa_rica_map_get_tours'); 