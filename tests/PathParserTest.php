<?php

use \PHPUnit\Framework\TestCase;


class PathParserTest extends TestCase {

	public function testHorizontal() {
		$coords = (new App\PathParser('87.342 34.30 start 0 walk 10.0'))
			->walkThroughPath()
			->getCoords();
		$this->assertSame($coords, ['x' => 97.342, 'y' => 34.3, 'alpha' => 0.0]);
	}

	public function testVertical() {
		$coords = (new App\PathParser('87.342 34.30 start 0 turn 90 walk 10.0'))
			->walkThroughPath()
			->getCoords();
		$this->assertSame($coords, ['x' => 87.342, 'y' => 44.3, 'alpha' => 1.5707963267948966]);
	}

	public function testCommon() {
		$coords = (new App\PathParser('57.34 34.30 start 0 turn 90 walk 10.0 turn 90 walk 20 turn 45 walk 40'))
			->walkThroughPath()
			->getCoords();
		$this->assertSame($coords, ['x' => 9.055728752538094, 'y' => 16.0157287525381, 'alpha' => 3.9269908169872414]);
	}

	public function testException() {
		$exceptionThrown = false;
		try {
			$coords = (new App\PathParser('57.34 34.30 start 0 turn 90 walll'))
				->walkThroughPath()
				->getCoords();
		} catch (\App\PathParserException $e) {
			$exceptionThrown = true;
		}

		$this->assertTrue($exceptionThrown);
	}
}
