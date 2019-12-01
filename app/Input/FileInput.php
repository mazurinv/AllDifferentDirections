<?php

namespace App\Input;

class FileInput extends AbstractInput {
	public function getData($filename) : array {
		$data = file_get_contents($filename);
		return $this->prepareData($data);
	}
}