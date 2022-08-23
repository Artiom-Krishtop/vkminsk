<?php

add_action( 'wp_ajax_get_list_news', 'get_list_news_callback' );
add_action( 'wp_ajax_nopriv_get_list_news', 'get_list_news_callback' );

function get_list_news_callback(){
    if(isset($_REQUEST['category_id'])){
        $category_id = intval($_REQUEST['category_id']);

        if($category_id > 0 && shortcode_exists('themeum_news_list_preview')){
            echo do_shortcode('[themeum_news_list_preview category_id="' . $category_id . '"]'); 
            wp_die();
        }
    }

    wp_die('0');
}