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
 * Add custom meta boxes
 */
function add_tour_meta_boxes()
{
    // Location meta box
    \add_meta_box(
        'tour_coordinates',
        \__('Tour Location', 'costa-rica-map'),
        __NAMESPACE__ . '\\render_coordinates_meta_box',
        'tour',
        'normal',
        'high'
    );

    // Custom URL meta box
    \add_meta_box(
        'tour_custom_url',
        \__('Custom Page Link', 'costa-rica-map'),
        __NAMESPACE__ . '\\render_custom_url_meta_box',
        'tour',
        'normal',
        'high'
    );
}

/**
 * Render coordinates meta box content
 *
 * @param WP_Post $post The post object.
 */
function render_coordinates_meta_box($post)
{
    // Add nonce for security
    \wp_nonce_field('costa_rica_map_save_meta', 'costa_rica_map_meta_nonce');

    // Get existing values
    $latitude = \get_post_meta($post->ID, '_tour_latitude', true);
    $longitude = \get_post_meta($post->ID, '_tour_longitude', true);

?>
    <p>
        <label for="tour_latitude"><?php \_e('Latitude:', 'costa-rica-map'); ?></label>
        <input type="text"
            id="tour_latitude"
            name="tour_latitude"
            value="<?php echo \esc_attr($latitude); ?>"
            class="regular-text" />
    </p>
    <p>
        <label for="tour_longitude"><?php \_e('Longitude:', 'costa-rica-map'); ?></label>
        <input type="text"
            id="tour_longitude"
            name="tour_longitude"
            value="<?php echo \esc_attr($longitude); ?>"
            class="regular-text" />
    </p>
<?php
}

/**
 * Render custom URL meta box content
 *
 * @param WP_Post $post The post object.
 */
function render_custom_url_meta_box($post)
{
    // Get existing value
    $custom_url = \get_post_meta($post->ID, '_tour_custom_url', true);

?>
    <p>
        <label for="tour_custom_url"><?php \_e('Custom Page Link (Optional):', 'costa-rica-map'); ?></label>
        <input type="url"
            id="tour_custom_url"
            name="tour_custom_url"
            value="<?php echo \esc_url($custom_url); ?>"
            placeholder="<?php echo \esc_attr(\get_permalink($post->ID)); ?>"
            class="large-text" />
    </p>
    <p class="description">
        <?php \_e('Enter a custom URL for this tour. Leave empty to use the default tour page.', 'costa-rica-map'); ?>
    </p>
<?php
}

/**
 * Save meta box data
 *
 * @param int $post_id The post ID.
 */
function save_tour_meta($post_id)
{
    // Check if our nonce is set and verify it
    if (
        !isset($_POST['costa_rica_map_meta_nonce']) ||
        !\wp_verify_nonce($_POST['costa_rica_map_meta_nonce'], 'costa_rica_map_save_meta')
    ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (isset($_POST['post_type']) && 'tour' === $_POST['post_type']) {
        if (!\current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Update latitude
    if (isset($_POST['tour_latitude'])) {
        $latitude = \sanitize_text_field($_POST['tour_latitude']);
        \update_post_meta($post_id, '_tour_latitude', $latitude);
    }

    // Update longitude
    if (isset($_POST['tour_longitude'])) {
        $longitude = \sanitize_text_field($_POST['tour_longitude']);
        \update_post_meta($post_id, '_tour_longitude', $longitude);
    }

    // Update custom URL
    if (isset($_POST['tour_custom_url'])) {
        $custom_url = empty($_POST['tour_custom_url']) ? '' : \esc_url_raw($_POST['tour_custom_url']);
        \update_post_meta($post_id, '_tour_custom_url', $custom_url);
    }
}

/**
 * Initialize meta boxes
 */
function init()
{
    \add_action('add_meta_boxes', __NAMESPACE__ . '\\add_tour_meta_boxes');
    \add_action('save_post_tour', __NAMESPACE__ . '\\save_tour_meta');
}

// Initialize
init();
