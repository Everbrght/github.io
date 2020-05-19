<?php
/**
 * Custom template tags for this theme.
 *
 * @package Kimbo
 */

if ( ! function_exists( 'kimbo_post_nav' ) ) :
function kimbo_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
  <nav class="navigation post-navigation" role="navigation">
    <div class="nav-links">
      <?php
				previous_post_link( '<div class="nav-previous">%link</div>', '' );
				next_post_link( '<div class="nav-next">%link</div>', '' );
			?>
    </div>
    <!-- .nav-links --> 
  </nav>
  <!-- .navigation -->
  <?php
}
endif;

function kimbo_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($pages))."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}