<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */
?>

		</div><!-- #main -->

		<div class="site-footer-wrapper">
			<?php
			$show_scroll_to_top = get_theme_mod('cerium_scrolltotop', false);

			if ( $show_scroll_to_top ) { ?>
				<a class="scroll-to-top" href="#"><?php _e( 'Up', 'cerium' ); ?></a>
			<?php } ?>
			<div class="site-footer-container">
				<footer id="colophon" class="site-footer" role="contentinfo">
					<?php get_sidebar( 'footer' ); ?>
				</footer><!-- #colophon -->
			</div>
			<div class="footer-bottom">
				<div class="footer-bottom-inner">
					<div class="copyright">&copy; 2016 <a href="https://cohhe.com" target="_blank">Cohhe Themes</a>. All rights reserved.</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>