<?php
add_shortcode( 'themeum_club_list', function($atts, $content = null) {

    extract(shortcode_atts(array(
        'additional_link' => ''
		), $atts));


    $posts = get_posts([
        'post_type'   => 'club',
        'meta_key' => 'themeum_club_title_show_sort',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => 6,
        'meta_query' => [
                [
                    'key' => 'themeum_club_main_show',
                    'value' => true
                ]
            ] 
        ]);

    if(!empty($additional_link)){
        $additional_link = str_replace(' ', '', htmlspecialchars($additional_link));
        $additional_link = explode(';', $additional_link);

        $additionalPosts = get_posts([
            'post_type' => 'page',
            'orderby' => 'post__in',
            'order' => 'ASC',
            'posts_per_page' => count($additional_link),
            'include' => $additional_link
            ]);

        $posts = array_merge($posts, $additionalPosts);
    }

    $output = '<div class="themeum-club-list-container">';

    if(!empty($posts)){
        foreach ($posts as $post) {
            if($post->post_type == 'club'){
                $background = get_post_meta($post->ID, 'themeum_club_title_show_background')[0];
            }else{
                $background = get_field('background-color', $post->ID);
            }

            $output .= '<div class="themeum-cliub__item" style="background-color: ' . $background . '">';
            $output .= '<a href="'. get_permalink($post->ID) .'"></a>';
            $output .= '<div class="club-item__logo">';

            if(has_post_thumbnail($post->ID)){
                $output .= get_the_post_thumbnail($post->ID,'full', ['class' => 'club-item__logo-img']);
            }

            $output .= '</div>';

            $output .= '<div class="club-item__title">';
            $output .= '<span class="club-item__title-text">' . mb_strtoupper($post->post_title) . '</span>';
            $output .= '</div>';

            $output .= '</div>';
        }
    }

    $output .= '</div>';
    
    return $output;
});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
    vc_map([
        "name" => __("Club List", "themeum"),
        "base" => "themeum_club_list",
        'icon' => 'icon-thm-latest-match',
        "description" => __("Club List", "themeum"),
        "category" => __('Themeum', "themeum"),
        "params" => [
            [
                "type" => "textarea",
                "heading" => __("Дополнительные записи", "themeum"),
                "param_name" => "additional_link",
                "description" => __("Введите ID постов,разделяя их точкой с запятой (;)", "themeum" ),
                "value" => [],
            ]
        ]
    ]);
}