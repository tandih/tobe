<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Ecto
 */
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<h2 class="widget-title screen-reader-text"><?php _e( 'Social Menu', 'ecto' ); ?></h2>
		<?php wp_nav_menu( array(
			'theme_location' => 'social',
			'depth' => 1,
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>',
			'container_id'    => 'social-navigation',
			'container_class' => 'social-links',
		) ); ?>
	<?php endif; ?>
</div><!-- #secondary -->
