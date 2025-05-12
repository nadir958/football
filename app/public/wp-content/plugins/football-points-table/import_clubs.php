<?php
function football_import_clubs_from_api($league_id, $num_clubs) {
    $api_key = "0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4";
    $api_url = "https://api-football-v1.p.rapidapi.com/v3/teams?league={$league_id}&season=2024";

    $headers = [
        "X-RapidAPI-Key: $api_key",
        "X-RapidAPI-Host: api-football-v1.p.rapidapi.com"
    ];

    $response = wp_remote_get($api_url, [
        'headers' => $headers
    ]);

    if (is_wp_error($response)) {
        echo '<p style="color:red;">Erreur lors de la requête API.</p>';
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['response']) || empty($data['response'])) {
        echo '<p style="color:red;">Aucun club trouvé.</p>';
        return;
    }

    $clubs = array_slice($data['response'], 0, $num_clubs); // Limit to the requested number of clubs

    foreach ($clubs as $club) {
        $club_name = sanitize_text_field($club['team']['name']);
        $club_logo = esc_url($club['team']['logo']);
        $club_country = sanitize_text_field($club['team']['country']);

        // Fetch stadium data
        $club_stadium = isset($club['venue']['name']) ? sanitize_text_field($club['venue']['name']) : 'Unknown';

        // Fetch points from standings API
        $club_points = football_get_club_points($club['team']['id'], $league_id);

        // Check if club already exists
        $existing_post = get_page_by_title($club_name, OBJECT, 'club');

        if ($existing_post) {
            echo "<p style='color:orange;'>Le club <strong>{$club_name}</strong> existe déjà.</p>";
            continue;
        }

        // Create the club post
        $club_id = wp_insert_post([
            'post_title'   => $club_name,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'club',
        ]);

        if ($club_id) {
            // Save metadata
            update_post_meta($club_id, 'club_country', $club_country);
            update_post_meta($club_id, 'club_stadium', $club_stadium);
            update_post_meta($club_id, 'club_points', $club_points);

            // Save club image
            football_save_image($club_logo, $club_id);

            // Assign league category
            $league_name = "Ligue $league_id";
            $category_id = term_exists($league_name, 'category');

            if (!$category_id) {
                $category_id = wp_insert_term($league_name, 'category');
                $category_id = $category_id['term_id'];
            } else {
                $category_id = $category_id['term_id'];
            }

            wp_set_post_terms($club_id, $category_id, 'category');

            echo "<p style='color:green;'>Le club <strong>{$club_name}</strong> a été ajouté avec succès.</p>";
        } else {
            echo "<p style='color:red;'>Échec de l'importation de <strong>{$club_name}</strong>.</p>";
        }
    }
}

function football_get_club_points($team_id, $league_id) {
    $api_key = "0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4";
    $api_url = "https://api-football-v1.p.rapidapi.com/v3/standings?league={$league_id}&season=2024";

    $headers = [
        "X-RapidAPI-Key: $api_key",
        "X-RapidAPI-Host: api-football-v1.p.rapidapi.com"
    ];

    $response = wp_remote_get($api_url, [
        'headers' => $headers
    ]);

    if (is_wp_error($response)) {
        return 0; // Return 0 if API request fails
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['response'][0]['league']['standings'][0])) {
        return 0;
    }

    // Find the team in the standings
    foreach ($data['response'][0]['league']['standings'][0] as $team) {
        if ($team['team']['id'] == $team_id) {
            return $team['points']; // Return the points of the club
        }
    }

    return 0; // Default to 0 if team is not found
}

