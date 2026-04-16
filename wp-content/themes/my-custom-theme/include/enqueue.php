<?php
/**
 * CSS・JSファイル 読込
 */

function mytheme_enqueue_assets() {

    // CSS
    wp_enqueue_style(
        'mytheme-style',
        get_theme_file_uri('/assets/css/style.css'),
        [],
        wp_get_theme()->get('Version')
    );

    // JavaScript
    wp_enqueue_script(
        'mytheme-script',
        get_theme_file_uri('/assets/js/script.js'),
        [],
        wp_get_theme()->get('Version'),
        true
    );

}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');