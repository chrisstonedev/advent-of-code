<?php

declare(strict_types=1);

namespace aoc2022;

class Day01
{
    const INTEGER_MAP = 'intval';

    public static function ExecutePartOne(array $input): int
    {
        $inputAsIntegers = array_map(self::INTEGER_MAP, $input);
        $eachArray = [];
        $thisArray = [];
        for ($i = 0; $i < count($inputAsIntegers); $i++) {
            $thisElement = $inputAsIntegers[$i];
            if ($thisElement === 0) {
                $eachArray[] = $thisArray;
                $thisArray = [];
            } else {
                $thisArray[] = $thisElement;
            }
        }
        $eachArray[] = $thisArray;

        $biggestSum = 0;
        for ($i = 0; $i < count($eachArray); $i++) {
            $thisArray = $eachArray[$i];
            $thisSum = array_sum($thisArray);
            if ($thisSum > $biggestSum)
                $biggestSum = $thisSum;
        }
        return $biggestSum;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $inputAsIntegers = array_map(self::INTEGER_MAP, $input);
        $eachArray = [];
        $thisArray = [];
        for ($i = 0; $i < count($inputAsIntegers); $i++) {
            $thisElement = $inputAsIntegers[$i];
            if ($thisElement === 0) {
                $eachArray[] = $thisArray;
                $thisArray = [];
            } else {
                $thisArray[] = $thisElement;
            }
        }
        $eachArray[] = $thisArray;

        $sums = [];
        for ($i = 0; $i < count($eachArray); $i++) {
            $thisArray = $eachArray[$i];
            $sums[] = array_sum($thisArray);
        }
        rsort($sums);
        return $sums[0] + $sums[1] + $sums[2];
    }
}