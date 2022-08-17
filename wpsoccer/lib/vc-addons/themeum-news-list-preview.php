<?php
add_shortcode( 'themeum_news_list_preview', function($atts, $content = null) {

    extract(shortcode_atts([
        'category' => '',
        'sortby' => 'date',
        'order' => 'DESC',
        'desc_length' => 50
    ], $atts));


    $args = [];

    if($category != ''){
        $args['categoty'] = intval($category);
    }
    $args['orderby'] = $sortby;
    $args['order'] = $order;
    
    $posts = get_posts($args);

    if(empty($posts)){
        return '<div>Новости отсутствуют</div>';
    }

    $output = '';
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

    $output .= '</div></div>';

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
        "heading" => __("Категория", "themeum"),
        "param_name" => 'category',
        "value" => themeum_cat_id_list(),
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