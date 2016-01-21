# Customizer Custom Background

Proof-of-concept plugin for adding a custom background control.

Work in progress.

# TODO

* Auto register the individual field settings
* Save all the individual settings into the base setting
* Test with settings versus theme_mods
* Save attachment ID, not just URL
* Pass labels
* Make choices filterable

## How to Include the New Control

* Drop a copy of this repository folder into your theme or plugin
* Require`customizer-background-control.php` from your theme or plugin

### Example

```
/**
 * Register customizer panels, sections, settings, and controls.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function background_image_customize_register( $wp_customize ) {

	// Load customizer background control class.
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'customize/class-customize-background-image-control.php' );

	// Register background control JS template.
	$wp_customize->register_control_type( 'Customize_Custom_Background_Control' );
	
	// Add Sections, Panels, Settings, and Controls Here
	
}
add_action( 'customize_register', 'background_image_customize_register' );
```

## Setting Defaults

| Setting                | Default         | Sanitization        |
| ---------------------- | --------------- | ------------------- |
| $setting . '_image'    | null            | esc_url             |
| $setting . '_repeat'   | repeat          | sanitize_text_field |
| $setting . '_size'     | auto            | sanitize_text_field |
| $setting . '_attach'   | scroll          | sanitize_text_field |
| $setting . '_position' | center-center   | sanitize_text_field |

## How to Add a Background Control

If you'd like to display all the default fields, use the default settings, and use the default sanitization, here's all you need:

```
$wp_customize->add_control(
	new Customize_Custom_Background_Control(
		$wp_customize,
		'example_background', // $id for the control
		array(
			'label'		=> esc_html__( 'Example Background', 'textdomain' ),
			'section'	=> 'example_section', // $id of the section in the customizer
			'setting'	=> 'example_background'
		)
	)
);
```

## How to Add a Background Control with Custom Defaults

If you'd like you set different default settings or sanitization, you can register your own settings and pass them in.

```
// Registers example_background settings
$wp_customize->add_setting( 'example_background_image', array(
	'sanitize_callback' => 'esc_url'
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
			'label'		=> esc_html__( 'Example Background', 'custom-background' ),
			'section'	=> 'custom_background_section',
			'setting'	=> 'example_background',
			// Tie a setting ( defined via $wp_customize->add_setting() ) to the control.
			'settings'    => array(
				'image' => 'example_background_image',
				'repeat' => 'example_background_repeat',
				'size' => 'example_background_size',
				'attach' => 'example_background_attach',
				'position' => example_background_position
			),

		)
	)
);
```

## How to Add a Background Control that Hides Specific Fields

If you'd like to hide specific fields, pass `false` to the associated setting. In this example, the "attach" and "position" fields will not show.

```
$wp_customize->add_control(
	new Customize_Custom_Background_Control(
		$wp_customize,
		'example_background',
		array(
			'label'		=> esc_html__( 'Example Background', 'custom-background' ),
			'section'	=> 'custom_background_section',
			'setting'	=> 'example_background',
			// Tie a setting ( defined via $wp_customize->add_setting() ) to the control.
			'settings'    => array(
				'attach' => false
				'position' => false
			),

		)
	)
);
```