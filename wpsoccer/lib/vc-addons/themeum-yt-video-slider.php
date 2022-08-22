<?php 

add_shortcode( 'themeum_yt_video_slider', function($atts, $content = null) {

    extract(shortcode_atts([
        'video_ids_str'			=> '',
        'interval' => 5000
    ], $atts));

    $output = '';

    if(strlen($video_ids_str) > 0){
        $video_ids_str = str_replace(' ', '', $video_ids_str);
        $video_ids = explode(';', $video_ids_str);

        if(!empty($video_ids)){
            $output .= '<div class="yt-video-slider-wraper"><div class="yt-video-slider-container" id="yt-video-slider">'; 
            
            foreach ($video_ids as $video_id) {
                if(empty($video_id)){
                    continue;
                }

                $output .= '<div class="yt-video-slider__item">';
                $output .= '<iframe width="600" height="370" src="https://www.youtube.com/embed/' . $video_id . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                $output .= '</div>';    
            }
            
            $output .= '</div></div>';

            $output .= '<script>
                            $(document).ready(function(){
                                $("#yt-video-slider").bxSlider({
                                    auto: true,
                                    pause: ' . $interval . ',
                                    autoStart: true,
                                    touchEnabled: true,
                                    responsive: true
                                });
                            });
                        </script>';
        }
    }

    return $output;
});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map([
    "name" => __("Слайдер видео из ютуба", "themeum"),
    "base" => "themeum_yt_video_slider",
    'icon' => 'icon-thm-latest-match',
    "description" => __("Слайдер видео из ютуба", "themeum"),
    "category" => __('Themeum', "themeum"),
    "params" => [
            [
                "type" => "textarea",
                "heading" => __("ID видео из ютуб", "themeum"),
                "param_name" => "video_ids_str",
                "description" => __('Введите список ID видео из ютуб рзделяя их точкой с запятой (;)'),
            ],
            [
                "type" => "textfield",
                "heading" => __("Интервал смены слайдов, сек", "themeum"),
                "param_name" => "interval",
            ]
        ]
    ]);
}

