<?php
add_shortcode( 'themeum_news_list_preview', function($atts, $content = null) {

    extract(shortcode_atts([
        'category_id' => '',
        'sortby' => 'date',
        'order' => 'DESC',
        'desc_length' => 50,
        'navsortby'	=> 'slug',
        'navorder' => 'DESC',
    ], $atts));

    $output = '<div class="b-news-custom-nav-wrapper">';
    $allNewsCategoryId = 111;

    $allNews = get_categories([
        'include' => [$allNewsCategoryId]
    ]);

    $childNews = get_categories([
        'parent' => $allNewsCategoryId,
        'hide_empty' => 0,
        'numberposts' => 1,
        'sortby' => esc_attr($navsortby),
        'order' => esc_attr($navorder)
    ]);

    $news = array_merge($allNews, $childNews);

    if (!empty($news)) {
        
        $output .= '<ul class="b-news-custom-nav" id="news-custom-nav">';

        foreach ($news as $item) {
            $active = '';

            if((empty($category_id) && $item->cat_ID == $allNewsCategoryId) || ($item->cat_ID == $category_id)){
                $active = ' active';
            }

            $output .= '<li class="b-news-custom-nav__item js-news-custom-nav__item" data-category-id="' . $item->cat_ID . '"><span class="b-news-custom-nav__link' . $active . '">'. $item->name .'</span></li>';
        }

        $output .= '</ul>';
    }

    $args = [];

    if($category_id != ''){
        $args['category'] = intval($category_id);
    }
    $args['orderby'] = $sortby;
    $args['order'] = $order;
    
    $posts = get_posts($args);

    if(empty($posts)){
        $output .= '<div class="b-news-custom-nav-empty">Новости для данной категории отсутствуют</div>';
        $output .= '</div>';

        return $output;
    }

    $output .= '<div class="themeum-preview-container">';
    $output .= '<div class="themeum-preview-thumb left-column">';
    
    $firstPost = array_shift($posts);

    $categoryName = getCategoryName($firstPost->ID);

    $output .= '<div class="themeum-preview-thumb-item">';
    $output .= '<div class="themeum-preview-thumb-item__image">';
    $output .= '<a href="'. get_permalink($firstPost->ID) .'" >';

    if(has_post_thumbnail($firstPost->ID)){
        $output .= get_the_post_thumbnail($firstPost->ID);
    }else{
        $output .= '<img class="no-photo" src="/wp-content/themes/wpsoccer/images/logo-footer@2x.png">';
    }
    
    $output .= '</a></div>';
    $output .= '<div class="themeum-preview-thumb-item__description">';
    $output .= '<span class="thumb-description-section">' . $categoryName . '</span>';
    $output .= '<a href="'. get_permalink($firstPost->ID) .'" ><h4 class="thumb-description-header">' . $firstPost->post_title . '</h4></a>';
    $output .= '<span class="thumb-description-data">' . get_the_date('d F Y', $firstPost->ID) . '</span></div></div>';
    $output .= '</div>';
    $output .= '<div class="themeum-preview-thumb right-column">';

    foreach ($posts as $post) {
        $newsTitle = strlen($post->post_title) >= $desc_length ? mb_substr($post->post_title, 0, $desc_length) . '...' : $post->post_title;

        $categoryName = getCategoryName($post->ID);

        $output .= '<div class="themeum-preview-thumb-item">';
        $output .= '<div class="themeum-preview-thumb-item__image">';
        $output .= '<a href="'. get_permalink($post->ID) .'" >';

        if(has_post_thumbnail($post->ID)){
            $output .= get_the_post_thumbnail($post->ID, [460, 500], array('class' => 'img-responsive'));
        }else{
            $output .= '<img class="no-photo" src="/wp-content/themes/wpsoccer/images/logo-footer@2x.png" width="200" height="200">';
        }

        $output .= '</a></div>';
        $output .= '<div class="themeum-preview-thumb-item__description">';
        $output .= '<span class="thumb-description-section">' . $categoryName . '</span>';
        $output .= '<a href="'. get_permalink($post->ID) .'" ><h5 class="thumb-description-header">' . $newsTitle . '</h5></a>';
        $output .= '<span class="thumb-description-data">' . get_the_date('d F Y', $post->ID) . '</span></div></div>';
    }

    $output .= '</div></div></div>';

    return $output;
});

function themeum_cat_id_list(){
	$cat_lists = get_categories();
	$all_cat_list = array('All Category'=>'');
	foreach($cat_lists as $cat_list){
		$all_cat_list[$cat_list->cat_name] = $cat_list->term_id;
	}
	return $all_cat_list;
}

function getCategoryName($postId){
    $category = get_the_category($postId);

    if(empty($category)){
        $categoryName = 'Новости';
    }else{
        $categoryName = $category[0]->name;
    }

    return $categoryName;
}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {

vc_map([
"name" => __("Custom News List Preview", "themeum"),
"base" => "themeum_news_list_preview",
'icon' => 'icon-thm-latest-match',
"description" => __("News List Preview", "themeum"),
"category" => __('Themeum', "themeum"),
"params" => [
    [
        "type" => "dropdown",
        "heading" => __("Навигация. Сортировать по:", "themeum"),
        "param_name" => "navsortby",
        "value" => ['Ярлык' => 'slug', 'Название' => 'name'],
    ],
    [
        "type" => "dropdown",
        "heading" => __("Направление сортировки:", "themeum"),
        "param_name" => "navorder",
        "value" => ['Навигация. По возрастанию' => 'ASC', 'По убыванию' => 'DESC'],
    ],
    [
        "type" => "dropdown",
        "heading" => __("Сортировать по:", "themeum"),
        "param_name" => "sortby",
        "value" => ['Дата публикации' => 'date', 'Название' => 'name'],
    ],
    [
        "type" => "dropdown",
        "heading" => __("Направление сортировки:", "themeum"),
        "param_name" => "order",
        "value" => ['По возрастанию' => 'ASC', 'По убыванию' => 'DESC'],
    ],
    [
        "type" => "textfield",
        "heading" => __("Длина заголовка новости", "themeum"),
        "param_name" => "desc_length",
        "value" => "",
    ],	
]
]);
}