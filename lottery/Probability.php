<?php

declare(strict_types=1);

namespace Lottery;

class Probability
{
    public function weightedChoice(array $weightPairs): mixed
    {
        $multiplier = 1000000;

        $rand = mt_rand(1, (int)(array_sum($weightPairs) * $multiplier));

        $accuracy = 0;
        foreach ($weightPairs as $value => $weight) {
            $accuracy += $weight * $multiplier;
            if ($accuracy >= $rand) {
                return $value;
            }
        }

        return $value;
    }
}
