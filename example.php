<?php
/**
 * Register customizer panels, sections, settings, and controls.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function customize_background_control_customize_register_example( $wp_customize ) {

	// Add a custom background panel for testing.
	$wp_customize->add_section( 'custom_background_section', array(
		'priority' => 5,
		'title' => esc_html__( 'Custom Background Example', 'customizer-background-control' )
	) );

	// Registers example_background settings
	$wp_customize->add_setting( 'example_background_image_url', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_setting( 'example_background_image_id', array(
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_setting( 'example_background_repeat', array(
		'default' => 'no-repeat',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'example_background_size', array(
		'default' => 'auto',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'example_background_attach', array(
		'default' => 'scroll',
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
				'label'		=> esc_html__( 'Example Background', 'customizer-background-control' ),
				'section'	=> 'custom_background_section',
				// Tie a setting (defined via `$wp_customize->add_setting()`) to the control.
				'settings'    => array(
					'image_url' => 'example_background_image_url',
					'image_id' => 'example_background_image_id',
					'repeat' => 'example_background_repeat', // Use false to hide the field
					'size' => 'example_background_size',
					'position' => 'example_background_position',
					'attach' => 'example_background_attach'
				)
			)
		)
	);

}
add_action( 'customize_register', 'customize_background_control_customize_register_example' );