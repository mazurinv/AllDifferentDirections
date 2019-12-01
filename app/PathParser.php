<?php

namespace App;

class PathParser {

	private $currentLocation = [
		'x' => 0.0,
		'y' => 0.0,
		'alpha' => 0.0
	];

	private $path = [];

	private $availableActions = ['walk', 'turn'];

	public function __construct(string $pathString) {
		$this->parse($pathString);
		$this->initState();
	}

	private function parse(string $pathString) {
		$pathArray = explode(' ', $pathString);
		$this->path = $pathArray;
	}

	private function initState() {
		$this->currentLocation['x'] = array_shift($this->path);
		$this->currentLocation['y'] = array_shift($this->path);
		// hop over the "start" word
		array_shift($this->path);
		$this->currentLocation['alpha'] = deg2rad(array_shift($this->path));
	}

	public function walkThroughPath() : self {
		while (count($this->path)) {
			$action = array_shift($this->path);
			if (!in_array($action, $this->availableActions)) {
				throw new \App\PathParserException();
			}
			$value = array_shift($this->path);
			$this->doAction($action, $value);
		}
		return $this;
	}

	public function getCoords() : array {
		return $this->currentLocation;
	}

	private function doAction(string $action, string $value) {
		if ($action === 'walk') {
			$this->currentLocation['x'] = $this->currentLocation['x'] + cos($this->currentLocation['alpha']) * $value;
			$this->currentLocation['y'] = $this->currentLocation['y'] + sin($this->currentLocation['alpha']) * $value;
		} else if ($action === 'turn') {
			$this->currentLocation['alpha'] += deg2rad($value);
		}
	}
}