<?php
/*
Plugin Name: Football Points Table
Description: Displays a football points table using API-Football.
Version: 1.0
Author: Nadir
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include the main class
require_once plugin_dir_path(__FILE__) . 'includes/class-football-table.php';
require_once plugin_dir_path(__FILE__) . 'import-league-ranking.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'import-players.php';

// Initialize the plugin
function football_table_init() {
    new Football_Points_Table();
}
add_action('plugins_loaded', 'football_table_init');

// Ajouter une page d'administration pour l'import
function football_import_menu() {
    add_menu_page(
        'Football Import',       // Titre de la page principale
        'Football Import',       // Texte du menu
        'manage_options',        // Capability requise
        'football_import_main',  // Slug
        'football_import_main_page', // Fonction callback (facultatif)
        'dashicons-admin-generic', // Icône du menu
        20 // Position
    );

    // Ajouter "Import Clubs" comme sous-menu
    add_submenu_page(
        'football_import_main',  // Slug du menu parent
        'Importer des clubs',    // Titre de la page
        'Import Clubs',          // Texte du sous-menu
        'manage_options',        // Capability requise
        'football_import',       // Slug
        'football_import_page'   // Fonction callback
    );
    // Ajouter le sous-menu pour l'import des joueurs
    add_submenu_page(
        'football_import_main', // Slug du menu parent
        'Importer des joueurs', // Titre de la page
        'Import Players', // Texte du sous-menu
        'manage_options', // Capability requise
        'football_import_players', // Slug de la page
        'football_import_players_page_callback' // Fonction callback
    );
    add_submenu_page(
        'football_import_main', // Le slug de ton menu principal (celui de "Import Clubs")
        'Import League Ranking', // Titre de la page
        'Import League Ranking', // Titre du sous-menu
        'manage_options',
        'football_import_league_ranking',
        'football_import_league_ranking_page_callback'
    );
}
add_action('admin_menu', 'football_import_menu');

// Fonction pour afficher le formulaire d'importation
function football_import_page() {
    ?>
    <div class="wrap">
        <h1>Importer des Clubs</h1>
        <form method="post">
            <label for="league_id">ID de la Ligue:</label>
            <input type="number" name="league_id" required>
            
            <label for="num_clubs">Nombre de Clubs à Importer:</label>
            <input type="number" name="num_clubs" value="5" required>
            
            <input type="submit" name="import_clubs" value="Importer" class="button button-primary">
        </form>
    </div>
    <?php

    if (isset($_POST['import_clubs'])) {
        $league_id = intval($_POST['league_id']);
        $num_clubs = intval($_POST['num_clubs']);

        if ($league_id > 0 && $num_clubs > 0) {
            football_import_clubs_from_api($league_id, $num_clubs);
        } else {
            echo '<p style="color:red;">Veuillez entrer des valeurs valides.</p>';
        }
    }
}


