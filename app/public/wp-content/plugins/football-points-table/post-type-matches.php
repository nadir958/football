<?php
if (!defined('ABSPATH')) exit;

/**
 * Register a custom post type for Football Matches
 */
function register_football_match_post_type() {
    register_post_type('football_match', [
        'labels' => [
            'name' => 'Football Matches',
            'singular_name' => 'Football Match',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'matches'],
        'supports' => ['title', 'editor', 'custom-fields'],
        'show_in_rest' => true, // Optional: enables Gutenberg and REST API access
    ]);
}
add_action('init', 'register_football_match_post_type');
