<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day11
{
    public static function executePartOne(array $input): int
    {
        return self::multiplyByFactor($input, 2);
    }

    public static function executePartTwo(array $input): int
    {
        return self::multiplyByFactor($input, 1000000);
    }

    public static function multiplyByFactor(array $input, int $factor): int
    {
        $doubleRows = [];
        for ($i = 0; $i < count($input); $i++) {
            if (!str_contains($input[$i], '#')) {
                $doubleRows[] = $i;
            }
        }
        $doubleColumns = [];
        for ($j = 0; $j < strlen($input[0]); $j++) {
            $emptyColumn = true;
            for ($i = 0; $i < count($input); $i++) {
                if ($input[$i][$j] === '#') {
                    $emptyColumn = false;
                    break;
                }
            }
            if ($emptyColumn) {
                $doubleColumns[] = $j;
            }
        }

        $things = [];
        for ($i = 0; $i < count($input); $i++) {
            $lastPos = 0;
            while (($lastPos = strpos($input[$i], '#', $lastPos)) !== false) {
                $things[] = "$i,$lastPos";
                $lastPos = $lastPos + 1;
            }
        }

        $distances = [];
        for ($i = 0; $i < count($things) - 1; $i++) {
            for ($j = $i + 1; $j < count($things); $j++) {
                $distance = 0;
                $firstCoordinates = array_map('intval', explode(',', $things[$i]));
                $secondCoordinates = array_map('intval', explode(',', $things[$j]));
                for ($k = min($firstCoordinates[0], $secondCoordinates[0]);
                     $k < max($firstCoordinates[0], $secondCoordinates[0]);
                     $k++) {
                    $distance++;
                    if (in_array($k, $doubleRows)) {
                        $distance+=($factor-1);
                    }
                }
                for ($k = min($firstCoordinates[1], $secondCoordinates[1]);
                     $k < max($firstCoordinates[1], $secondCoordinates[1]);
                     $k++) {
                    $distance++;
                    if (in_array($k, $doubleColumns)) {
                        $distance+=($factor-1);
                    }
                }
                $distances[] = $distance;
            }
        }

        return array_sum($distances);
    }
}