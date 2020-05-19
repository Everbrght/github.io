<?php
/**
 * Themes functions and definitions
 *
 * @package Kimbo
 */
function kimbo_setup() {
	global $content_width;
		if ( ! isset( $content_width ) ){
      		$content_width = 1000;
		}
	load_theme_textdomain( 'kimbo', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo');
	add_theme_support( 'customize-selective-refresh-widgets' );
	register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'kimbo' ),
			'social' 	=> esc_html__( 'Social', 'kimbo' )
		) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('kimbo-blogthumb', 900, 450, true);
	add_image_size('kimbo-servicesthumb', 250, 250, true);
	add_image_size('kimbo-portothumb', 700, 9999);
	add_image_size('kimbo-slideimage', 1200, 400, true);
}
add_action( 'after_setup_theme', 'kimbo_setup' );

function kimbo_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Right Sidebar', 'kimbo' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widgets">',
      	'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Front Page Widget', 'kimbo' ),
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widgets">',
      	'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h2>',
		'after_title' => '</h2></div>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Bottom Widgets', 'kimbo' ),
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widgets">',
      	'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'kimbo_widgets_init' );

/**
 * Register Open Sans Google fonts for Kimbo.
 *
 * @return string
 */
function kimbo_open_sans_font_url() {
	$open_sans_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'kimbo' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'kimbo' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$query_args = array(
			'family' => urlencode( 'Open Sans:300,400,600,700,800' ),
			'subset' => urlencode( $subsets ),
		);

		$open_sans_font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $open_sans_font_url;
}


function kimbo_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if (!is_admin()) {
		wp_enqueue_script( 'kimbo-mobile-menu', get_template_directory_uri() . '/js/reaktion.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'kimbo-menu', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '', true );

		if(is_front_page()){
			wp_enqueue_script( 'kimbo-slidemobile-script', get_template_directory_uri() . '/js/jquery.mobile.customized.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'kimbo-jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'kimbo-camera-script', get_template_directory_uri() . '/js/camera.js', array( 'jquery' ), '', true );
		}

		if( is_page_template('template-portfolio.php') || is_front_page()) {
			wp_enqueue_script( 'kimbo-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery','masonry'), '', true );
			wp_enqueue_script( 'kimbo-custom-scripts', get_template_directory_uri() . '/js/customscripts.js', array( 'jquery' ), '', true );
		}
		
		wp_enqueue_script( 'kimbo-animations-script', get_template_directory_uri() . '/js/wow.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'kimbo-responsive-videos', get_template_directory_uri() . '/js/responsive-videos.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'kimbo-open-sans', kimbo_open_sans_font_url(), array(), null );
		wp_enqueue_style('kimbo-animations-css', get_template_directory_uri().'/animate.css', array(), '1', 'screen'); 
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
		wp_enqueue_style( 'kimbo-style', get_stylesheet_uri());
}
}
add_action( 'wp_enqueue_scripts', 'kimbo_scripts_styles' );

/**
 * Automatic Child theme creation.
 */
require_once( trailingslashit( get_template_directory() ) . 'use-child-theme.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';