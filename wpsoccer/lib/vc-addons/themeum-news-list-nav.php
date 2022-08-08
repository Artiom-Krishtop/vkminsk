<?php 

add_shortcode( 'themeum_news_list_nav', function($atts, $content = null) {

    extract(shortcode_atts([
        'sortby'			=> 'slud',
		'order'				=> 'DESC',
    ], $atts));

    $allNews = get_categories([
        'include' => [111]
    ]);

    $childNews = get_categories([
        'parent' => 111,
        'hide_empty' => 0 ,
        'sortby' => esc_attr($sortby),
        'order' => esc_attr($order)
    ]);

    $news = array_merge($allNews, $childNews);

    if (!empty($news)) {

        $output = '<ul class="b-news-custom-nav">';

        foreach ($news as $item) {
            $output .= '<li class="b-news-custom-nav__item"><a href="' . get_category_link($item->cat_ID) . '" class="b-news-custom-nav__link">'. $item->name .'</a></li>';
        }

        $output .= '</ul>';
    }

    return $output;
});

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map([
    "name" => __("Custom News Nav", "themeum"),
    "base" => "themeum_news_list_nav",
    'icon' => 'icon-thm-latest-match',
    "description" => __("Custom News Navigation", "themeum"),
    "category" => __('Themeum', "themeum"),
    "params" => [

            [
                "type" => "dropdown",
                "heading" => __("Сортировать по:", "themeum"),
                "param_name" => "sortby",
                "value" => ['Ярлык' => 'slud', 'Название' => 'name'],
            ],
            [
                "type" => "dropdown",
                "heading" => __("Направление сортировки:", "themeum"),
                "param_name" => "order",
                "value" => ['По возрастанию' => 'ASC', 'По убыванию' => 'DESC'],
            ],	
        ]
    ]);
}