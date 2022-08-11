<?php
/**
 * Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
 * чтобы она не тормозила, когда долго не заходил и зашел...
 * Все проверки будут происходить незаметно через крон или при заходе на страницу: "Консоль > Обновления".
 *
 * @see https://wp-kama.ru/filecode/wp-includes/update.php
 * @author Kama (https://wp-kama.ru)
 * @version 1.1
 */
if( is_admin() ){
	// отключим проверку обновлений при любом заходе в админку...
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );

	// оставим принудительную проверку при заходе на страницу обновлений...
	//remove_action( 'load-update-core.php', 'wp_update_plugins' );
	//remove_action( 'load-update-core.php', 'wp_update_themes' );

	// внутренняя страница админки "Update/Install Plugin" или "Update/Install Theme" - оставим не мешает...
	//remove_action( 'load-update.php', 'wp_update_plugins' );
	//remove_action( 'load-update.php', 'wp_update_themes' );

	// событие крона не трогаем, через него будет проверяться наличие обновлений - тут все отлично!
	//remove_action( 'wp_version_check', 'wp_version_check' );
	//remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	//remove_action( 'wp_update_themes', 'wp_update_themes' );

	/**
	 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * эта проверка происходит раз в неделю...
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_empty_array' );
}

define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));
define('THMCSS', get_template_directory_uri().'/css/');
define('THMJS', get_template_directory_uri().'/js/');

function dd($text){
	echo '<pre>' . print_r($text, 1) . '</pre>';
	die();
}

if((!class_exists('RWMB_Loader'))&&(!defined('RWMB_VER'))){
// Include the meta box script
require_once (get_template_directory().'/lib/meta-box/meta-box.php');
}
require_once (get_template_directory().'/lib/metabox.php');

/*-------------------------------------------------------
*			Custom Widgets and VC shortocde Include
*-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/widgets/image_widget.php');
require_once( get_template_directory()  . '/lib/widgets/blog-posts.php');
require_once( get_template_directory()  . '/lib/widgets/popular-news.php');
require_once( get_template_directory()  . '/lib/widgets/follow_us_widget.php');

require_once( get_template_directory()  . '/lib/vc-addons/fontawesome-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-heading.php');
require_once( get_template_directory()  . '/lib/vc-addons/shortcode-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-highlight.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-video-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-popular-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-latest-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-gallery.php');
require_once( get_template_directory()  . '/lib/vc-addons/twitter.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-breaking-news.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-latest-match.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-social-button.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-heading-black.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-featured.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-smart-link.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-feature-items.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-post-slider.php');
require_once( get_template_directory()  . '/lib/vc-addons/wc-latest-products.php');

require_once( get_template_directory()  . '/lib/vc-addons/themeum-news-list-nav.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-news-list-preview.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-club-list.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-statistic-games.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-results-games.php');
require_once( get_template_directory()  . '/lib/vc-addons/themium-calendar-games.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-birthday-block.php');

/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $themeum_options; 

if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/admin/framework.php' );
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

/*-------------------------------------------------------
 *				Login and Register
 *-------------------------------------------------------*/
require get_template_directory() . '/lib/registration.php';


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => 'Primary Menu',
	'secondary_nav' => 'Secondary Navigation'
) );


/*-------------------------------------------*
 *				woocommerce support
 *------------------------------------------*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/*-------------------------------------------*
 *				title tag
 *------------------------------------------*/
add_theme_support( 'title-tag' );
add_theme_support( 'post-formats', array( 'link', 'quote' ) );
/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );



/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/wpsoccer-register.php');


/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');

/*--------------------------------------------------------------
 * 					AJAX login System
 *-------------------------------------------------------------*/	
require_once( get_template_directory()  . '/lib/main-function/ajax-login.php');


