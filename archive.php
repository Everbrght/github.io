<?php
/**
 * The template for displaying Archive pages.
 *
 *
 * @package Kimbo
 */

get_header(); ?>
<div id="greybar">
 	<?php the_archive_title( '<h1 class="entry-title cat-title"><span>', '</span></h1>' );?>
</div>
<div id="contentwrapper">
  <div id="content">
   <?php the_archive_description( '<div class="taxonomy-description">', '</div>' );?>
    <?php if (have_posts()) : ?>
    <?php
				while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
				endwhile;
				?>
    <?php if (function_exists("kimbo_pagination")) { kimbo_pagination($post->max_num_pages); } ?>
    <?php else : ?>
    <h2 class="center">
      <?php esc_html_e( 'Not Found', 'kimbo' ); ?>
    </h2>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
