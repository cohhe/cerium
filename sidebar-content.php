<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */

if ( ( LONGFORM_LAYOUT == 'sidebar-right' || LONGFORM_LAYOUT == 'sidebar-left' ) && is_active_sidebar( 'cerium-sidebar-2' ) ) {
?>
<div id="content-sidebar" class="content-sidebar widget-area col-sm-3 col-md-3 col-lg-3" role="complementary">
	<?php dynamic_sidebar( 'cerium-sidebar-2' ); ?>
</div><!-- #content-sidebar -->
<?php
}