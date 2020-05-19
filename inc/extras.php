<?php
/**
 * Extra functions for this theme.
 *
 * @package Kimbo
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function kimbo_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kimbo_page_menu_args' );

/**
* Defines new blog excerpt length and link text.
*/
function kimbo_new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'kimbo_new_excerpt_length');

function kimbo_new_excerpt_more($more) {
	global $post;
	return '<div class="belowpost"><a class="btnmore icon-arrow" href="'.esc_url(get_permalink($post->ID)) . '"><span>'. esc_html__('Read More', 'kimbo') .'</span></a></div>';
}
add_filter('excerpt_more', 'kimbo_new_excerpt_more');

add_filter( 'wp_trim_excerpt', 'kimbo_excerpt_metabox_more' );
function kimbo_excerpt_metabox_more( $excerpt ) {
	$output = $excerpt;
	
	if ( has_excerpt() ) {
		$output = sprintf( '%1$s <div class="belowpost"><a class="btnmore icon-arrow" href="'.esc_url(get_permalink()) . '"><span>'. esc_html__('Read More', 'kimbo') .'</span></a></div>',
			$excerpt,
			get_permalink()
		);
	}
	
	return $output;
}

/**
* Adds excerpt support for pages.
*/
add_post_type_support( 'page', 'excerpt');

/**
* Custom fields box to allow featuring posts and pages in the front page slideshow.
*/
function kimbo_custom_meta () {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'kimbo_meta',
			esc_html__( 'Custom Post Features', 'kimbo'  ),
			'kimbo_meta_callback',
			$screen, 'side', 'high'
		);
	}
}
add_action( 'add_meta_boxes', 'kimbo_custom_meta' );
function kimbo_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'kimbo_nonce' );
    $kimbo_stored_meta = get_post_meta( $post->ID );
    ?>
  <p> <span class="kimbo-row-title">
    <?php esc_html_e( 'Check the box below to feature post in the front page slider', 'kimbo' )?>
    </span>
  <div class="kimbo-row-content">
    <label for="_slider-checkbox">
      <input type="checkbox" name="_slider-checkbox" id="_slider-checkbox" value="yes" <?php if ( isset ( $kimbo_stored_meta['_slider-checkbox'] ) ) checked( $kimbo_stored_meta['_slider-checkbox'][0], 'yes' ); ?> />
    </label>
  </div>
  </p>
  <p> <span class="kimbo-row-title">
    <?php esc_html_e( 'Check the box to feature post in featured posts section', 'kimbo' ); ?>
    </span>
  <div class="kimbo-row-content">
    <label for="_services-checkbox">
      <input type="checkbox" name="_services-checkbox" id="_services-checkbox" value="yes" <?php if ( isset ( $kimbo_stored_meta['_services-checkbox'] ) ) checked( $kimbo_stored_meta['_services-checkbox'][0], 'yes' ); ?> />
    </label>
  </div>
  </p>
  <p>
    <input type="hidden" name="my_hidden_flag" value="true" />
  </p>
  <?php
}
function kimbo_meta_save( $post_id ) {
	if (isset($_POST['my_hidden_flag'])) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'kimbo_nonce' ] ) && wp_verify_nonce( $_POST[ 'kimbo_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ '_slider-checkbox' ] ) ) {
    update_post_meta( $post_id, '_slider-checkbox', 'yes' );
} else {
    delete_post_meta( $post_id, '_slider-checkbox', '' );
}
if( isset( $_POST[ '_services-checkbox' ] ) ) {
    update_post_meta( $post_id, '_services-checkbox', 'yes' );
} else {
    delete_post_meta( $post_id, '_services-checkbox', '' );
}
}
}
add_action( 'save_post', 'kimbo_meta_save' );

/**
* Creates Portfolio post type.
*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'project',
		array(
			'labels' => array(
				'name' => esc_html__( 'Portfolio', 'kimbo' ),
				'singular_name' => esc_html__( 'Portfolio', 'kimbo' )
			),
		'public' => true,
		'has_archive' => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		)
	);
}

/**
* Manages display of archive titles.
*/
function kimbo_get_the_archive_title( $title ) {
   if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format','kimbo' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format','kimbo' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format','kimbo' ) );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = esc_html__( 'Archives', 'kimbo' );
    }
    return $title;
};
add_filter( 'get_the_archive_title', 'kimbo_get_the_archive_title', 10, 1 );

add_theme_support( 'html5', array( 'gallery', 'caption' ) );

add_filter('widget_text', 'do_shortcode');

