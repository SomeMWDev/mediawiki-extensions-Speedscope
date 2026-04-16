<?php

namespace MediaWiki\Extension\Speedscope\Tests\Integration\Profiler;

use MediaWiki\Extension\Speedscope\Profiler\NoOpSpeedscopeProfiler;
use MediaWikiIntegrationTestCase;

/**
 * @covers \MediaWiki\Extension\Speedscope\Profiler\NoOpSpeedscopeProfiler
 */
class NoOpSpeedscopeProfilerTest extends MediaWikiIntegrationTestCase {

	public function testNoOpProfiler() {
		$profiler = $this->getServiceContainer()->getService( 'Speedscope.Profiler' );
		$this->assertInstanceOf( NoOpSpeedscopeProfiler::class, $profiler );
		$this->assertNull( $profiler->getProfile() );
	}

}