/*--------------------------------------------------------------
 * 	Theme Activation Hook (create login and registration page)
 *-------------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/login-registration.php');


/*--------------------------------------------------------------
 * 	Theme Activation Hook (Dynamic Widget)
 *-------------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/dynamic-widget.php');

 function activate_plugin_wc() {
    $active_plugins = get_option( 'active_plugins' );
    array_push($active_plugins, 'advanced-custom-fields-pro/acf.php'); /* Here just replace  plugin directory and plugin file*/
    update_option( 'active_plugins', $active_plugins );    
}
add_action( 'init', 'activate_plugin_wc' );
add_action( 'admin_init', 'true_plugins_activate', 10 );

//Gallery Shortcode
add_filter('post_gallery', 'themeum_post_gallery', 10, 2);
function themeum_post_gallery($output, $attr) {
	global $post;

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
		), $attr));

	$id = intval($id);
	if ('RAND' == $order) $orderby = 'none';
	if (!empty($include)) {
		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if (empty($attachments)) return '';

	$output = '<div class="themeum-gallery">';
	$output .= '<div id="postSlider" class="gallery-controll flexslider">';
	$output .= '<ul class="slides">';

	foreach ($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'blog-full');
		$output .= '<li class="all-slides">';
		$output .= '<img src="'.esc_url($img[0]).'" alt="'.__('image','themeum').'" />';
		$output .= '</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';

    //Controllers
	$output .= '<div id="flexCarousel" class="gallery-controll-thumb flexslider">';
	$output .= '<ul class="slides gallery-thumb-image">';

	foreach ($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'blog-thumb');
		$output .= '<li>';
		$output .= '<img class="img-responsive" src="'. esc_url($img[0]) .'" alt="'.__('image','themeum').'" />';
		$output .= '</li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	

	return $output;
}

# Shop Page Column Set
function loop_columns() {
return 3; 
}
function dateToRussian($date) {
    $month = array("jan"=>"янв","feb"=>"фев","mar"=>"март","apr"=>"апр","may"=>"май","jun"=>"июн","jul"=>"июл","aug"=>"авг","sep"=>"сен","oct"=>"окт","nov"=>"ноя","dec"=>"дек","january"=>"января", "february"=>"февраля", "march"=>"марта", "april"=>"апреля", "may"=>"мая", "june"=>"июня", "july"=>"июля", "august"=>"августа", "september"=>"сентября", "october"=>"октября", "november"=>"ноября", "december"=>"декабря");
    $days = array("monday"=>"Понедельник", "tuesday"=>"Вторник", "wednesday"=>"Среда", "thursday"=>"Четверг", "friday"=>"Пятница", "saturday"=>"Суббота", "sunday"=>"Воскресенье");
    return str_replace(array_merge(array_keys($month), array_keys($days)), array_merge($month, $days), strtolower($date));
}
add_filter('loop_shop_columns', 'loop_columns');


/**
 * Копируете весь нижеприведённый ниже код и вставляете его в конец файла functions.php вашей темы в WordPress
 * Примеры использования:
 *
 * Пример 1: Выводим указанные страницы по ID:
 * [pages include="1272,1274,1276,1280"]
 *
 * Пример 2: Тоже самое, но с присвоенным стилем CSS для контейнера:
 * [pages include="1274,1276,1268,1278,1280,1266" css_class="red"]
 *
 * Пример 3: Вывод дочерних записей другой страницы:
 * [pages parent=2]
 * 
 * Пример 4: Выводим дочерние записи и родительскую на любой странице
 * [pages include="1274,1276,1268,1278,1280,1266" parent=2 show_parent=1]
 */

/**
 * Функция создаёт обработку шорткода [pages]
 * Допустимые параметры:
 * parent - ID родительской страницы. Если пусто - берётся текущая страница
 * include - ID страниц через запятую, которые будут выводится списком
 * css_class - название дополнительного стиля в CSS для блока UL
 * show_parent - выводить родительский пункт в меню или нет
 * @param array $atts Параметры шорткода, передаются автоматически
 * @return string
 */
