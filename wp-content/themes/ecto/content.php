<?php
/**
 * @package Ecto
 */

$format = get_post_format();
$formats = get_theme_support( 'post-formats' );
if ( 'image' == $format || 'video' == $format ) {
	$content = apply_filters( 'the_content', get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ecto' ) ) );
} else {
	$content = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			if ( 'image' == $format && has_post_thumbnail() ) { ?>
				<figure class="entry-thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
				</figure>
		<?php
			} else {
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ecto' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			} // endif 'image' == $format && has_post_thumbnail()
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ecto' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php ecto_entry_footer_archive(); ?>
		</div><!-- .entry-meta -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
