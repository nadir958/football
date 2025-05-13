<?php
if (!defined('ABSPATH')) exit;

/**
 * Add submenu for importing matches
 */
function football_import_matches_menu() {
    add_submenu_page(
        'football_import_main',          // Parent menu slug
        'Import Matches',                // Page title
        'Import Matches',                // Menu title
        'manage_options',                // Capability
        'import_football_matches',       // Menu slug
        'render_import_matches_page'     // Function to render the page
    );
}
add_action('admin_menu', 'football_import_matches_menu');

/**
 * Render the import form
 */
function render_import_matches_page() {
    ?>
    <div class="wrap">
        <h1>Import Matches by League and Week</h1>
        <form method="post">
            <label>League ID: <input type="text" name="league_id" required></label><br><br>
            <label>Season (e.g., 2024): <input type="text" name="season" required></label><br><br>
            <label>From Date (YYYY-MM-DD): <input type="text" name="from_date" required></label><br><br>
            <label>To Date (YYYY-MM-DD): <input type="text" name="to_date" required></label><br><br>
            <input type="submit" name="import_matches" class="button button-primary" value="Import Matches">
        </form>
    </div>
    <?php

    if (isset($_POST['import_matches'])) {
        $league_id = sanitize_text_field($_POST['league_id']);
        $season = sanitize_text_field($_POST['season']);
        $from = sanitize_text_field($_POST['from_date']);
        $to = sanitize_text_field($_POST['to_date']);

        football_fetch_and_save_matches($league_id, $season, $from, $to);
    }
}

/**
 * Fetch and insert matches from API-Football
 */
function football_fetch_and_save_matches($league_id, $season, $from, $to) {
    $api_key = "0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4";
    $api_url = "https://api-football-v1.p.rapidapi.com/v3/fixtures?league={$league_id}&season={$season}&from={$from}&to={$to}";

    $headers = [
        "X-RapidAPI-Key" => $api_key,
        "X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com"
    ];

    $response = wp_remote_get($api_url, [
        'headers' => $headers
    ]);

    if (is_wp_error($response)) {
        echo '<p>Error fetching data from API.</p>';
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!empty($data['response'])) {
        foreach ($data['response'] as $match) {
            $home = $match['teams']['home']['name'];
            $away = $match['teams']['away']['name'];
            $date = $match['fixture']['date'];
            $score = $match['goals']['home'] . ' - ' . $match['goals']['away'];
            $match_id = $match['fixture']['id'];

            wp_insert_post([
                'post_type' => 'football_match',
                'post_title' => "{$home} vs {$away}",
                'post_content' => "Date: {$date}\nScore: {$score}",
                'post_status' => 'publish',
                'meta_input' => [
                    'match_id' => $match_id,
                    'league_id' => $league_id,
                    'season' => $season,
                    'from_date' => $from,
                    'to_date' => $to
                ]
            ]);
        }
        echo '<p>Matches successfully imported!</p>';
    } else {
        echo '<p>No matches found in this range.</p>';
    }
}

