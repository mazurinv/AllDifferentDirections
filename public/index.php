<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Input\FileInput;

$filename = __DIR__ . '/testcase.txt';
$input = (new FileInput())->getData($filename);

$pathFinder = new \App\PathFinder($input);
$res = $pathFinder->outputResult();

echo '<div class="output">';
echo '<div class="title">Input</div>';
$inputFile = file_get_contents($filename);
$inputArray = explode("\n", $inputFile);
foreach ($inputArray as $line) {
	echo '<p>' . $line . '</p>';
}
echo '</div>';


echo '<div class="output">';
echo '<div class="title">Output</div>';
foreach ($res as $line) {
	echo '<p>' . $line[0] . ' » ' . $line[1] . ' » ' . $line[2] . '</p>';
}
echo '</div>';


?>

<style>
	body {
		background: #345;
	}
	p {
		color: #345;
	}
	.output {
		margin-top: 1rem;
		position:relative;
		background: #efefef;
		padding: 3rem;
		border-radius: .3rem;
	}
	.title {
		background: #345;
		margin:0px;
		position:absolute;
		top:0px;
		padding:.4rem;
		color:white;
		font-size:1rem;
		border-radius: .0rem .0rem .3rem .3rem;
		transform: translate(0, -1rem);
	}
</style>
