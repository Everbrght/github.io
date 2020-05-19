<?php
/**
 * The Template for displaying all single projects.
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
    <?php the_title(); ?>
  </h1>
      <div class="entry">
        <?php the_content(); ?>
        <?php kimbo_post_nav(); ?>
      </div>
    </div>
    <?php endwhile; // end of the loop. ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
