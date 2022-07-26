<?php
add_shortcode( 'themeum_result_games', function($atts, $content = null) {

    extract(shortcode_atts(array(
		'league_id'			=> '',
        'slider_interval'   => 5000,
        'count_items'       => 10			
		), $atts));

    global $post;

    $output = '';

    $arr = explode(',', str_replace(' ', '', $league_id));

    $args = array(
        'post_type'			=> 'fixture_reasult',
        'posts_per_page' 	=> $count_items,
        'tax_query' => array(
                            array(
                                'taxonomy' => 'league',
                                'field'    => 'slug',
                                'terms'    => $arr,
                            ),
                        ),
        'meta_key'          => 'themeum_datetime',
        'orderby'           => 'meta_value',
        'order'             => 'DESC'
    );

    /* выводим матчи с сегоднящнего дня и на месяц */
    $obDateTo = new DateTime();
    $obDateFrom = new DateTime();
    $obDateFrom->add(new DateInterval('P1M'));

    $args['meta_query'] = [
        [
            'key' => 'themeum_datetime',
            'value' => [$obDateTo->format('Y-m-d H:s'), $obDateFrom->format('Y-m-d H:s')],
            'compare' => 'BETWEEN',
            'type' => 'DATETIME'
        ]
    ];

    $posts = get_posts($args);

    if(!empty($posts)){
        $output = '<div class="result-container"><div class="result-items">';

        foreach ($posts as $key => $post){
            setup_postdata($post);
            
            $team_1    = get_post_meta(get_the_ID(),'team_1_group',true);
            $team_2    = get_post_meta(get_the_ID(),'team_2_group',true);

            if(!empty($team_1) && !empty($team_2)){
                
                $match_result = explode(':', trim(get_post_meta(get_the_ID(),'themeum_goal_count',true)));

                if($match_result[0] !== '' && $match_result[1] !== ''){
                    $team_1['goals'] = $match_result[0];
                    $team_2['goals'] = $match_result[1];
                }else {
                    $team_1['goals'] = $team_2['goals'] = 'X';
                }

                $team_1['full_name'] = themeum_get_title_by_id($team_1["themeum_club_name1"]);
                $team_2['full_name'] = themeum_get_title_by_id($team_2["themeum_club_name2"]);

                $city = [];

                if(preg_match('/\((.*)\)/', $team_1['full_name'], $city)){
                    $team_1['city'] = $city[1];
                    $team_1['full_name'] = trim(str_replace($city[0], '', $team_1['full_name'])); 
                }

                if(preg_match('/\((.*)\)/', $team_2['full_name'], $city)){
                    $team_2['city'] = $city[1]; 
                    $team_2['full_name'] = trim(str_replace($city[0], '', $team_2['full_name'])); 
                }

                $team_1['logo_src'] = themeum_logo_url_by_id($team_1["themeum_club_name1"]);
                $team_2['logo_src'] = themeum_logo_url_by_id($team_2["themeum_club_name2"]);

                $match_date = dateToRussian(date_format(date_create(get_post_meta(get_the_ID(),"themeum_datetime",true)), 'd M Y'));
                $match_time = date_format(date_create(get_post_meta(get_the_ID(),"themeum_datetime",true)), 'H:i');

                $match_place = get_post_meta(get_the_ID(),'themeum_home_ground',true);

                $leagueTerms = get_the_terms(get_post(), 'league');
                $league['name'] = $leagueTerms[0]->name;

                $output.= '<div class="result__item"><div class="result-item-title">';
                                
                if(!empty($league['name'])) {
                    $output.=  '<span class="result-item__title-legue">'.mb_strtoupper($league['name']).'</span>';
                }
                                
                $output .= '</div><div class="result-item-teams"><div class="result-item__team left"><div class="result-item__team-name">';

                if(!empty($team_1['full_name'])) {
                    $output.=  '<span class="result-item__team-name-txt">'.$team_1['full_name'].'</span>';
                }

                if(!empty($team_1['city'])) {
                    $output.=  '<span class="result-item__team-city">'.$team_1['city'].'</span>';
                }

                $output .= '</div><div class="result-item__team-logo">';

                if(!empty($team_1['logo_src'])) {
                    $output.=  '<img src="'.$team_1['logo_src'].'" width="40px" height="40px" alt="">';
                }else{
                    $output.=  '<img src="/wp-content/themes/wpsoccer/images/logo-footer@2x.png" width="40px" height="40px" alt="">';
                }

                $output .= '</div></div><div class="result-item__score">';
                $output .= '<div class="result-item__score-table">
                                <span class="result-item__score-view">'.$team_1['goals'].':'.$team_2['goals'].'</span>
                            </div>';
                
                if(!empty($match_place)) {
                    $output.=  '<span class="result-item__score-location">'.$match_place.'</span>';
                }

                $output .= '</div><div class="result-item__team right"><div class="result-item__team-name">';

                if(!empty($team_2['full_name'])) {
                    $output.=  '<span class="result-item__team-name-txt">'.$team_2['full_name'].'</span>';
                }

                if(!empty($team_2['city'])) {
                    $output.=  '<span class="result-item__team-city">'.$team_2['city'].'</span>';
                }

                $output .= '</div><div class="result-item__team-logo">';

                if(!empty($team_2['logo_src'])) {
                    $output.=  '<img src="'.$team_2['logo_src'].'" width="40px" height="40px" alt="">';
                }else{
                    $output.=  '<img src="/wp-content/themes/wpsoccer/images/logo-footer@2x.png" width="40px" height="40px" alt="">';
                }
                                
                $output .= '</div></div></div>';

                $output .= '<div class="result-item-datetime">';

                if(!empty($match_date)) {
                    $output.=  '<span class="result-item__title-date"><b>'.mb_strtoupper($match_date).'</b></span>';
                }

                if(!empty($match_time)) {
                    $output.=  '<span class="result-item__title-time">&nbsp;&nbsp;<b>'.mb_strtoupper($match_time).'</b></span>';
                }

                $output .= '</div></div>';
            }
	    }

        $output .= '</div></div>';
        $output .= "<script type='text/javascript'>
                        jQuery(document).ready(function() { 
                            $('.result-items').owlCarousel({
                                items: 2,
                                loop: true,
                                dots:true,
                                nav:false,
                                autoplay: true,
                                autoplayHoverPause:true,
                                autoplayTimeout:". $slider_interval .",
                                responsive:{ 
                                    0:{
                                        items:1
                                    },
                                    860:{
                                        items:2
                                    }
                                }
                            });
                        });
                    </script>";
    }

	wp_reset_postdata();	

    return $output;
});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
    vc_map([
        "name" => __("Result Games", "themeum"),
        "base" => "themeum_result_games",
        'icon' => 'icon-thm-latest-match',
        "description" => __("Result Games List", "themeum"),
        "category" => __('Themeum', "themeum"),
        "params" => [
            [
                "type" => "textfield",
                "heading" => __("Legue ID", "themeum"),
                "param_name" => "league_id",
                "value" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Количество записей", "themeum"),
                "param_name" => "count_items",
                "value" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Slider Interval", "themeum"),
                "param_name" => "slider_interval",
                "value" => "",
            ]
        ]
    ]);
}