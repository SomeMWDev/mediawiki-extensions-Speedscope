$( () => {
	mw.hook( 'wikipage.preview' ).add( ( config ) => {
		// eslint-disable-next-line no-jquery/no-global-selector
		if ( !$( '#wpProfilePreview' ).is( ':checked' ) ) {
			return;
		}
		const parseParams = config.parseParams || {};
		parseParams.wpProfilePreview = 1;
		config.parseParams = parseParams;
	} );
} );
