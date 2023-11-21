
<?php
/**
 * Plugin Name: V-Cache Control
 * Description: Adds custom cache control headers to WordPress pages.
 * Version: 1.0
 * Author: Vontainment
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

include_once 'metabox.php';
include_once 'metabox-save.php';

class V_Cache_Control {
    public function __construct() {
        add_action( 'template_redirect', array( $this, 'set_cache_headers' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_cache_control_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_cache_control_meta' ) );
    }

    public function set_cache_headers() {
        if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
            header('X-Vontastic-Cache-Control: no-cache');
        } elseif (is_user_logged_in()) {
            header('X-Vontastic-Cache-Control: private');
        } else {
            header('X-Vontastic-Cache-Control: public');
        }

        // Check for metabox override
        $override = get_post_meta(get_the_ID(), '_v_cache_control_setting', true);
        if (!empty($override) && $override !== 'default') {
            header('X-Vontastic-Cache-Control: ' . $override);
        }
    }

    public function add_cache_control_meta_box() {
        $screens = ['post', 'page', 'product']; // Add other CPTs as needed
        foreach ($screens as $screen) {
            add_meta_box(
                'v_cache_control_meta_box',
                'Cache Control',
                array($this, 'cache_control_meta_box_html'),
                $screen,
                'side'
            );
        }
    }

    public function cache_control_meta_box_html($post) {
        $value = get_post_meta($post->ID, '_v_cache_control_setting', true);
        include('metabox.html');
    }
}

new V_Cache_Control();
?>
