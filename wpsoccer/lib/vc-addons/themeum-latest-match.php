<?php
add_shortcode( 'themeum_latest_match', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'image'				=> '',
		'title'				=> '',
		'title_size'		=> '72',
		'title_margin'		=> '10px 0 10px 0',
		'padding'			=> '220px 0 140px 0',
		'color'				=> '#fff',
		'team_a'			=> '',
		'team_b'			=> '',
		'match_date'		=> '',
		'next_match'		=> '',
		'place'				=> '',
		'class'				=> '',
		), $atts));

		$src_image   = wp_get_attachment_image_src($image, 'full');

		$output = $style = $style2 = $style3 = $image_style = '';

		if($title_size != '' ){ $style .= 'font-size:'.esc_attr((int)$title_size).'px;'; }
		if($title_margin != '' ){ $style .= 'margin:'.esc_attr($title_margin).';'; }
		if($color != '' ){ $style .= 'color:'.esc_attr($color).';'; }

		if ($padding) {$style2 .= 'padding:'.esc_attr($padding).';';}
		if ($src_image[0]) {$style2 .= 'background-image: url('.esc_url($src_image[0]).');background-repeat:no-repeat;background-size:cover;';}		

		if ($padding) {$style3 .= 'padding:'.esc_attr($padding).';';}


		if ( $src_image[0] != "" ) {
           $image_style = 'style = "'.$style2.'"';
        }else{
           $image_style = 'style="background-color: #444;'.$style3.'"';
        }


		$output .= '<div class="themeum-latest-match '.esc_attr($class).'" '.$image_style.'>';

			$output .= '<div class="container">';	
			$output .= '<div class="row">';	
			$output .= '<div class="col-sm-7">';	
			if ($title) {
				$output .= '<h2 style="'.$style.'">'.esc_attr($title).'</h2>';
			}
			
			if ($match_date) {
				$datetime = $match_date; ?>
                <script type="text/javascript">
                    jQuery(function($) {
                         jQuery('#home-countdown-timer').countdown("<?php echo str_replace('-', '/', $datetime); ?>", function(event) {
                            $(this).html(event.strftime('<div class="countdown-section  next-match-count"><span class="countdown-amount next-match-text"><?php echo $next_match ?></span><span class="countdown-period next-match-place"><?php echo $place; ?></span></div><div class="countdown-section"><span class="countdown-amount">%-D </span><span class="countdown-period">%!D:<?php echo __("Day", "themeum"); ?>,<?php echo __("Days", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-H </span><span class="countdown-period">%!H:<?php echo __("Hour", "themeum"); ?>,<?php echo __("Hours", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-M </span><span class="countdown-period">%!M:<?php echo __("Minute", "themeum"); ?>,<?php echo __("Minutes", "themeum"); ?>;</span></div><div class="countdown-section"><span class="countdown-amount">%-S </span><span class="countdown-period">%!S:<?php echo __("Second", "themeum"); ?>,<?php echo __("Seconds", "themeum"); ?>;</span></div>'));
                      	});
                    });
                </script>
               <?php 
               $output .= '<div id="home-countdown-timer"></div>';
               $output .= '<div id="clearfix"></div>';
			}
			$output .= '<div class="latest-team">';
			if ($team_a) {
				$output .= '<span class="latest-team-a">'.esc_attr($team_a).'</span>';
			}	
			if ($team_b) {	
				$output .= '<span class="latest-team-b">'.esc_attr($team_b).'</span>';
			}
			$output .= '</div>';//latest-team


			$output .= '</div>';//col-sm-7
			$output .= '</div>';//row
			$output .= '</div>';//container
		$output .= '</div>';

	return $output;

});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Latest Match", "themeum"),
	"base" => "themeum_latest_match",
	'icon' => 'icon-thm-latest-match',
	"description" => __("Latest Match is Display Here.", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "attach_image",
			"heading" => __("Insert Image", "themeum"),
			"param_name" => "image",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Font Size", "themeum"),
			"param_name" => "title_size",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Margin", "themeum"),
			"param_name" => "title_margin",
			"value" => ""
			),		

		array(
			"type" => "textfield",
			"heading" => __("Title Padding", "themeum"),
			"param_name" => "padding",
			"value" => ""
			),			

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "color",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Team A", "themeum"),
			"param_name" => "team_a",
			"value" => ""
			),			

		array(
			"type" => "textfield",
			"heading" => __("Team B", "themeum"),
			"param_name" => "team_b",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Match Date", "themeum"),
			"param_name" => "match_date",
			"value" => ""
			),			

		array(
			"type" => "textfield",
			"heading" => __("Next Match Text Ex. Next Match", "themeum"),
			"param_name" => "next_match",
			"value" => "",
			),		
		array(
			"type" => "textfield",
			"heading" => __("Place Name Ex. West Yorkshine, UK", "themeum"),
			"param_name" => "place",
			"value" => "",
			),														
			
		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),	

		)
	));
}