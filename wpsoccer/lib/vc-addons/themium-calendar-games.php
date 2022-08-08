<?php
add_shortcode( 'themeum_calendar_games', function($atts, $content = null) {

	extract(shortcode_atts([
        'count_lines' => 20
    ], $atts));

    $output = '';
    $taxQuery = [];

    $leagues = get_terms([
        'taxonomy' => 'league',
        'hide_empty' => true,
    ]);

    $leagueFilter = '';

    if(isset($_REQUEST['calendar-league']) && $_REQUEST['calendar-league'] != '0'){
        $leagueFilter = trim(htmlspecialchars($_REQUEST['calendar-league']));
        $taxQuery[] = ['taxonomy' => 'league','field' => 'slug','terms' => $leagueFilter];
    }

    $leagueSelect = '<select name="calendar-league"><option value="0"> - Не выбрано - </option>';    
    
    if(!empty($leagues)){
        foreach ($leagues as $league) {
            $selected = $leagueFilter == $league->slug ? 'selected' : '';
            $leagueSelect .= '<option value="' . $league->slug . '" '.$selected.'>' . $league->name . '</option>';
        }
    }

    $leagueSelect .= '</select>';

    $seasons = get_terms([
        'taxonomy' => 'season',
        'hide_empty' => true,
    ]);

    $seasonFilter = '';

    if(isset($_REQUEST['calendar-season']) && $_REQUEST['calendar-season'] != '0'){
        $seasonFilter = trim(htmlspecialchars($_REQUEST['calendar-season']));
        $taxQuery[] = ['taxonomy' => 'season','field' => 'slug','terms' => $seasonFilter];
    }

    $seasonsSelect = '<select name="calendar-season"><option value="0"> - Не выбрано - </option>';    
    
    if(!empty($seasons)){
        foreach ($seasons as $season) {
            $selected = $seasonFilter == $season->slug ? 'selected' : '';
            $seasonsSelect .= '<option value="' . $season->slug . '" '.$selected.'>' . $season->name . '</option>';
        }
    }

    $seasonsSelect .= '</select>';

 	$output .= '<div class="calendar-games-container">';
    $output .= '<div class="calendar-games-filter-wrap">
                    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                        <label for="calendar-league">Турнир:</label>
                        '. $leagueSelect .'
                        <label for="calendar-season">Сезон:</label>
                        '. $seasonsSelect .'
                        <input type="submit" value="Отфильтровать">
                    </form>
                </div>';

    $args = array(
        'post_type'			=> 'fixture_reasult',
        'posts_per_page' 	=> $count_lines,
        'meta_key'          => 'themeum_datetime',
        'orderby'           => 'meta_value',
        'order'             => 'DESC'
    );

    if(!empty($taxQuery)){
        $args['tax_query'] = $taxQuery;
    }

    $posts = get_posts($args);

    if(!empty($posts)){

        $output .= '<div class="calendar-games-table-wrap"><table class="calendar-games-table"><tbody>';

        $sortPosts = [];

        foreach ($posts as $post) {
            $matchDateTime = DateTime::createFromFormat('Y-m-d H:s', get_post_meta($post->ID, 'themeum_datetime', true));
            $month = $matchDateTime->format('m.Y');
            $sortPosts[$month][] = $post;
        }

        foreach ($sortPosts as $month => $posts) {

            $monthGroup = DateTime::createFromFormat('m.Y', $month);
            $month = get_russian_name_month($monthGroup->format('m'));
            $year = $monthGroup->format('Y');

            $output .= '<tr class="calendar-games-table__row month">
                            <td colspan="10">
                                <h2>'.$month.', '.$year.'</h2>
                            </td>
                        </tr>';
            
            foreach ($posts as $post) {
                $matchDateTime = DateTime::createFromFormat('Y-m-d H:s', get_post_meta($post->ID, 'themeum_datetime', true));
                $matchDate = $matchDateTime->format('d.m.Y');
                $matchTime = $matchDateTime->format('H:s');
    
                $matchPlace = get_post_meta($post->ID, 'themeum_home_ground', true);

                if(empty($matchPlace)){
                    $matchPlace = '-';
                }

                $team_1 = get_post_meta($post->ID,'team_1_group',true);
                $team_2 = get_post_meta($post->ID,'team_2_group',true);
    
                $team_1['name'] = themeum_get_title_by_id($team_1["themeum_club_name1"]);
                $team_2['name'] = themeum_get_title_by_id($team_2["themeum_club_name2"]);

                $team_1['logo_src'] = themeum_logo_url_by_id($team_1["themeum_club_name1"]);
                $team_2['logo_src'] = themeum_logo_url_by_id($team_2["themeum_club_name2"]);

                $defaultLogo = '/wp-content/uploads/2017/06/Screenshot-at-sent.-13-23-10-22.png';

                $team_1_logo = !empty($team_1['logo_src']) ? $team_1['logo_src'] : $defaultLogo;
                $team_2_logo = !empty($team_2['logo_src']) ? $team_2['logo_src'] : $defaultLogo;

                $matchScore = get_post_meta($post->ID, 'themeum_goal_count', true);

                if(empty($matchScore) || trim($matchScore) == ':'){
                    $matchScore = '-:-';
                }
                
                $league = array_shift(wp_get_post_terms($post->ID, 'league', ['fields' => 'names']));
    
                $output .= '<tr class="calendar-games-table__row">
                                <td class="date">'.$matchDate.'</td>
                                <td class="time">'.$matchTime.'</td>
                                <td class="place">'.ucfirst($matchPlace).'</td>
                                <td class="team">'.$team_1['name'].'</td>
                                <td class="team-logo"><img alt="'.$team_1['name'].'" src="'.$team_1_logo.'"></td>
                                <td class="score">'.$matchScore.'</td>
                                <td class="team-logo"><img alt="'.$team_2['name'].'" src="'.$team_2_logo.'"></td>
                                <td class="team">'.$team_2['name'].'</td>
                                <td class="league">'.$league.'</td>
                            </tr>';
            }
        }

        $output .= '</tbody></table></div>';
    }

    $output .= '</div>';
    
    return $output;
});

function get_russian_name_month($month){
	$month = intval($month);
	
	$monthsList = [
		1 => "Январь", 2 => "Февраль", 3 => "Март",
		4 => "Апрель", 5 => "Май", 6 => "Июнь",
		7 => "Июль", 8 => "Август", 9 => "Сентябрь",
		10 => "Октябрь", 11 => "Ноябрь", 12 => "Декабрь"
	];

	return $monthsList[$month];
}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map([
		"name" => __("Calendar Games", "themeum"),
		"base" => "themeum_calendar_games",
		'icon' => 'icon-thm-highlight',
		"class" => "",
		"description" => __("Show calendar games", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => [
            [
                "type" => "textfield",
                "heading" => __("Количество выводимых записей", "themeum"),
                "param_name" => "count_lines",
                "value" => "",
            ],
        ]
    ]);
}