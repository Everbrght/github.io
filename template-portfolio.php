<?php
/**
 * Template Name: Portfolio
 *
 * @package Kimbo
 */

get_header(); ?>

<div id="greybar">
	<h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
</div>

<div id="contentwrapper">
  <div id="portfoliowrapper">
    <?php
		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
   				$args = array(
   							'posts_per_page' => -1,
							'paged'          => $paged,
							'post_type' => 'project',
	  						'post__not_in' => get_option( 'sticky_posts' ),
   							);
  				$portfolio_entries = new WP_Query($args);
			?>
    <?php if($portfolio_entries->have_posts()) : ?>
    <?php while($portfolio_entries->have_posts()) : $portfolio_entries->the_post() ?>
    <?php get_template_part( 'content', 'project' );  ?>
    <?php endwhile ?>
    <?php if (function_exists("kimbo_pagination")) { kimbo_pagination($portfolio_entries->max_num_pages); } ?>
    <?php wp_reset_postdata(); ?>
    <?php endif ?>
  </div>
</div>
<?php get_footer(); ?>
