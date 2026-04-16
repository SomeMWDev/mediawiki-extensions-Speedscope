<?php

namespace MediaWiki\Extension\Speedscope\Tests\unit;

use MediaWiki\Extension\Speedscope\SpeedscopeConfig;
use MediaWiki\Extension\Speedscope\SpeedscopeConfigNames;
use MediaWikiUnitTestCase;
use Wikimedia\ScopedCallback;

/**
 * @covers \MediaWiki\Extension\Speedscope\SpeedscopeConfig
 */
class SpeedscopeConfigTest extends MediaWikiUnitTestCase {

	public function testSpeedscopeConfig() {
		$scopedCallbacks = [
			$this->overrideConfigGlobal( SpeedscopeConfigNames::ENVIRONMENT, 'config-test' ),
			$this->overrideConfigGlobal( SpeedscopeConfigNames::EXCLUDED_ENTRY_POINTS, [ 'config-test-entry-point' ] ),
			$this->overrideConfigGlobal( SpeedscopeConfigNames::FORCED_PARAM, 'configtest' ),
			$this->overrideConfigGlobal( SpeedscopeConfigNames::PERIOD, [ 'forced' => 0.1234, 'sample' => 0.2345 ] ),
			$this->overrideConfigGlobal( SpeedscopeConfigNames::SAMPLING_RATES, [ 'config-test' => 0.4321 ] ),
		];
		$config = SpeedscopeConfig::newFromGlobals();
		$this->assertEquals( 'config-test', $config->getEnvironment() );
		$this->assertEquals( [ 'config-test-entry-point' ], $config->getExcludedEntryPoints() );
		$this->assertEquals( 'configtest', $config->getForcedParam() );
		$this->assertEquals( 0.1234, $config->getForcedPeriod() );
		$this->assertEquals( 0.2345, $config->getSamplePeriod() );
		$this->assertEquals( [ 'config-test' => 0.4321 ], $config->getSamplingRates() );
	}

	private function overrideConfigGlobal( string $name, mixed $value ): ScopedCallback {
		$name = "wg$name";
		$originalValue = $GLOBALS[$name] ?? null;
		$GLOBALS[$name] = $value;
		return new ScopedCallback( static function () use ( $name, $originalValue ) {
			$GLOBALS[$name] = $originalValue;
		} );
	}

}
