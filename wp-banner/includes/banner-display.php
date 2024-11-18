<?php
function abp_display_banner() {
    $banner_text = get_option('abp_banner_text', '');
    $button_link = get_option('abp_button_link', '#');

    if ($banner_text) {
        echo '
        <div class="announcement-banner">
            <p>' . esc_html($banner_text) . '</p>
            <a href="' . esc_url($button_link) . '" class="button">Learn More</a>
        </div>';
    }
}
add_action('wp_body_open', 'abp_display_banner');

