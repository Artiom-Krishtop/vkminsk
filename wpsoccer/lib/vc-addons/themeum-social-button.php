<?php
add_shortcode( 'themeum_social_button', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' 			=> '',
		'facebook'			=> '',
		'facebook_text'		=> '',
		'twitter'			=> '',
		'twitter_text'		=> '',
		'gplus'				=> '',
		'gplus_text'		=> '',
		'linkedin'			=> '',
		'linkedin_text'		=> '',
		'delicious'		    => '',
		'delicious_text'	=> '',
		'tumblr'			=> '',
		'tumblr_text'		=> '',
		'stumbleupon'		=> '',
		'stumbleupon_text'	=> '',
		'pinterest'			=> '',
		'pinterest_text'	=> '',
		'dribble'			=> '',
		'dribble_text'		=> '',
		'class'				=> '',
		), $atts));

	

	$inline_css = $output = '';


	$output .= '<div class="themeum-social-button'.esc_attr($class).'">';
	$output .= '<ul class="list-unstyled">';
	if( $pinterest ) { 
	$output .= '<li><a href="'.esc_url($pinterest).'" target="_blank"><i class="fa fa-vk"></i>'.esc_html($pinterest_text).'</a></li>';
	}	
	if( $facebook ) { 
	$output .= '<li><a href="'.esc_url($facebook).'" target="_blank"><i class="fa fa-facebook-square"></i>'.esc_html($facebook_text).'</a></li>';
	}				 
	if( $twitter ) { 
	$output .= '<li><a href="'.esc_url($twitter).'" target="_blank"><i class="fa fa-twitter-square"></i>'.esc_html($twitter_text).'</a></li>';
	}				
	if( $gplus ) { 
	$output .= '<li><a href="'.esc_url($gplus).'" target="_blank"><i class="fa fa-google-plus-square"></i>'.esc_html($gplus_text).'</a></li>';
	}				
	if( $linkedin ) { 
	$output .= '<li><a href="'.esc_url($linkedin).'" target="_blank"><i class="fa fa-linkedin-square"></i>'.esc_html($linkedin_text).'</a></li>';
	}				
	if( $delicious ) { 
	$output .= '<li><a href="'.esc_url($delicious).'" target="_blank"><i class="fa fa-delicious"></i>'.esc_html($delicious_text).'</a></li>';
	}				
	if( $tumblr ) { 
	$output .= '<li><a href="'.esc_url($tumblr).'" target="_blank"><i class="fa fa-tumblr-square"></i>'.esc_html($delicious_text).'</a></li>';
	}				
	if( $stumbleupon ) { 
	$output .= '<li><a href="'.esc_url($stumbleupon).'" target="_blank"><i class="fa fa-youtube"></i>'.esc_html($stumbleupon_text).'</a></li>'; 
	}								
	if( $dribble ) { 
	$output .= '<li><a href="'.esc_url($dribble).'" target="_blank"><i class="fa fa-instagram"></i>'.esc_html($dribble_text).'</a></li>'; 
	}
	$output .= '</ul>';
	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Social Button", "themeum"),
	"base" => "themeum_social_button",
	'icon' => 'icon-thm-social-button',
	"class" => "",
	"description" => __("Widget Title Heading", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(			

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Facebook URL", "themeum"),
			"param_name" => "facebook",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Like us on Facebook", "themeum"),
			"param_name" => "facebook_text",
			"value" => "",
			),		

		array(
			"type" => "textfield",
			"heading" => __("Twitter URL", "themeum"),
			"param_name" => "twitter",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Twitter", "themeum"),
			"param_name" => "twitter_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Gplus URL", "themeum"),
			"param_name" => "gplus",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Gplus", "themeum"),
			"param_name" => "gplus_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Linkedin URL", "themeum"),
			"param_name" => "linkedin",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Linkedin", "themeum"),
			"param_name" => "linkedin_text",
			"value" => "",
			),					

		array(
			"type" => "textfield",
			"heading" => __("VK URL", "themeum"),
			"param_name" => "pinterest",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Follow us on VK", "themeum"),
			"param_name" => "pinterest_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Delicious URL", "themeum"),
			"param_name" => "delicious",
			"value" => "",
			),		

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Delicious", "themeum"),
			"param_name" => "delicious_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Tumblr URL", "themeum"),
			"param_name" => "tumblr",
			"value" => "",
			),		

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Tumblr", "themeum"),
			"param_name" => "tumblr_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("YouTube URL", "themeum"),
			"param_name" => "stumbleupon",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Follow us on YouTube", "themeum"),
			"param_name" => "stumbleupon_text",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Instagram URL", "themeum"),
			"param_name" => "dribble",
			"value" => "",
			),		

		array(
			"type" => "textfield",
			"heading" => __("Follow us on Instagram", "themeum"),
			"param_name" => "dribble_text",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Custom Class ", "themeum"),
			"param_name" => "class",
			"value" => "",
			),

		)
	));
}