$( () => {
	const endpoint = mw.config.get( 'speedscopeEndpoint' );
	const profileId = mw.config.get( 'speedscopeProfileId' );

	const $speedscopeLink = $( '<a>' )
		.attr( 'href', `${ endpoint }/view/${ profileId }` )
		.attr( 'target', '_blank' )
		.text( mw.msg( 'speedscope-notification-link-view' ) );
	const $jsonLink = $( '<a>' )
		.attr( 'href', `${ endpoint }/profile/${ profileId }` )
		.attr( 'target', '_blank' )
		.text( mw.msg( 'speedscope-notification-link-json' ) );
	const $metadataLink = $( '<a>' )
		.attr( 'href', `${ endpoint }/metadata/${ profileId }` )
		.attr( 'target', '_blank' )
		.text( mw.msg( 'speedscope-notification-link-metadata' ) );

	mw.notify(
		$( '<div>' ).append( mw.message(
			'speedscope-notification',
			$speedscopeLink,
			$jsonLink,
			$metadataLink
		).parseDom() ),
		{
			autoHide: false,
			title: mw.msg( 'speedscope-notification-success' ),
			type: 'success'
		}
	);
} );
