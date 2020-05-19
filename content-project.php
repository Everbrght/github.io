<?php
/**
 * The template for displaying Projects on index view
 *
 * @package Kimbo
 */
?>

<div class="portfolio-entry wow fadeInUpBig">
  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kimbo-portothumb'); ?></a>
    <h2 class="entry-title" >
      <?php the_title(); ?>
     </h2>
    <?php the_excerpt(); ?>
</div>
