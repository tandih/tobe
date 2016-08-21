<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Ecto
 */

/**
 * Check if a post has a post thumbnail.
 * @uses has_post_thumbnail()
 */
function ecto_check_featured_image() {
	if ( is_singular() && has_post_thumbnail( get_the_ID() ) ) {
		return true;
	}

	return false;
}
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ecto_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_front_page() ) {
		if ( get_header_image() || ( is_singular() && ecto_check_featured_image() == true ) ) {
			$classes[] = 'has-header-image';
			$classes[] = 'has-header-image-home';
		}
	} elseif ( get_header_image() || ( is_singular() && ecto_check_featured_image() == true ) ) {
		$classes[] = 'has-header-image';
	}

	return $classes;
}
add_filter( 'body_class', 'ecto_body_classes' );

/**
 * Adds featured image as background of site header for single posts/pages if one is set
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ecto_featured_image_header_css() {
	if ( is_singular() && ecto_check_featured_image() == true ) {
		$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'ecto-banner' );
		$banner = $banner_src[0]; ?>
		<style type="text/css">
			.site-header {
				background-image: url(<?php echo esc_url( $banner ); ?>);
				background-position: center center;
				-webkit-background-size: cover;
				background-size: cover;
			}
		</style>
	<?php }
}
add_action( 'wp_enqueue_scripts', 'ecto_featured_image_header_css' );


if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function ecto_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'ecto' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'ecto_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function ecto_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'ecto_render_title' );
endif;
