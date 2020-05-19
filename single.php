<?php
/**
 * The Template for displaying all single posts.
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
  <div id="content">
    <?php while ( have_posts() ) : the_post(); ?>
    <div <?php post_class(); ?>>
      <div class="entry">
        <?php the_content(); ?>
        <?php echo get_the_tag_list('<p class="singletags">',' ','</p>'); ?>
        <?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'kimbo' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php comments_template(); ?>
        <?php kimbo_post_nav(); ?>
      </div>
    </div>
    <?php endwhile; // end of the loop. ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
