<?php

declare(strict_types=1);

namespace aoc2022;

class Day06
{
    public static function executePartOne(string $input): int
    {
        for ($i = 4; $i <= strlen($input); $i++) {
            $potentialMarker = substr($input, $i - 4, 4);
            if ($potentialMarker[0] != $potentialMarker[1] &&
                $potentialMarker[0] != $potentialMarker[2] &&
                $potentialMarker[0] != $potentialMarker[3] &&
                $potentialMarker[1] != $potentialMarker[2] &&
                $potentialMarker[1] != $potentialMarker[3] &&
                $potentialMarker[2] != $potentialMarker[3])
                return $i;
        }
        return 0;
    }

    public static function executePartTwo(string $input): int
    {
        for ($i = 14; $i <= strlen($input); $i++) {
            $potentialMarker = substr($input, $i - 14, 14);
            $foundMatch = false;
            for ($j = 0; $j < 13; $j++) {
                for ($k = $j + 1; $k < 14; $k++) {
                    if ($potentialMarker[$j] === $potentialMarker[$k]) {
                        $foundMatch = true;
                        break;
                    }
                }
                if ($foundMatch) {
                    break;
                }
            }
            if (!$foundMatch) {
                return $i;
            }
        }
        return 0;
    }
}