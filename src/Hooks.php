<?php

namespace MediaWiki\Extension\Speedscope;

use MediaWiki\Config\Config;
use MediaWiki\Output\Hook\BeforePageDisplayHook;

class Hooks implements BeforePageDisplayHook {

	public function __construct(
		private readonly Config $config,
		private readonly ?SpeedscopeProfile $profile,
	) {
	}

	/** @inheritDoc */
	public function onBeforePageDisplay( $out, $skin ): void {
		if ( !$this->profile?->isForced() ) {
			return;
		}
		$out->addJsConfigVars( [
			'speedscopeEndpoint' => $this->config->get( SpeedscopeConfigNames::ENDPOINT ),
			'speedscopeProfileId' => $this->profile->getId(),
		] );
		$out->addModules( 'ext.speedscope.notification' );
	}

}
