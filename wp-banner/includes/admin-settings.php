<?php
// Add menu item for settings page
function abp_add_admin_menu() {
    add_options_page(
        'Announcement Banner Settings',
        'Announcement Banner',
        'manage_options',
        'announcement-banner-settings',
        'abp_settings_page'
    );
}
add_action('admin_menu', 'abp_add_admin_menu');

// Render settings page
function abp_settings_page() {
    if (isset($_POST['abp_save_settings']) && check_admin_referer('abp_settings_nonce')) {
        update_option('abp_banner_text', sanitize_text_field($_POST['abp_banner_text']));
        update_option('abp_button_link', esc_url_raw($_POST['abp_button_link']));
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $banner_text = get_option('abp_banner_text', 'Welcome to our website! Check out our latest updates.');
    $button_link = get_option('abp_button_link', '#');
    ?>
    <div class="wrap">
        <h1>Announcement Banner Settings</h1>
        <form method="post">
            <?php wp_nonce_field('abp_settings_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="abp_banner_text">Banner Text</label></th>
                    <td><input type="text" name="abp_banner_text" id="abp_banner_text" value="<?php echo esc_attr($banner_text); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="abp_button_link">Button Link</label></th>
                    <td><input type="url" name="abp_button_link" id="abp_button_link" value="<?php echo esc_url($button_link); ?>" class="regular-text"></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="abp_save_settings" class="button-primary" value="Save Changes"></p>
        </form>
    </div>
    <?php
}
