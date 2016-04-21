<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */
?>
<?php if ( LONGFORM_LAYOUT == 'sidebar-left' && is_active_sidebar( 'cerium-sidebar-1' ) ) : ?>
	<div id="secondary" class="content-sidebar widget-area col-sm-4 col-md-4 col-lg-4">
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'cerium-sidebar-1' ); ?>
		</div><!-- #primary-sidebar -->
	</div><!-- #secondary -->
<?php endif; ?>