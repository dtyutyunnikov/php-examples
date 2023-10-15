<?php

declare(strict_types=1);

require_once 'Probability.php';

$test = [
	1 => 0.002,
	2 => 0.003,
	3 => 0.03,
	4 => 0.045,
	5 => 0.02,
	6 => 0.15,
	7 => 0.15,
	8 => 0.1,
	9 => 0.1,
	10 => 0.1,
	11 => 0.1,
	12 => 0.2,
];

$result = [
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0,
	5 => 0,
	6 => 0,
	7 => 0,
	8 => 0,
	9 => 0,
	10 => 0,
	11 => 0,
	12 => 0,
];

$probability = new \Lottery\Probability();
for ($i = 0; $i < 1000000; $i++) {
	$v = $probability->weightedChoice($test);
	$result[$v]++;
}

print_r($result);