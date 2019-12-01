<?php

use \PHPUnit\Framework\TestCase;


class PathFinderTest extends TestCase {

	public function testOutputResult() {

		$inputData = "3
87.342 34.30 start 0 walk 10.0
2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5";
		$input = (new \App\Input\DataInput())->getData($inputData);
		$pathFinder = new \App\PathFinder($input);
		$res = $pathFinder->outputResult();

		$this->assertEquals(array_shift($res), [97.1547, 40.2334, 7.631]);
	}

	public function testOutputResultException() {
		// walke word in the first string should throw an exception
		$inputData = "3
87.342 34.30 start 0 walke 10.0
2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5";
		$input = (new \App\Input\DataInput())->getData($inputData);
		$pathFinder = new \App\PathFinder($input);
		$res = $pathFinder->outputResult();

		$this->assertEquals(array_shift($res), [97.1547, 40.2334, 7.631]);
	}
}
