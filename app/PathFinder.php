<?php

namespace App;

use App\PathParser;

class PathFinder {

	private $dataSets;

	private $results = [];

	public function __construct(array $dataSets) {
 		$this->dataSets = $dataSets;
	}

	public function outputResult() {
		foreach ($this->dataSets as $dataSet) {
			array_push($this->results, $this->calculateResult($dataSet));
		}
		return $this->results;
	}

	private function calculateResult($dataSet) {
		$resultsCount = count($dataSet);
		$x = 0;
		$y = 0;

		$directions = [];
		$distances = [];

		foreach ($dataSet as $line) {
			try {
				$parsed = (new PathParser($line))->walkThroughPath()->getCoords();
			} catch (PathParserException $e) {
				return ['broken input', '', ''];
			}

			$x += $parsed['x'];
			$y += $parsed['y'];
			array_push($directions, [$parsed['x'], $parsed['y']]);
		}

		// counting average destination
		$xAvg = $x / $resultsCount;
		$yAvg = $y / $resultsCount;

		// distances counting
		foreach ( $directions as $direction ) {
			$distance = sqrt(pow($xAvg - $direction[0],2) + pow($yAvg - $direction[1],2));
			array_push($distances, $distance);
		}

		return [round($xAvg,4), round($yAvg,4), round(max(...$distances),4)];
	}

}