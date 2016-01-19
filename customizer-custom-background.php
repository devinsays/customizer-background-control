<?php
/**
 * Plugin Name: Customizer Background
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
function custom_background_customize_controls_register_scripts() {

	$uri = trailingslashit( plugin_dir_url( __FILE__ ) );

	wp_register_script(
		'customizer-custom-background-controls',
		esc_url( $uri . 'js/customize-controls.js' ),
		array( 'customize-controls' )
	);

	wp_register_style(
		'customizer-custom-background-controls',
		esc_url( $uri . 'css/customize-controls.css' )
	);
}
add_action( 'customize_controls_enqueue_scripts', 'custom_background_customize_controls_register_scripts' );

/**
 * Register customizer panels, sections, settings, and controls.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function custom_background_customize_register( $wp_customize ) {

	// Load customizer background control class.
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customize/class-customize-custom-background-control.php' );

	// Register background control JS template.
	$wp_customize->register_control_type( 'Customize_Custom_Background_Control' );

	// Add a custom background panel for testing.
	$wp_customize->add_section( 'custom_background_section', array(
		'priority' => 5,
		'title' => esc_html__( 'Custom Background Testing', 'custom-background' )
	) );

	// Registers example_background settings
	$wp_customize->add_setting( 'example_background_image', array(
		'default' => '',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_setting( 'example_background_repeat', array(
			'default' => 'no-repeat',
			'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'example_background_size', array(
			'default' => 'inherit',
			'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'example_background_attach', array(
			'default' => 'inherit',
			'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'example_background_position', array(
			'default' => 'center-center',
			'sanitize_callback' => 'sanitize_text_field'
	) );

	// Registers example_background control
	$wp_customize->add_control(
		new Customize_Custom_Background_Control(
			$wp_customize,
			'example_background',
			array(
				'label'		=> esc_html__( 'Example Background', 'custom-background' ),
				'section'	=> 'custom_background_section',
				'setting'	=> 'example_background',
				// Tie a setting (defined via `$wp_customize->add_setting()`) to the control.
				'settings'    => array(
					'image' => 'example_background_image',
					'repeat' => 'example_background_repeat',
					'size' => 'example_background_size',
					'attach' => 'example_background_attach',
					'position' => 'example_background_position'
				),

			)
		)
	);

	$wp_customize->add_setting( 'example_image', array(
		'default' => '',
		'sanitize_callback' => 'esc_url'
	) );

	// Adds an example image control
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'example_image',
			array(
				'label'       => esc_html__( 'Example Image', 'custom-background' ),
				'section'     => 'custom_background_section'
			)
		)
	);

}
add_action( 'customize_register', 'custom_background_customize_register' );