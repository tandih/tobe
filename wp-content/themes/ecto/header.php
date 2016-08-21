<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Ecto
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ecto' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) || ( has_nav_menu( 'social' ) ) ) : ?>
			<div class="navbar">
				<div class="navbar-action">
					<a id="slide-menu-toggle" class="button menu-toggle slide-menu-toggle" href="#slide-menu">
						<?php if ( ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) && ! is_active_sidebar( 'sidebar-1' ) ) :
								_e( 'Menu', 'ecto' );
							elseif (  is_active_sidebar( 'sidebar-1' ) && ! ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) ) :
								_e( 'Widgets', 'ecto' );
							else :
								_e( 'Menu &amp; Widgets', 'ecto' );
							endif;
						?>
					</a>
				</div><!-- .navbar-action -->
			</div><!-- .navbar -->
		<?php endif; ?>

		<div class="site-branding">
			<div class="inner">
				<?php
					if ( function_exists( 'jetpack_the_site_logo' ) ) {
						jetpack_the_site_logo();
					}
				?>
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>
			</div><!-- /.inner -->
		</div><!-- .site-branding -->

		<?php
			if ( ( get_header_image() || ecto_check_featured_image() == true ) && is_front_page() ) {
				echo '<a class="scroll-down" href="#content"><span class="screen-reader-text">' . __( 'Scroll Down', 'ecto' ) . '</span></a>';
			} // endif get_header_image()
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
