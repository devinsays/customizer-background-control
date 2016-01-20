( function( api ) {

	/**
	 * Class extends the UploadControl
	 */
	api.controlConstructor['custom-background'] = api.UploadControl.extend( {

		ready: function() {

			// Re-use ready function from parent class to set up the image uploader
			var image = this;
			image.setting = this.settings.image;
			api.UploadControl.prototype.ready.apply( image, arguments );

			// Set up the new controls
			var control = this;

			control.container.on( 'change', '.custom-background-repeat select',
				function() {
					control.settings['repeat'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.custom-background-size select',
				function() {
					control.settings['size'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.custom-background-attach select',
				function() {
					control.settings['attach'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.custom-background-position select',
				function() {
					control.settings['position'].set( jQuery( this ).val() );
				}
			);

		},

		/**
		 * Callback handler for when an attachment is selected in the media modal.
		 * Gets the selected image information, and sets it within the control.
		 */
		select: function() {

			var attachment = this.frame.state().get( 'selection' ).first().toJSON();
			this.params.attachment = attachment;
			this.settings['image'].set( attachment.url );

		},

	} );

	console.log( 'custom-background loaded' );

} )( wp.customize );