<?php
/**
 * Custom header
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Ecto
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses ecto_header_style()
 * @uses ecto_admin_header_style()
 * @uses ecto_admin_header_image()
 */
function ecto_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ecto_custom_header_args', array(
		'default-image'		  => '',
		'default-text-color'     => '',
		'width'				  => 1440,
		'height'				 => 600,
		'flex-height'			=> true,
		'wp-head-callback'	   => 'ecto_header_style',
		'admin-head-callback'	=> 'ecto_admin_header_style',
		'admin-preview-callback' => 'ecto_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'ecto_custom_header_setup' );

if ( ! function_exists( 'ecto_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see ecto_custom_header_setup().
 */
function ecto_header_style() {
	$header_text_color = get_header_textcolor();
	$featured_image = ecto_check_featured_image();
	$header_image = get_header_image();

	// If no custom options for text or images are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && empty( $header_image ) ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description,
		.has-header-image .site-branding .site-title a,
		.has-header-image .site-branding .site-description,
		.has-header-image .site-branding a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>

	<?php
		if ( ! empty( $header_image ) && $featured_image == false ) :
			?>
				<style type="text/css">
					.site-header {
						background-image: url(<?php header_image(); ?>);
						background-position: center center;
						-webkit-background-size: cover;
						background-size: cover;
					}
				</style>
			<?php endif; // endif $featured_image && $header_image
} // ecto_header_style

endif; // ! function_exists( 'ecto_header_style' )

if ( ! function_exists( 'ecto_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see ecto_custom_header_setup().
 */
function ecto_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			color: #2e2e2e;
			font-family: "Merriweather", serif;
			background-color: #f5f8fa;
			border: 0;
			font-size: 18px;
			padding: 0;
			text-align: center;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			font-family: "Open Sans", sans-serif;
			font-size: 36px;
			line-height: 1.15;
			font-weight: 700;
			letter-spacing: -2px;
			margin: 10px 0;
			text-transform: uppercase;
		}
		#headimg h1 a {
  		color: #2e2e2e;
			text-decoration: none;
		}
		#desc {
			display: none;
		}
		#headimg img {
			max-width: 100%;
			height: auto;
		}
	</style>
<?php
}
endif; // ecto_admin_header_style

if ( ! function_exists( 'ecto_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see ecto_custom_header_setup().
 */
function ecto_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // ecto_admin_header_image
