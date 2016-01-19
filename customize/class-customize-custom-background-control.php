<?php
/**
 * Customize API: Customize_Custom_Background_Control class
 *
 * @package Customizer Custom Background
 * @since 1.1.0
 */

/**
 * Customize Custom Background Control class.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Upload_Control
 */
class Customize_Custom_Background_Control extends WP_Customize_Upload_Control {

	public $type = 'custom-background';

	public $mime_type = 'image';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @uses WP_Customize_Upload_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		$this->button_labels = array(
			'select'       => __( 'Select Image', 'customizer-custom-background' ),
			'change'       => __( 'Change Image', 'customizer-custom-background' ),
			'remove'       => __( 'Remove', 'customizer-custom-background' ),
			'default'      => __( 'Default', 'customizer-custom-background' ),
			'placeholder'  => __( 'No image selected', 'customizer-custom-background' ),
			'frame_title'  => __( 'Select Image', 'customizer-custom-background' ),
			'frame_button' => __( 'Choose Image', 'customizer-custom-background' ),
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {

		parent::enqueue();

		wp_enqueue_script( 'customizer-custom-background-controls' );
		wp_enqueue_style( 'customizer-custom-background-controls' );

	}

		/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {

		parent::to_json();

		$choices = $this->get_background_choices();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key )
			);

			if ( 'repeat' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $choices['repeat'];
			}
			elseif ( 'size' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $choices['size'];
			}
			elseif ( 'attach' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $choices['attach'];
			}
			elseif ( 'position' === $setting_key ) {
				$this->json[ $setting_key ]['choices'] = $choices['position'];
			}

		}
	}

	/**
	 * Render a JS template for the content of the media control.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {

		parent::content_template();

		?>
		<# console.log( data ); #>

		<# if ( data.repeat && data.repeat.choices ) { #>
			<li class="custom-background-repeat">
				<# if ( data.repeat.label ) { #>
					<span class="customize-control-title">{{ data.repeat.label }}</span>
				<# } #>
				<select {{{ data.repeat.link }}}>
					<# _.each( data.repeat.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>
				</select>
			</li>
		<# } #>

		<# if ( data.size && data.size.choices ) { #>
			<li class="custom-background-size">
				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }}</span>
				<# } #>
				<select {{{ data.size.link }}}>
					<# _.each( data.size.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>
				</select>
			</li>
		<# } #>

		<# if ( data.attach && data.attach.choices ) { #>
			<li class="custom-background-attach">
				<# if ( data.attach.label ) { #>
					<span class="customize-control-title">{{ data.attach.label }}</span>
				<# } #>
				<select {{{ data.attach.link }}}>
					<# _.each( data.attach.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>
				</select>
			</li>
		<# } #>

		<# if ( data.position && data.position.choices ) { #>
			<li class="custom-background-position">
				<# if ( data.position.label ) { #>
					<span class="customize-control-title">{{ data.position.label }}</span>
				<# } #>
				<select {{{ data.position.link }}}>
					<# _.each( data.position.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>
				</select>
			</li>
		<# } #>

		<?php
	}

	/**
	 * The background choices.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public static function get_background_choices() {

		$choices = array(
			'repeat' => array(
				'no-repeat' => __( 'No Repeat', 'customizer-custom-background' ),
				'repeat'    => __( 'Repeat All', 'customizer-custom-background' ),
				'repeat-x'  => __( 'Repeat X', 'customizer-custom-background' ),
				'repeat-y'  => __( 'Repeat Y', 'customizer-custom-background' ),
				'inherit'   => __( 'Inherit', 'customizer-custom-background' ),
			),
			'size' => array(
				'inherit' => __( 'Inherit', 'customizer-custom-background' ),
				'cover'   => __( 'Cover', 'customizer-custom-background' ),
				'contain' => __( 'Contain', 'customizer-custom-background' ),
			),
			'attach' => array(
				'inherit' => __( 'Inherit', 'customizer-custom-background' ),
				'fixed'   => __( 'Fixed', 'customizer-custom-background' ),
				'scroll'  => __( 'Scroll', 'customizer-custom-background' ),
			),
			'position' => array(
				'left-top'      => __( 'Left Top', 'customizer-custom-background' ),
				'left-center'   => __( 'Left Center', 'customizer-custom-background' ),
				'left-bottom'   => __( 'Left Bottom', 'customizer-custom-background' ),
				'right-top'     => __( 'Right Top', 'customizer-custom-background' ),
				'right-center'  => __( 'Right Center', 'customizer-custom-background' ),
				'right-bottom'  => __( 'Right Bottom', 'customizer-custom-background' ),
				'center-top'    => __( 'Center Top', 'customizer-custom-background' ),
				'center-center' => __( 'Center Center', 'customizer-custom-background' ),
				'center-bottom' => __( 'Center Bottom', 'customizer-custom-background' ),
			),
		);

		return $choices;

	}

}
