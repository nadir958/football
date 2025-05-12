<?php
if (!defined('ABSPATH')) {
    exit;
}

class Football_Points_Table {
    private $api_url = "https://api-football-v1.p.rapidapi.com/v3/standings";
    private $api_key = "0d2ff8ac2fmshfc6dcf6bd08482ap1161b7jsn369b244737e4"; // Replace with your actual API key

    public function __construct() {
        add_shortcode('football_table', array($this, 'display_table'));
        add_shortcode('football_last_matches', array($this, 'display_last_matches'));

    }

    private function fetch_standings($league_id, $season) {
        $args = array(
            'headers' => array(
                'X-RapidAPI-Key' => $this->api_key,
                'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com'
            )
        );
        
        $response = wp_remote_get("{$this->api_url}?league={$league_id}&season={$season}", $args);
        //var_dump($response);die;

        if (is_wp_error($response)) {
            return [];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return $data['response'][0]['league']['standings'][0] ?? [];
    }

    public function display_table($atts) {
        $atts = shortcode_atts(array(
            'league' => 39,  // Default league (Premier League)
            'season' => 2023 // Default season
        ), $atts);

        $standings = $this->fetch_standings($atts['league'], $atts['season']);

        if (empty($standings)) {
            return "<p>No data available.</p>";
        }

        ob_start();
        ?>
        <style>
            .football-table {
                width: 100%;
                max-width: 400px;
                background: #1e2329;
                color: #fff;
                border-radius: 8px;
                padding: 10px;
                font-family: Arial, sans-serif;
            }
            .football-table table {
                width: 100%;
                border-collapse: collapse;
            }
            .football-table th, .football-table td {
                padding: 8px;
                text-align: left;
            }
            .football-table th {
                background: #2d3748;
            }
            .football-table tr:nth-child(even) {
                background: #2a2e35;
            }
            .football-table img {
                width: 20px;
                height: 20px;
                vertical-align: middle;
                margin-right: 8px;
            }
        </style>
        <div class="football-table">
            <h3>Point Table</h3>
            <table>
                <tr>
                    <th>Team</th>
                    <th>W</th>
                    <th>L</th>
                    <th>PTS</th>
                </tr>
                <?php foreach ($standings as $team) : ?>
                    <tr>
                        <td>
                            <img src="<?php echo esc_url($team['team']['logo']); ?>" alt="<?php echo esc_attr($team['team']['name']); ?>">
                            <?php echo esc_html($team['team']['name']); ?>
                        </td>
                        <td><?php echo esc_html($team['all']['win']); ?></td>
                        <td><?php echo esc_html($team['all']['lose']); ?></td>
                        <td><?php echo esc_html($team['points']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function fetch_last_matches() {
        $date = date('Y-m-d'); // Today
        $season = date('Y') - 1; // Current season
        $leagues = [2, 3, 848, 39, 140, 78, 135, 61]; // Selected leagues
        $matches = [];
    
        foreach ($leagues as $league) {
            $api_url = "https://api-football-v1.p.rapidapi.com/v3/fixtures?date={$date}&season={$season}&league={$league}&status=FT&timezone=Europe/London";
    
            $args = array(
                'headers' => array(
                    'X-RapidAPI-Key' => $this->api_key,
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com'
                )
            );
    
            $response = wp_remote_get($api_url, $args);
    
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $data = json_decode($body, true);
                if (!empty($data['response'])) {
                    $matches = array_merge($matches, $data['response']);
                }
            }
        }
    
        // Debug: Check if matches from all leagues are included
        // var_dump($matches); die;
    
        return $matches;
    }
    
    
    

    
    public function display_last_matches() {
        $matches = $this->fetch_last_matches();
    
        if (empty($matches)) {
            return "<p>No matches available for today.</p>";
        }
    
        ob_start();
        ?>
        <style>
            .football-matches {
                width: 100%;
                background: #1e2329;
                color: #fff;
                border-radius: 8px;
                padding: 10px;
                font-family: Arial, sans-serif;
            }
            .football-matches .match {
                padding: 10px;
                border-bottom: 1px solid #333;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .football-matches .league {
                text-align: center;
                font-weight: bold;
                background: #2d3748;
                padding: 5px;
                margin-top: 10px;
            }
            .football-matches img {
                width: 30px;
                height: 30px;
                margin-right: 8px;
            }
            .football-matches .details {
                text-align: center;
            }
            .football-matches .time {
                color: #fbbf24;
                font-weight: bold;
            }
            .football-matches .button {
                text-align: center;
                margin-top: 10px;
            }
            .football-matches .button a {
                display: inline-block;
                background: #fbbf24;
                color: #000;
                padding: 8px 12px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
            }
        </style>
    
        <div class="football-matches">
            <?php 
            $current_league = '';
            foreach ($matches as $match) :
                $league_name = $match['league']['name'];
                $league_logo = $match['league']['logo'];
    
                // Display league name only when it changes
                if ($league_name !== $current_league) {
                    echo "<div class='league'><img src='{$league_logo}' width='20'> " . esc_html($league_name) . "</div>";
                    $current_league = $league_name;
                }
            ?>
                <div class="match">
                    <div class="team">
                        <img src="<?php echo esc_url($match['teams']['home']['logo']); ?>" alt="<?php echo esc_attr($match['teams']['home']['name']); ?>">
                        <?php echo esc_html($match['teams']['home']['name']); ?>
                    </div>
                    <div class="details">
                        <div><?php echo date('M d Y', strtotime($match['fixture']['date'])); ?></div>
                        <div class="time"><?php echo date('H:i', strtotime($match['fixture']['date'])); ?></div>
                        <div><?php echo esc_html($match['fixture']['venue']['name']); ?></div>
                        <div><?php echo esc_html($match['goals']['home'] ?? 0); ?> - <?php echo esc_html($match['goals']['away'] ?? 0); ?></div>
                    </div>
                    <div class="team">
                        <?php echo esc_html($match['teams']['away']['name']); ?>
                        <img src="<?php echo esc_url($match['teams']['away']['logo']); ?>" alt="<?php echo esc_attr($match['teams']['away']['name']); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="button">
                <a href="#">VIEW FULL FIXTURE</a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }    
    
}
