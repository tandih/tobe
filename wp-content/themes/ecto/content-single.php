<?php
/**
 * @package Ecto
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php ecto_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ecto' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'ecto' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'ecto' ) . '</span>', $tags_list );
				} // endif $tags_list

				edit_post_link( __( 'Edit', 'ecto' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->

		<div class="entry-author">
			<?php
				// store author info
				$author_id = get_the_author_meta( 'ID' );
				$author_name = esc_html( get_the_author_meta( 'display_name' ) );
				$author_posts_url = esc_url( get_author_posts_url( $author_id ) );

				// display author avatar if enabled
				if ( get_option( 'show_avatars' ) ) {
					echo '<figure class="author-image">' . get_avatar( $author_id, 72 ) . '</figure>';
				}
			?>

			<h2 class="widget-title author vcard"><a class="url fn n" href="<?php echo $author_posts_url; ?>"><?php echo $author_name; ?></a></h2>
			<p><?php printf( __( 'Read <a href="%1$s" class="url fn n">more posts</a> by this author', 'ecto' ), $author_posts_url ); ?></p>
		</div><!-- .entry-author -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
