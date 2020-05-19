<?php
/**
 * The Header for our theme.
 *
 *
 * @package Kimbo
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=2.0, user-scalable=yes" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="container">
		<div id="header">
			<div id="headerin">
  				<div id="logo">
  					<?php the_custom_logo(); ?>
        				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        					<h1 class="site-title">
          						<?php bloginfo( 'name' ); ?>
        					</h1>
        				</a>
                        
                        <h2 class="site-description">
          					<?php bloginfo( 'description' ); ?>
        				</h2>
               </div>
  
  				
    				<?php if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
					} ?>
 				
                	<?php if ( has_nav_menu( 'main-menu' ) ) {
    				wp_nav_menu( 
						array( 
							'theme_location' => 'main-menu', 
							'container_id'   => 'mainmenu',
							'menu_class' 	 => 'superfish mainnav',
							'after' 		 => '<span>&#47;</span>',
							'fallback_cb'	 => false
						)
					);
  					} ?>
                    
                    <?php if ( has_nav_menu( 'main-menu' ) ) {

					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'container_class'   => 'mmenu',
							'menu_class' 	 => 'navmenu',
							'fallback_cb'	 => false
					)
					);
  					} ?>
                    
			</div>
       </div>
<?php if (is_front_page()) : ?>
<?php
   				$args = array(
   							'posts_per_page' =>-1,
							'post_type' => 'any',
	  						'post__not_in' => get_option( 'sticky_posts' ),
      						'meta_query' => array(
         					array(
            					'key' => '_slider-checkbox',
            					'value' => 'yes'
         						)
      							)
   							);
  				$slider_posts = new WP_Query($args);
			?>
<div id="slidecontainer">
  <div class="camera_wrap" id="camera_wrap_1">
    <?php if($slider_posts->have_posts()) : ?>
    <?php while($slider_posts->have_posts()) : $slider_posts->the_post() ?>
    <div data-src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slideimage' ); ?><?php echo esc_url($image[0]); ?>" data-link="<?php if(get_post_meta($post->ID, 'slidelink', true)): ?>
									<?php echo esc_url(get_post_meta($post->ID, 'slidelink', true)); ?> 
        							<?php else : ?>
									<?php the_permalink(); ?>
                                    <?php endif; ?>">
      <div class="camera_effected">
        <h2>
          <?php if(get_post_meta($post->ID, 'slidetitle', true)): ?>
          <?php echo esc_html(get_post_meta($post->ID, 'slidetitle', true)); ?>
          <?php else : ?>
          <?php the_title(); ?>
          <?php endif; ?>
        </h2>
        <span class="slidearrow"></span> </div>
    </div>
    <?php endwhile ?>
    <?php wp_reset_postdata(); ?>
    <?php endif ?>
  </div>
</div>
<div class="frontwidget">
  <?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>
<?php
   				$args = array(
   							'posts_per_page' =>-1,
							'post_type' => 'any',
	  						'post__not_in' => get_option( 'sticky_posts' ),
      						'meta_query' => array(
         					array(
            					'key' => '_services-checkbox',
            					'value' => 'yes'
         						)
      							)
   							);
  				$services_posts = new WP_Query($args);
			?>
<div id="services">
  <div id="servicesinner">
    <?php if($services_posts->have_posts()) : ?>
    <?php while($services_posts->have_posts()) : $services_posts->the_post() ?>
    <div class="servicespost postwrapper"> <a href="<?php the_permalink() ?>">
      <?php the_post_thumbnail('kimbo-servicesthumb', array( 'class'	=> "wow rotateIn attachment-kimbo-servicesthumb")); ?>
      </a>
      <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></h2>
      <?php the_excerpt(); ?>
    </div>
    <?php endwhile ?>
    <?php wp_reset_postdata(); ?>
    <?php endif ?>
  </div>
</div>
<?php endif; ?>
