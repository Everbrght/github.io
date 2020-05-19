<?php
/**
 * The template for displaying all pages.
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
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
      <div class="entry">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'kimbo' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php comments_template(); ?>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
