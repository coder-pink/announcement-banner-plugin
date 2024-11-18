<?php
/**
 * Plugin Name: Announcement Banner Plugin
 * Description: A simple plugin to add customizable announcement banners to WordPress websites.
 * Version: 1.0
 * Author: Pinky
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('ANNOUNCEMENT_BANNER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ANNOUNCEMENT_BANNER_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
include_once ANNOUNCEMENT_BANNER_PLUGIN_DIR . 'includes/admin-settings.php';
include_once ANNOUNCEMENT_BANNER_PLUGIN_DIR . 'includes/banner-display.php';

// Register hooks
register_activation_hook(__FILE__, 'abp_activate_plugin');
register_deactivation_hook(__FILE__, 'abp_deactivate_plugin');

// Plugin activation logic
function abp_activate_plugin() {
    add_option('abp_banner_text', 'Welcome to our website! Check out our deals.');
    add_option('abp_button_link', '#');
}

// Plugin deactivation logic
function abp_deactivate_plugin() {
    delete_option('abp_banner_text');
    delete_option('abp_button_link');
}

// Load assets
function abp_enqueue_assets() {
    // wp_enqueue_style('abp-style', ANNOUNCEMENT_BANNER_PLUGIN_URL . 'assets/style.css');
    wp_enqueue_style(
        'abp-style',
        ANNOUNCEMENT_BANNER_PLUGIN_URL . 'assets/style.css',
        array(),
        filemtime(ANNOUNCEMENT_BANNER_PLUGIN_DIR . 'assets/style.css') // Ensure CSS is always updated
    );
}
add_action('wp_enqueue_scripts', 'abp_enqueue_assets');
