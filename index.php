<?php
/**
 * The main template file.
 *
 *
 * @package Kimbo
 */

get_header(); ?>
<div id="greybar">
<?php if( is_home() && get_option('page_for_posts') ) {
			$blog_page_id = get_option('page_for_posts');
			echo '<h1 class="entry-title"><span>'.get_page($blog_page_id)->post_title.'</span></h1>';
		}
	?>
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
    <p class="center">
      <?php esc_html_e( 'You don&#39;t have any posts yet.', 'kimbo' ); ?>
    </p>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
