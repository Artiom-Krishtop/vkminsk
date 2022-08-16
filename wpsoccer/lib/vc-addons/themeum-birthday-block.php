<?php
add_shortcode( 'themeum_birthday_block', function($atts, $content = null) {

	extract(shortcode_atts([
        'birthday_text' => ''
    ], $atts));

	$output = '<div class="b-birthday-block"><p class="birthday-text">';

    $posts = get_posts([
        'post_type'   => 'player',
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_query' => [
                [
                    'key' => 'datar',
                    'value' => date('md'),
					'compare' => 'LIKE' 
                ]
            ] 
        ]);
	
	$players = '';

	if(empty($posts)){
		return "<script>$('#birthday-block').hide()</script>";
	}

	foreach ($posts as $post) {
		$playerData = get_post_meta($post->ID);

		$fullName = $playerData['themeum_full_name'][0];
		$role = $playerData['themeum_position'][0];
		$club = get_the_title($playerData['themeum_player_club'][0]);

		if(empty($fullName) || empty($role) || empty($club)){
			continue;
		}

		$players .= '<span class="birthday-player">' . $role . ' команды "' . $club . '"</br>' . $fullName . '</span>';
	}

	$birthday_text = str_replace('#PLAYER#', $players, $birthday_text);

 	$output .= $birthday_text;
	$output .= '</p></div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map([
		"name" => __("Birthday Block", "themeum"),
		"base" => "themeum_birthday_block",
		'icon' => 'icon-thm-video_post',
		"class" => "",
		"description" => __("Блок поздравления", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => [				
			[
				"type" => "textarea",
				"heading" => __("Текст поздравления", "themeum"),
				"description" => __("Вместо #PLAYER# будут перечислены именинники каждый с новой строки в формате 'АМПЛУА' команды 'КОМАНДА' - 'ИМЯ И ФАМИЛИЯ'", "themeum" ),
				"param_name" => "birthday_text",
				"value" => '',
            ],	
        ]
    ]);
}
