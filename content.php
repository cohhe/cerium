<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Cerium
 * @since Cerium 1.0
 */

global $cerium_article_width;
if ( !is_single() ) {
	$post_class = 'not-single-post';
	$header_class = 'simple';
} else {
	$post_class = 'single-post';
	$header_class = '';
}

$tc = wp_count_comments( get_the_ID() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($cerium_article_width.$post_class); ?>>
	<header class="entry-header <?php echo esc_attr($header_class); ?>">
		<?php
			if ( !is_single() && ( is_home() || is_archive() || is_search() ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'cerium-medium-thumbnail' );
				$image_background = '';
				if ( !empty($img['0']) ) {
					$image_background = ' style="background: url('.esc_url($img['0']).') no-repeat;"';
				}
				echo '
				<div class="single-image-container"'.$image_background.'></div>';
				echo '</header><!-- .entry-header -->';
			} elseif ( is_single() && !is_home() ) {
				echo '</header><!-- .entry-header -->';
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'cerium-full-width' );
				echo '<div class="single-post-image-container">';
				if ( !empty($img) ) {
					echo '<img src="'.esc_url($img['0']).'" class="single-post-image" alt="'.esc_html__('Post with image', 'cerium').'">';
				}
				echo '<div class="single-post-meta">';
					cerium_posted_on();
					echo '<span class="single-post-date icon-clock">'.get_the_time('F d, Y',get_the_ID()).'</span>';
					cerium_comment_count(get_the_ID());
					cerium_category_list();
					if( function_exists('the_views') ) {
						echo '<span class="single-post-views icon-eye">'.do_shortcode('[views]').'</span>';
					}
					echo cerium_like_button();
				echo '</div>';
				echo '</div>';
			}
		?>
	

	<?php if ( is_search() || is_home() || is_archive() ) : ?>
	<div class="article-side-meta">
		<span class="article-date1"><?php echo get_the_time('d',get_the_ID()); ?></span>
		<span class="article-date2"><?php echo get_the_time('F',get_the_ID()); ?></span>
	</div>
	<div class="post-side-content">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		<div class="article-lower-meta">
			<?php echo esc_html__('By', 'cerium') . ' <a href="'.get_author_posts_url(get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' )).'" class="bussines-latest-news-author-name">'.get_the_author_meta( 'display_name' ).'</a> | ' . $tc->approved . ' ' . esc_html__('comments', 'cerium') . '</div>'; ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
	<div class="clearfix"></div>
	<?php else : ?>
	<div class="entry-content">
		<div id="entry-content-wrapper">
			<?php the_content( esc_html__( 'Continue reading', 'cerium' ).' '.'<span class="meta-nav">&rarr;</span>' ); ?>
			<div class="single-post-bottom-meta">
			<?php
				cerium_tag_list();
				if ( function_exists('cerium_share_icons') ) { cerium_share_icons() };
			?>
				<div class="clearfix"></div>
			</div>
			<div class="single-post-prev-next">
				<?php cerium_prev_next_links(); ?>
			</div>
		</div>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cerium' ) . '</span>',
				'after'       => '<div class="clearfix"></div></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article>