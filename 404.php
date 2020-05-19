<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Kimbo
 */

get_header(); ?>

<div id="greybar">
	<h1 class="entry-title">
        <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'kimbo' ); ?>
      </h1>
</div>   

<div id="contentwrapper">
  <div id="content">
    <?php get_search_form(); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
