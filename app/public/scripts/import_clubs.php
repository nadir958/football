<?php
// Load WordPress
require_once __DIR__ . '/wp-load.php';

// API-Football credentials
$api_key = 'bf22cc4ab6msh3944e5bec2ca7b3p1af173jsnaadb0e8986af';
$league_id = 39; // Premier League
$season = 2023;  // Current season

// API URL
$url = "https://api-football-v1.p.rapidapi.com/v3/teams?league={$league_id}&season={$season}";

// API headers
$headers = [
    "X-RapidAPI-Key: $api_key",
    "X-RapidAPI-Host: api-football-v1.p.rapidapi.com"
];

// Call API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Check if API request was successful
if (!$data || !isset($data['response'])) {
    die("❌ Error fetching API data.");
}

// Initialize counter
$import_count = 0;
$max_imports = 5; // Limit to 5 clubs

// Loop through clubs and import into WordPress
foreach ($data['response'] as $team) {
    if ($import_count >= $max_imports) {
        break; // Stop after 5 imports
    }

    $team_info = $team['team'];
    $venue_info = $team['venue'];

    $club_name = $team_info['name'];
    $club_logo = $team_info['logo'];
    $club_country = $team_info['country'];
    $club_stadium = $venue_info['name'];

    // Check if club already exists
    $existing_club = get_page_by_title($club_name, OBJECT, 'club');

    if (!$existing_club) {
        // Insert club post
        $post_id = wp_insert_post([
            'post_title'   => $club_name,
            'post_status'  => 'publish',
            'post_type'    => 'club',
        ]);

        if ($post_id) {
            // Save metadata with CMB2
            update_post_meta($post_id, 'club_type_name', $club_name);
            update_post_meta($post_id, 'club_stadium', $club_stadium);
            update_post_meta($post_id, 'club_country', $club_country);

            // Save club logo
            if ($club_logo) {
                update_post_meta($post_id, 'gallery_club_images', [$club_logo]);
            }

            echo "✅ Imported: $club_name\n";
            $import_count++;
        } else {
            echo "❌ Error importing: $club_name\n";
        }
    } else {
        echo "⚠️ Already exists: $club_name\n";
    }
}

echo "🎉 Import complete! Imported $import_count clubs.\n";
