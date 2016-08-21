<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Ecto
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function ecto_wpcom_setup() {
	add_theme_support( 'print-style' );

	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'	 => '#ffffff',
			'border' => '#ebf2f6',
			'text'   => '#21759b',
			'link'   => '#4a4a4a',
			'url'	 => '#4a4a4a',
		);
	}
}
add_action( 'after_setup_theme', 'ecto_wpcom_setup' );

// WordPress.com specific styles
function ecto_wpcom_styles() {
	wp_enqueue_style( 'ecto-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', '042015' );
}
add_action( 'wp_enqueue_scripts', 'ecto_wpcom_styles' );
