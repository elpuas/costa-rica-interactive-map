<?php

namespace CostaRicaMap\Meta;

/**
 * Meta Box Functions
 *
 * @package Costa_Rica_Map
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Add custom meta box for coordinates
 */
function add_meta_boxes()
{
    \add_meta_box(
        'tour_coordinates',
        \__('Tour Location', 'costa-rica-map'),
        __NAMESPACE__ . '\\coordinates_meta_box',
        'tour',
        'normal',
        'high'
    );
}

/**
 * Render meta box content
 */
function coordinates_meta_box($post)
{
    // Add nonce for security
    \wp_nonce_field('costa_rica_map_save_meta_box_data', 'costa_rica_map_meta_box_nonce');

    // Get existing values
    $latitude = \get_post_meta($post->ID, '_tour_latitude', true);
    $longitude = \get_post_meta($post->ID, '_tour_longitude', true);

?>
    <p>
        <label for="tour_latitude"><?php \_e('Latitude:', 'costa-rica-map'); ?></label>
        <input type="text" id="tour_latitude" name="tour_latitude" value="<?php echo \esc_attr($latitude); ?>" />
    </p>
    <p>
        <label for="tour_longitude"><?php \_e('Longitude:', 'costa-rica-map'); ?></label>
        <input type="text" id="tour_longitude" name="tour_longitude" value="<?php echo \esc_attr($longitude); ?>" />
    </p>
<?php
}

/**
 * Save meta box data
 */
function save_meta_box_data($post_id)
{
    if (!isset($_POST['costa_rica_map_meta_box_nonce'])) {
        return;
    }

    if (!\wp_verify_nonce($_POST['costa_rica_map_meta_box_nonce'], 'costa_rica_map_save_meta_box_data')) {
        return;
    }

    if (\defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!\current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['tour_latitude'])) {
        \update_post_meta($post_id, '_tour_latitude', \sanitize_text_field($_POST['tour_latitude']));
    }

    if (isset($_POST['tour_longitude'])) {
        \update_post_meta($post_id, '_tour_longitude', \sanitize_text_field($_POST['tour_longitude']));
    }
}

// Hook into WordPress
\add_action('add_meta_boxes', __NAMESPACE__ . '\\add_meta_boxes');
\add_action('save_post', __NAMESPACE__ . '\\save_meta_box_data');
