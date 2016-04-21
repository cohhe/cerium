<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */

if ( !is_active_sidebar( 'cerium-sidebar-3' ) ) {
	return;
}
?>

<div id="supplementary">
	<div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
		<div class="footer-column-1 col-sm-4 col-md-4 col-lg-4"><?php dynamic_sidebar( 'cerium-sidebar-3' ); ?></div>
		<div class="footer-column-2 col-sm-4 col-md-4 col-lg-4"><?php dynamic_sidebar( 'cerium-sidebar-4' ); ?></div>
		<div class="footer-column-3 col-sm-4 col-md-4 col-lg-4"><?php dynamic_sidebar( 'cerium-sidebar-5' ); ?></div>
		<div class="clearfix"></div>
	</div><!-- #footer-sidebar -->
</div><!-- #supplementary -->
