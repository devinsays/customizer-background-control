<?php
/**
 * Plugin Name: Customizer Background Control
 * Plugin URI:  https://github.com/devinsays
 * Author:      Devin Price
 * Author URI:  http://wptheming.com
 * Description: Registers a new custom customizer control for backgrounds
 * Version:		1.0.0
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Register control scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function customize_background_controls_register_scripts() {

	// Since this can be used as a drop-in library
	// We'll load the JS relative to this PHP file
	$file = dirname( __FILE__ );

	// Get the URL and path to wp-content
	$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$content_dir = untrailingslashit( WP_CONTENT_DIR );

	// Fix path on Windows servers
	$file = wp_normalize_path( $file );
	$content_dir = wp_normalize_path( $content_dir );

	$uri = str_replace( $content_dir, $content_url, $file );

	wp_register_script(
		'customizer-background-image-controls',
		esc_url( $uri . '/js/customize-controls.js' ),
		array( 'customize-controls' )
	);

}
add_action( 'customize_controls_enqueue_scripts', 'customize_background_controls_register_scripts' );

/**
 * Register customizer panels, sections, settings, and controls.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function customize_background_control_customize_register( $wp_customize ) {

	// Load customizer background control class.
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customize/class-customize-background-image-control.php' );

	// Register background control JS template.
	$wp_customize->register_control_type( 'Customize_Custom_Background_Control' );

}
add_action( 'customize_register', 'customize_background_control_customize_register' );

// For testing purposes
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'example.php' );