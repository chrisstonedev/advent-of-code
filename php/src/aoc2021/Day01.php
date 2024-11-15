<?php

declare(strict_types=1);

namespace aoc\aoc2021;

class Day01
{
    const string INTEGER_MAP = 'intval';

    public static function ExecutePartOne(array $input): int
    {
        $inputAsIntegers = array_map(self::INTEGER_MAP, $input);
        $windowedArray = Day01::WindowList($inputAsIntegers, 2);
        $count = 0;
        for ($i = 0; $i < count($windowedArray); $i++) {
            $windowToEvaluate = $windowedArray[$i];
            if ($windowToEvaluate[0] < $windowToEvaluate[1]) {
                $count++;
            }
        }
        return $count;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $inputAsIntegers = array_map(self::INTEGER_MAP, $input);
        $windowedWindowedArray = Day01::WindowOfWindowList(Day01::WindowList($inputAsIntegers, 3));
        $count = 0;
        for ($i = 0; $i < count($windowedWindowedArray); $i++) {
            $windowedArrayToEvaluate = $windowedWindowedArray[$i];
            $firstSum = array_sum($windowedArrayToEvaluate[0]);
            $nextSum = array_sum($windowedArrayToEvaluate[1]);
            if ($firstSum < $nextSum) {
                $count++;
            }
        }
        return $count;
    }

    private static function WindowList(array $integers, int $windowSize): array
    {
        $newList = array();
        for ($i = $windowSize - 1; $i < count($integers); $i++) {
            $listOfValues = array();
            for ($j = $windowSize - 1; $j >= 0; $j--) {
                $listOfValues[] = $integers[$i - $j];
            }

            $newList[] = $listOfValues;
        }

        return $newList;
    }

    private static function WindowOfWindowList(array $windowedList): array
    {
        $newList = array();
        for ($i = 1; $i < count($windowedList); $i++) {
            $newList[] = array($windowedList[$i - 1], $windowedList[$i]);
        }

        return $newList;
    }
}