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
			'select'       => __( 'Select Image', 'customizer-background' ),
			'change'       => __( 'Change Image', 'customizer-background' ),
			'remove'       => __( 'Remove', 'customizer-background' ),
			'default'      => __( 'Default', 'customizer-background' ),
			'placeholder'  => __( 'No image selected', 'customizer-background' ),
			'frame_title'  => __( 'Select Image', 'customizer-background' ),
			'frame_button' => __( 'Choose Image', 'customizer-background' ),
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
		wp_enqueue_script( 'customizer-custom-background-controls' );
		wp_enqueue_style( 'customizer-custom-background-controls' );
	}

	/**
	 * The background choices.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public static function background_choices() {

		$choices = array(
			'repeat' => array(
				'no-repeat' => __( 'No Repeat', 'customizer-background' ),
				'repeat'    => __( 'Repeat All', 'customizer-background' ),
				'repeat-x'  => __( 'Repeat X', 'customizer-background' ),
				'repeat-y'  => __( 'Repeat Y', 'customizer-background' ),
				'inherit'   => __( 'Inherit', 'customizer-background' ),
			),
			'size' => array(
				'inherit' => __( 'Inherit', 'customizer-background' ),
				'cover'   => __( 'Cover', 'customizer-background' ),
				'contain' => __( 'Contain', 'customizer-background' ),
			),
			'attach' => array(
				'inherit' => __( 'Inherit', 'customizer-background' ),
				'fixed'   => __( 'Fixed', 'customizer-background' ),
				'scroll'  => __( 'Scroll', 'customizer-background' ),
			),
			'position' => array(
				'left-top'      => __( 'Left Top', 'customizer-background' ),
				'left-center'   => __( 'Left Center', 'customizer-background' ),
				'left-bottom'   => __( 'Left Bottom', 'customizer-background' ),
				'right-top'     => __( 'Right Top', 'customizer-background' ),
				'right-center'  => __( 'Right Center', 'customizer-background' ),
				'right-bottom'  => __( 'Right Bottom', 'customizer-background' ),
				'center-top'    => __( 'Center Top', 'customizer-background' ),
				'center-center' => __( 'Center Center', 'customizer-background' ),
				'center-bottom' => __( 'Center Bottom', 'customizer-background' ),
			),
		);

		return $choices;

	}

}
