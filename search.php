<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Kimbo
 */

get_header(); ?>
	<div id="greybar">
		<h1 class="entry-title">
			<?php printf( esc_html__( 'Search Results for: %s', 'kimbo' ), '<span>' . get_search_query() . '</span>' ); ?>
    	</h1>
   	</div>
<div id="contentwrapper">
  <div id="content">
    
    <?php if (have_posts()) : ?>
    <?php
				while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
				endwhile;
				?>
    <?php if (function_exists("kimbo_pagination")) { kimbo_pagination($post->max_num_pages); } ?>
    <?php else : ?>
    <h2 class="center">
      <?php esc_html_e( 'No Post Found', 'kimbo' ); ?>
    </h2>
    <?php get_search_form(); ?>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
