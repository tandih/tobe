<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Ecto
 */

function ecto_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'	=> 'page',
	) );

	/**
	 * Add theme support for Site logo
	 * See: http://jetpack.me/support/site-logo/
	 */
	 $args = array(
		 'size' => 'medium',
	 );
	 add_theme_support( 'site-logo', $args );

	 /**
	 * Add theme support for responsive videos
	 */
	 add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'ecto_jetpack_setup' );
