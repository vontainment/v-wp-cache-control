
<?php
$value = get_post_meta($post->ID, '_v_cache_control_setting', true);
?>
<label for="v_cache_control_setting">Cache Control:</label>
<select name="v_cache_control_setting" id="v_cache_control_setting">
    <option value="default" <?php selected($value, 'default'); ?>>Default</option>
    <option value="private" <?php selected($value, 'private'); ?>>Private</option>
    <option value="public" <?php selected($value, 'public'); ?>>Public</option>
    <option value="no-cache" <?php selected($value, 'no-cache'); ?>>No-Cache</option>
</select>
