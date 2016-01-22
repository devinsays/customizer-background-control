<?php
/**
 * Plugin Name: Customizer Background Control
 * Plugin URI:  https://github.com/devinsays
 * Author:      Devin Price
 * Author URI:  http://wptheming.com
 * Description: Registers a new custom customizer control for backgrounds.
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

	$uri = trailingslashit( plugin_dir_url( __FILE__ ) );

	wp_register_script(
		'customizer-background-image-controls',
		esc_url( $uri . 'js/customize-controls.js' ),
		array( 'customize-controls' )
	);

	wp_register_style(
		'customizer-background-image-controls',
		esc_url( $uri . 'css/customize-controls.css' )
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