<?php
if (!defined('ABSPATH')) exit;

/**
 * Shortcode to display recent matches
 */
function render_recent_matches_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => 10,
    ], $atts);

    $args = [
        'post_type' => 'football_match',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<p>No recent matches found.</p>';
    }

    $output = '<table style="width:100%; border-collapse:collapse; text-align:left;">';
    $output .= '<thead><tr><th style="border-bottom:1px solid #ccc;">Match</th><th style="border-bottom:1px solid #ccc;">Date</th><th style="border-bottom:1px solid #ccc;">Score</th></tr></thead><tbody>';

    while ($query->have_posts()) {
        $query->the_post();
        $content = get_the_content();
        preg_match('/Date: (.*?)\\n/', $content, $date);
        preg_match('/Score: (.*?)$/', $content, $score);

        $output .= '<tr>';
        $output .= '<td>' . esc_html(get_the_title()) . '</td>';
        $output .= '<td>' . esc_html($date[1] ?? '') . '</td>';
        $output .= '<td>' . esc_html($score[1] ?? '') . '</td>';
        $output .= '</tr>';
    }

    wp_reset_postdata();
    $output .= '</tbody></table>';

    return $output;
}
add_shortcode('recent_matches', 'render_recent_matches_shortcode');
