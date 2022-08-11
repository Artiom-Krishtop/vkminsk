<?php
add_shortcode( 'themeum_birthday_block', function($atts, $content = null) {

	extract(shortcode_atts([
        'birthday_text' => ''
    ], $atts));

// dd($birthday_text);	
 	$output     = $birthday_text;

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map([
		"name" => __("Birthday Block", "themeum"),
		"base" => "themeum_birthday_block",
		'icon' => 'icon-thm-video_post',
		"class" => "",
		"description" => __("Birthday Block", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => [				
			[
				"type" => "textarea",
				"heading" => __("Текст поздравления", "themeum"),
				"param_name" => "birthday_text",
				"value" => '',
            ],	
        ]
    ]);
}
