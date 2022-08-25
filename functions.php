<?php

/**
 ** activation theme
 **/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

//ajouter une nouvelle zone de menu à mon thème
function register_my_menu() {
    register_nav_menu('header-menu',__( 'Menu Header' ));
}
add_action( 'init', 'register_my_menu' );

function jquery_jquery_ui() {
    if (!is_admin()) {
        wp_deregister_script('jquery');

// Google API (CDN)
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', false, '1.10.1', true);
        wp_register_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array('jquery'), "1.10.3", true);

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');
    }
}
add_action('init', 'jquery_jquery_ui');

if ( function_exists('register_sidebar') )
    register_sidebar( array(
            'name'       => __( 'Menu header', 'virtue' ),
            'id'     => 'header-menu',
            'description'    => __( 'Add widgets here to appear above your menu burger.', 'virtue' ),
            'before_widget' => '<aside id="%1$s" class="newsL %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        )
    );

if ( function_exists('register_sidebar') )
    register_sidebar( array(
            'name'       => __( 'Menu mobile', 'virtue' ),
            'id'     => 'mobile-menu',
            'description'    => __( 'Add widgets here to appear above your menu burger.', 'virtue' ),
            'before_widget' => '<aside id="%1$s" class="newsL %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        )
    );

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Settings',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Slider Settings',
        'menu_title'	=> 'Slider',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Couleurs Settings',
        'menu_title'	=> 'Couleurs',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Abonnements Settings',
        'menu_title'	=> 'Abonnements',
        'parent_slug'	=> 'theme-general-settings',
    ));

}

add_action( 'after_setup_theme', 'chezjune_theme_setup' );
function chezjune_theme_setup() {
    add_image_size( 'custom-discipline', 380, 380, true );
    add_image_size( 'custom-logo-footer', 100, 100, true );
    add_image_size( 'custom-team', 300, 300, true );
    add_image_size( 'custom-video', 900, 520, true );
    add_image_size( 'custom-image-page', 1200, 474, true );
    add_image_size( 'custom-article', 380, 380, true );
}

function theme_js()
{
    wp_register_script('video',
        get_stylesheet_directory_uri() . '/js/video.js',
        array('jquery'), '1.0', true); // Custom scripts
    wp_enqueue_script('video'); // Enqueue it!

    wp_register_script('link-scroll',
        get_stylesheet_directory_uri() . '/js/link-scroll.js',
        array('jquery'),'1.0',true); // Custom scripts
    wp_enqueue_script('link-scroll'); // Enqueue it!

    wp_register_script('menu-mobile',
        get_stylesheet_directory_uri() . '/js/menu-mobile.js',
        array('jquery'),'1.0',true); // Custom scripts
    wp_enqueue_script('menu-mobile'); // Enqueue it!

    wp_register_style('responsive',
        get_template_directory_uri() . '/css/responsive.css',
        array(), '1.0', 'all');
    wp_enqueue_style('responsive'); // Enqueue it!

}

add_action('wp_enqueue_scripts', 'theme_js', 99);


function capitaine_assets()
{

    // ...

    // Charger notre script
    wp_enqueue_script('capitaine', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);

    // Envoyer une variable de PHP à JS proprement
    wp_localize_script('capitaine', 'ajaxurl', admin_url('admin-ajax.php'));

}

add_action('wp_enqueue_scripts', 'capitaine_assets');

function special_nav_class($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

//retire la mention "privé / protégé" des titres WordPress
add_filter('private_title_format', 'removePrivatePrefix');
add_filter('protected_title_format', 'removePrivatePrefix');
function removePrivatePrefix($format) {
    return '%s';
}

add_action('template_redirect', 'themespress_private_content_redirect_to_login', 9);
function themespress_private_content_redirect_to_login() {
    global $wp_query, $wpdb;
    if (is_404()) {
        $private = $wpdb->get_row($wp_query->request);
        $location = "http://localhost:8888/chezjune/login/";
        if( 'private' == $private->post_status  ) {
            wp_safe_redirect($location);
            exit;
        }
    }
}

function filter_projects() {
    $catSlug = $_POST['category'];

    $ajaxposts = new WP_Query([
        'post_type' => 'videos',
        'posts_per_page' => -1,
        'category_name' => $catSlug,
        'order' => 'desc',
    ]);
    $response = '';

    if($ajaxposts->have_posts()) {
        while($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $response .= get_template_part('loop-videos');
        endwhile;
    } else {
        $response = 'empty';
    }

    echo $response;
    exit;
}
add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');