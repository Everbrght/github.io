<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package kimbo
 */
?>

<div id="footer">
<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
  <div id="bottomwidgets">
    <div id="bottominner">
      <?php dynamic_sidebar( 'sidebar-3' ); ?>
    </div>
  </div>
  <?php endif ?>
  <div id="copyinfo">
  &copy; <?php echo date_i18n(__('Y','kimbo')); ?>
    <?php bloginfo('name'); ?>
    . <a href="<?php echo esc_url( esc_html__( 'http://wordpress.org/', 'kimbo' ) ); ?>"> <?php printf( esc_html__( 'Powered by %s.', 'kimbo' ), 'WordPress' ); ?> </a> <?php printf( esc_html__( 'Theme by %1$s.', 'kimbo' ), '<a href="http://www.vivathemes.com/" rel="designer">Viva Themes</a>' ); ?>  </div></div>
</div>
</div>
<?php wp_footer(); ?>
<!--[if gt IE 9]><!-->
<script>
    new WOW().init();
</script>
<!--<![endif]-->
</body></html>