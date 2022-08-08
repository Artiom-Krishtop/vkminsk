<?php
add_shortcode( 'themeum_statistic', function($atts, $content = null) {

	extract(shortcode_atts([
        'link_statistic' => 'javascript:void(0)',
        'cup_bel' => '',
        'chump_bel' => ''
    ], $atts));

 	$output = '';

    $output .= '<div class="themeum-statistic">
                    <div class="statistic-cup-wrapper">
                        <div class="cup-img__wrap"><span><strong>'. $cup_bel .'</strong></span>
                        <img src="/wp-content/themes/wpsoccer-child/images/cup-belarus.png" alt=""/>
                        </div>
                        <span class="cup-desc__text"><b>Кубок Беларуси</b></span>
                    </div>
                    <div class="statistic-link-wrapper">
                        <a class="statistic-link" href="' . $link_statistic . '"><span class="statistic-link-text">Статистика игр</span></a>
                    </div>
                    <div class="statistic-cup-wrapper">
                        <div class="cup-img__wrap"><span><strong>'. $chump_bel .'</strong></span>
                        <img src="/wp-content/themes/wpsoccer-child/images/chemp-belarus.png" alt=""/>
                        </div>
                        <span class="cup-desc__text"><b>Чемпионат Беларуси</b></span>
                    </div>
                </div>';

	return $output;
});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map([
		"name" => __("Statistic Games", "themeum"),
		"base" => "themeum_statistic",
		'icon' => 'icon-thm-highlight',
		"class" => "",
		"description" => __("Show statistis games", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => [
            [
				"type" => "textfield",
				"heading" => __("Link to page", "themeum"),
				"param_name" => "link_statistic",
				"value" => '',
            ],	
            [
				"type" => "textfield",
				"heading" => __("Кубок Беларуси", "themeum"),
				"param_name" => "cup_bel",
				"value" => '',
            ],
            [
				"type" => "textfield",
				"heading" => __("Чемпионат Беларуси", "themeum"),
				"param_name" => "chump_bel",
				"value" => '',
            ],
        ]
    ]);
}