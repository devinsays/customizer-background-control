( function( api ) {

	/**
	 * Class extends the UploadControl
	 */
	api.controlConstructor['custom-background'] = api.UploadControl.extend( {

		ready: function() {

			var control = this;

			// Shortcut so that we don't have to use _.bind every time we add a callback.
			_.bindAll( control, 'restoreDefault', 'removeFile', 'openFrame', 'select' );

			// Bind events, with delegation to facilitate re-rendering.
			control.container.on( 'click keydown', '.upload-button', control.openFrame );
			control.container.on( 'click keydown', '.thumbnail-image img', control.openFrame );
			control.container.on( 'click keydown', '.default-button', control.restoreDefault );
			control.container.on( 'click keydown', '.remove-button', control.removeFile );

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

		}

	} );

	console.log( 'custom-background loaded' );

} )( wp.customize );