function gruz0_show_pages( $atts ) {
    // Если есть активный плагин Exclude Pages,
    // Отключим его на время работы шорткода.
    // Если не отключить - некоторые страницы не будут обработаны.
    if ( is_exclude_pages_exists() ) toggle_exclude_pages( 'off' );

    global $post;

    $current_page = 0;

    // Обрабатываем запросы только на страницах
    if ( $post->post_type == 'page' ) {
        $current_page = get_page( $post->ID );
    } else if ( $post->post_type == 'post' ) {
        $current_page = get_post( $post->ID );
    }

    // Извлекаем параметры из шорткода
    extract( shortcode_atts( array( 
        'parent' => $post->ID,
        'include' => array(),
        'css_class' => '',
        'show_parent' => 0
        ), $atts )
    );

    if ( !is_array( $include ) ) {
        $include = split( ',', $include );
    }

    // Формируем фильтры для получения списка страниц
    $args = array(
        'child_of' => $parent,
        'parent' => $parent,
        'post_type' => 'page',
        'post_status' => 'publish',
        'sort_order' => 'ASC',
        'sort_column' => 'menu_order'
    );

    // Получаем список дочерних страниц
    $pages = get_pages( $args );

    // Если пусто - выходим
    if ( !$pages ) return '';
    if ( count( $pages ) == 0 ) return '';

    // Если задан класс CSS - подключаем его
    if ( !empty( $css_class ) ) $css_class .= ' ';

    $content = '<ul class="'.$css_class.'subpages">';

    // Если стоит признак отображения родительской категории, то выводим её первой в списке
    if ( $show_parent ) {
        $parent_link = get_page_link( $parent );
        $parent_page = get_page( $parent );
        if ( $parent_page != null ) {
            $content .= '<li><a href="'.$parent_link.'">'.$parent_page->post_title.'</a></li>';
        }
    }

    // Пошёл перебор страниц и вывод в браузер
    foreach( $pages as $page ) {
        if ( in_array( $page->ID, $include ) || count( $include ) == 0 ) {
            $page_link = get_page_link( $page->ID );
            $content .= '<li'.( $page->ID == $current_page->ID ? ' class="active"' : '' ).'><a href="'.$page_link.'">'.$page->post_title.'</a></li>';
        }
    }
    $content .= '</ul>';

    // Восстанавливаем работу плагина Exclude Pages
    if ( is_exclude_pages_exists() ) toggle_exclude_pages( 'on' );

    return $content;
}

/**
 * Проверяет на существование плагин Exclude Pages
 * return boolean
 */
function is_exclude_pages_exists() {
    return function_exists( 'ep_init' );
}

/**
 * Отключает или включает фильтры плагина Exclude Pages
 * Без этой функции скрытые в меню страницы не будут отображены шорткодом [pages]
 * @param string $state Состояние: on или off
 */
function toggle_exclude_pages( $state ) {
    switch( $state ) {
        case 'on':
            add_filter( 'get_pages', 'ep_exclude_pages' );
            break;
        case 'off':
            remove_filter( 'get_pages', 'ep_exclude_pages' );
            break;
    }
}
add_shortcode( 'pages', 'gruz0_show_pages' ); 

function wph_add_all_elements($init) {
    if(current_user_can('unfiltered_html')) {
        $init['extended_valid_elements'] = 'span[*]';
    }
    return $init;
}
add_filter('tiny_mce_before_init', 'wph_add_all_elements', 20);



add_filter( 'upload_size_limit', 'PBP_increase_upload' );
 function PBP_increase_upload( $bytes )
 {
 return 20480000; // 20 megabyte
 }
 
 
 add_action('schedule_event', 'filter_cron_events');
function filter_cron_events($event) {
	switch( $event->hook ) {
		case 'wp_version_check': // Проверяет версию WordPress.
		case 'wp_update_plugins': // Проверяет версии плагинов.
		case 'wp_update_themes': // Проверяет версии тем.
		case 'wp_maybe_auto_update': // Выполняет автоматические обновления WordPress.
			$event = false;
			break;
	}
	return $event;
}
 
 