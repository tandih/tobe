<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Ecto
 */
?>
	</div><!-- #content -->
	<div id="slide-menu" class="slide-menu">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<h2 class="widget-title slide-menu-title"><?php _e( 'Menu', 'ecto' ); ?></h2>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h2 class="widget-title screen-reader-text"><?php _e( 'Primary Navigation', 'ecto' ); ?></h2>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) || ( has_nav_menu( 'social' ) ) ) {
			get_sidebar();
		} ?>
	</div><!-- .slide-menu -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="blog-info">
				<a class="blog-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div><!-- .blog-info -->

			<div class="blog-credits">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'ecto' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'ecto' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'ecto' ), 'Ecto', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
			</div><!-- .blog-credits -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
