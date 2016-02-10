# Customizer Background Control

WORK IN PROGRESS

This proof-of-concept plugin adds a background image control to the Customizer.

The background control consists of six possible settings:

* Image upload (required)
* Background repeat select box
* Background size select box
* Background attach select box
* Background position select box

## TODO

* Test with theme mods and settings
* Add documentation for filters

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

## How to Add a Background Control

Although this is a single Customizer control, settings need to be registered for each field that displays (repeat, size, attach, etc). The only required setting is image_url. If a image_id setting is registered, the ID will also be saved.

I realize this is quite a bit of setting syntax for a single control. I experimented with auto-registering settings (view the GitHub history), but decided breaking WordPress conventions might cause confusion (especially for people wanting to use alternate defaults or sanitization). So, copy/paste away.

```
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
			'label'		=> esc_html__( 'Example Background', 'custom-background' ),
			'section'	=> 'custom_background_section',
			// Tie a setting ( defined via $wp_customize->add_setting() ) to the control.
			'settings'    => array(
				'image_url' => 'example_background_image_url',
				'image_id' => 'example_background_image_id',
				'repeat' => 'example_background_repeat',
				'size' => 'example_background_size',
				'attach' => 'example_background_attach',
				'position' => example_background_position
			)
		)
	)
);
```

## Suggested Setting Defaults and Sanitization

| Setting                    | Default         | Sanitization        |
| -------------------------- | --------------- | ------------------- |
| background_image_url       | null            | esc_url             |
| background_image_id        | null            | absint              |
| background_repeat          | repeat          | sanitize_text_field |
| background_size            | auto            | sanitize_text_field |
| background_attach          | scroll          | sanitize_text_field |
| background_position        | center-center   | sanitize_text_field |