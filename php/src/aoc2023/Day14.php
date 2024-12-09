<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day14
{
    public static function executePartOne(array $input): int
    {
        $transposedArray = Day13::transposeArray($input);
        $transposedArray = self::shiftRocksToTheLeft($transposedArray);
        $shifted = Day13::transposeArray($transposedArray);
        return self::calculateValue($shifted);
    }

    public static function executePartTwo(array $input): int
    {
        $array = $input;
        for ($i = 0; $i < 1000000000; $i++) {
            if ($i % 1000 === 0) {
                print_r("on trip $i\n");
                flush();
                ob_flush();
            }
            $array = Day13::transposeArray($array);
            $array = self::shiftRocksToTheLeft($array);
            $array = Day13::transposeArray($array);
            $array = self::shiftRocksToTheLeft($array);
            $array = Day13::transposeArray($array);
            $array = self::shiftRocksToTheRight($array);
            $array = Day13::transposeArray($array);
            $array = self::shiftRocksToTheRight($array);
        }
        return self::calculateValue($array);
    }

    public static function shiftRocksToTheLeft(array $array): array
    {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < strlen($array[$i]) - 1; $j++) {
                if (substr($array[$i], $j, 2) === ".O") {
                    $array[$i] = substr_replace($array[$i], 'O.', $j, 2);
                    for ($k = $j - 1; $k >= 0; $k--) {
                        if (substr($array[$i], $k, 2) !== ".O") {
                            break;
                        }
                        $array[$i] = substr_replace($array[$i], 'O.', $k, 2);
                    }
                }
            }
        }
        return $array;
    }

    public static function shiftRocksToTheRight(array $array): array
    {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = strlen($array[$i]) - 2; $j >= 0; $j--) {
                if (substr($array[$i], $j, 2) === "O.") {
                    $array[$i] = substr_replace($array[$i], '.O', $j, 2);
                    for ($k = $j + 1; $k < strlen($array[$i]) - 1; $k++) {
                        if (substr($array[$i], $k, 2) !== "O.") {
                            break;
                        }
                        $array[$i] = substr_replace($array[$i], '.O', $k, 2);
                    }
                }
            }
        }
        return $array;
    }

    public static function calculateValue(array $array): int
    {
        $value = 0;
        for ($i = 0; $i < count($array); $i++) {
            $count = substr_count($array[$i], 'O');
            $value += $count * (count($array) - $i);
        }
        return $value;
    }
}