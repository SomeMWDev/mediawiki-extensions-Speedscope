<?php

namespace MediaWiki\Extension\Speedscope;

class SpeedscopeProfile {

	private ?array $data = null;
	private ?array $parserReport = null;
	private bool $storeParserReport = false;

	public function __construct(
		private readonly string $environment,
		private readonly bool $forced,
		private readonly string $id,
	) {
	}

	public function getData(): ?array {
		return $this->data;
	}

	public function setData( ?array $data ): void {
		$this->data = $data;
	}

	public function getEnvironment(): string {
		return $this->environment;
	}

	public function isForced(): bool {
		return $this->forced;
	}

	public function getId(): string {
		return $this->id;
	}

	public function getParserReport(): ?array {
		return $this->parserReport;
	}

	public function setParserReport( ?array $parserReport ): void {
		$this->parserReport = $parserReport;
	}

	public function setStoreParserReport( bool $storeParserReport ): void {
		$this->storeParserReport = $storeParserReport;
	}

	public function shouldStoreParserReport(): bool {
		return $this->storeParserReport;
	}

}
