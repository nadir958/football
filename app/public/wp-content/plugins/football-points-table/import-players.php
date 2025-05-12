<?php
// Callback pour afficher la page
function football_import_players_page_callback() {
    ?>
    <div class="wrap">
        <h1>Importer les joueurs</h1>
        <form method="post" action="">
            <label for="league_id">ID de la Ligue :</label>
            <input type="text" name="league_id" required>
            <label for="club_id">ID du Club :</label>
            <input type="text" name="club_id" required>
            <label for="players_count">Nombre de joueurs à importer :</label>
            <input type="number" name="players_count" min="1" max="50" value="10" required>
            <input type="submit" name="import_players" value="Importer">
        </form>
    </div>
    <?php

    if (isset($_POST['import_players'])) {
        $league_id = sanitize_text_field($_POST['league_id']);
        $club_id = sanitize_text_field($_POST['club_id']);
        $players_count = intval($_POST['players_count']);
        football_import_players_from_api($league_id, $club_id, $players_count);
    }
}

// Fonction d'importation des joueurs
function football_import_players_from_api($league_id, $club_id, $players_count) {
    $api_key = "0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4";
    $api_url = "https://api-football-v1.p.rapidapi.com/v3/players?team={$club_id}&league={$league_id}&season=2024";
    
    $response = wp_remote_get($api_url, [
        'headers' => [
            'X-RapidAPI-Key' => $api_key,
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com'
        ]
    ]);
    
    if (is_wp_error($response)) {
        echo '<div class="error"><p>Erreur lors de la récupération des joueurs.</p></div>';
        return;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($data['response'])) {
        echo '<div class="error"><p>Aucun joueur trouvé.</p></div>';
        return;
    }

    $players = $data['response'];
    $imported_count = 0;

    foreach ($players as $player) {
        if ($imported_count >= $players_count) {
            break; // Stop when we've imported enough new players
        }

        // Skip if not part of first team
        if (isset($player['team']['type']) && $player['team']['type'] !== 'first_team') {
            continue;
        }

        $player_name = $player['player']['name'];
        $player_position = $player['statistics'][0]['games']['position'];
        $player_image = $player['player']['photo'];
        $player_full_name = $player['player']['name'];
        $squad_number = $player['statistics'][0]['games']['shirt'];
        $country_short_name = $player['player']['nationality'];
        $player_club = $player['statistics'][0]['team']['name'];
        $birth_date = $player['player']['birth']['date'];

        // Check if player already exists (by full name and club)
        $existing_player_query = new WP_Query([
            'post_type'  => 'players',
            'post_status'=> 'publish',
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => 'full_name',
                    'value' => $player_full_name,
                    'compare' => '='
                ],
                [
                    'key' => 'present_club_meta',
                    'value' => $player_club,
                    'compare' => '='
                ]
            ],
            'posts_per_page' => 1
        ]);

        if ($existing_player_query->have_posts()) {
            continue; // Already exists
        }

        // Insert new player
        $post_id = wp_insert_post([
            'post_title'  => $player_name,
            'post_type'   => 'players',
            'post_status' => 'publish'
        ]);

        if ($post_id) {
            // Upload image and set as thumbnail
            $image_id = media_sideload_image($player_image, $post_id, $player_name, 'id');
            set_post_thumbnail($post_id, $image_id);

            // Add metadata
            update_post_meta($post_id, 'present_club_meta', $player_club);
            update_post_meta($post_id, 'player_position_meta', $player_position);
            update_post_meta($post_id, 'squad_number', $squad_number);
            update_post_meta($post_id, 'full_name', $player_full_name);
            update_post_meta($post_id, 'c_short_name', $country_short_name);
            update_post_meta($post_id, 'player_birth_date', $birth_date);

            $imported_count++;
        }
    }

    echo '<div class="updated"><p>Importation terminée. Joueurs importés : ' . $imported_count . '</p></div>';
}
?>