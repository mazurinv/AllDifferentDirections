<?php

namespace App\Input;

class AbstractInput {

	protected function prepareData(string $data) : array {
		$data = explode("\n", $data);
		$dataSets = [];
		while (count($data)) {
			$linesCount = (int) array_shift($data);
			$dataSet = [];
			for ($i = 0; $i < $linesCount; $i++) {
				array_push($dataSet, array_shift($data));
			}
			array_push($dataSets, $dataSet);
		}
		return $dataSets;
	}
}