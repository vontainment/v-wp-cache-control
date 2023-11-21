
<?php
function save_cache_control_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;
    if (!isset($_POST['v_cache_control_setting']) || 
        !wp_verify_nonce($_POST['v_cache_control_nonce'], 'v_cache_control_save')) 
        return;
    $cache_setting = sanitize_text_field($_POST['v_cache_control_setting']);
    update_post_meta($post_id, '_v_cache_control_setting', $cache_setting);
}
?>
