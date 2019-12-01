<?php

namespace App\Input;

class DataInput extends AbstractInput {
	public function getData(string $data) : array {
		return $this->prepareData($data);
	}
}