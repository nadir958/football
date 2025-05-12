<?php
function football_import_league_ranking_page_callback() {
    $leagues = [
        39 => 'Premier League',
        140 => 'La Liga',
        135 => 'Serie A',
        78 => 'Bundesliga',
        61 => 'Ligue 1',
    ];
    ?>
    <div class="wrap">
        <h1>Importer le classement des ligues</h1>
        <p>Cette page vous permet d'importer ou de gérer les classements des ligues (enregistré sur la catégorie).</p>
        
        <form method="post">
            <select name="selected_league_id">
                <?php foreach ($leagues as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="import_league_ranking" class="button button-primary" value="Importer le classement">
        </form>

        <?php
        if (isset($_POST['import_league_ranking'])) {
            $league_id = intval($_POST['selected_league_id']);
            import_league_table_to_category_meta($league_id);
            echo '<div class="notice notice-success"><p>Classement importé avec succès !</p></div>';
        }
        ?>
    </div>
    <?php
}

function import_league_table_to_category_meta($league_id) {
    $api_key = '0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4';
    $season = 2024; // Or dynamic year if needed
    $url = "https://api-football-v1.p.rapidapi.com/v3/standings?league=$league_id&season=$season";

    $response = wp_remote_get($url, [
        'headers' => [
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key'  => $api_key,
        ],
    ]);

    if (is_wp_error($response)) {
        error_log('API Error: ' . $response->get_error_message());
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (empty($data['response'][0]['league']['standings'][0])) {
        error_log('No data returned from API');
        return;
    }

    $standings = $data['response'][0]['league']['standings'][0];

    // Get the category term (e.g., premier-league)
    $term_slug = sanitize_title($data['response'][0]['league']['name']);
    $term = get_term_by('slug', $term_slug, 'category');

    if (!$term) {
        // Create category if it doesn't exist
        $term = wp_insert_term($data['response'][0]['league']['name'], 'category', ['slug' => $term_slug]);
        if (is_wp_error($term)) {
            error_log('Failed to create category: ' . $term->get_error_message());
            return;
        }
        $term_id = $term['term_id'];
    } else {
        $term_id = $term->term_id;
    }

    // Save the entire ranking table as term meta
    $existing_ranking_data = get_term_meta($term_id, 'league_ranking_data', true);

    // Update or add the standings
    if (!empty($existing_ranking_data)) {
        // Optionally merge data, or just overwrite
        // $standings = array_merge($existing_ranking_data, $standings); // Example of merging
    }
    
    update_term_meta($term_id, 'league_ranking_data', $standings);
}
