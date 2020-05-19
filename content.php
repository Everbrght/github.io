<?php
/**
 * The template for displaying posts on index view
 *
 * @package Kimbo
 */
?>

<div <?php post_class(); ?>>
  <?php the_post_thumbnail('kimbo-blogthumb', array( 'class'	=> "wow pulse attachment-kimbo-blogthumb")); ?>
  <h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark">
    <?php the_title(); ?>
    </a></h2>
  <div class="postdate"> <?php echo get_the_date(); ?> </div>
  <div class="entry">
    <?php the_excerpt(); ?>
  </div>
</div>
