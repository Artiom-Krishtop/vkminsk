<?php
// shortcode for Youtube block with cover image

add_shortcode( 'yt_cover', 'youtube_video_cover' );

function youtube_video_cover($atts, $content) {
	//include( get_stylesheet_directory() . '/vc/youtube-video-cover.php');
	
	extract(shortcode_atts(array(
		'video' 			=> '',
		'image'				=> '',		
		), $atts));
	
	//echo $video;
	
	$video_w = 595;
	$video_h = $video_w / 1.61; //1.61 golden ratio
	/** @var WP_Embed $wp_embed */
	global $wp_embed;
	$embed = '';
	if ( is_object( $wp_embed ) ) {
		$embed = $wp_embed->run_shortcode( '[embed id="yt-video-play" width="'. $video_w . '" height="' . $video_h . '"]' . $video . '[/embed]' );
	}
	
	$output = "";
	
	$output .= ($image) ? '<div class="yt-video-wrap" style="background-image: url(' . $image . ')">' : '<div class="yt-video-wrap">';
		$output .= '<div id="yt-video-video" class="yt-video-video">';
			$output .= $embed;
		$output .= '</div>';
		if ($image) {
		$output .= '<div id="yt-video-image" class="yt-video-image">';
			$output .= '<img src="'. $image . '" alt="">';
			$output .= '<div class="yt-video-image-play"></div>';
		$output .= '</div>';
		}
	$output .= '</div>';
	
	return $output;
	
}

vc_map( array(
    'name' => 'yt_cover',
    'base' => 'yt_cover',
    //'category' => ( 'trionn code' ),
    'params' => array(
            "type" => "attach_image",
            "holder" => "img",
            "class" => "",
            "heading" => __( "Image", "themeum-soccer" ),
            "param_name" => "image_url",
            "value" => __( "", "themeum-soccer" ),
            "description" => __( "Image", "themeum-soccer" )
        )
) );

function theme_js() {
    wp_enqueue_script( 'theme_js', '/wp-content/themes/wpsoccer-child/js/custom.js', array( 'jquery' ), '1.0', true );
}

add_action('wp_enqueue_scripts', 'theme_js');



?>