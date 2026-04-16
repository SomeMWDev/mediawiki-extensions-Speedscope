<?php

namespace MediaWiki\Extension\Speedscope;

/**
 * Provides configuration values from globals.
 * This is necessary because we need this before we have access to the service container.
 */
class SpeedscopeConfig {

	/**
	 * @param string $environment
	 * @param string[] $excludedEntryPoints
	 * @param string $forcedParam
	 * @param array{forced:float,sample:float} $period
	 * @param array<string,float> $samplingRates
	 */
	public function __construct(
		private readonly string $environment,
		private readonly array $excludedEntryPoints,
		private readonly string $forcedParam,
		private readonly array $period,
		private readonly array $samplingRates,
	) {
	}

	public static function newFromGlobals(): self {
		$names = [
			SpeedscopeConfigNames::ENVIRONMENT,
			SpeedscopeConfigNames::EXCLUDED_ENTRY_POINTS,
			SpeedscopeConfigNames::FORCED_PARAM,
			SpeedscopeConfigNames::PERIOD,
			SpeedscopeConfigNames::SAMPLING_RATES,
		];
		// @phan-suppress-next-line PhanParamTooFewUnpack
		return new self( ...array_map( static fn ( $c ) => $GLOBALS["wg$c"], $names ) );
	}

	public function getEnvironment(): string {
		return $this->environment;
	}

	public function getExcludedEntryPoints(): array {
		return $this->excludedEntryPoints;
	}

	public function getForcedParam(): string {
		return $this->forcedParam;
	}

	public function getForcedPeriod(): float {
		return $this->period['forced'];
	}

	public function getSamplePeriod(): float {
		return $this->period['sample'];
	}

	/**
	 * @return array<string,float>
	 */
	public function getSamplingRates(): array {
		return $this->samplingRates;
	}

}
