<?php

declare(strict_types=1);

namespace aoc2023;

class Day03
{
    public static function executePartOne(array $input): int
    {
        $numbers = [];
        $parts = [];
        for ($y = 0; $y < count($input); $y++) {
            for ($x = 0; $x < strlen($input[$y]); $x++) {
                if (is_numeric($input[$y][$x])) {
                    preg_match('/\d+/', substr($input[$y], $x), $matches);
                    $numberAsString = $matches[0];
                    $numbers[] = ['location' => "$x,$y", 'number' => intval($numberAsString)];
                    $x += strlen($numberAsString) - 1;
                } elseif ($input[$y][$x] !== '.') {
                    $parts[] = "$x,$y";
                }
            }
        }
        return array_reduce($numbers, function (int $total, array $number) use ($parts) {
            return $total + (self::determineNumberIsForPart($parts, $number['location'], strlen(strval($number['number'])))
                    ? $number['number'] : 0);
        }, 0);
    }

    public static function executePartTwo(array $input): int
    {
        $numbers = [];
        $parts = [];
        for ($y = 0; $y < count($input); $y++) {
            for ($x = 0; $x < strlen($input[$y]); $x++) {
                if (is_numeric($input[$y][$x])) {
                    preg_match('/\d+/', substr($input[$y], $x), $matches);
                    $numberAsString = $matches[0];
                    $numbers[] = ['location' => "$x,$y", 'number' => intval($numberAsString)];
                    $x += strlen($numberAsString) - 1;
                } elseif ($input[$y][$x] === '*' && (
                        is_numeric($input[$y - 1][$x - 1])
                        || is_numeric($input[$y - 1][$x])
                        || is_numeric($input[$y - 1][$x + 1])
                        || is_numeric($input[$y][$x - 1])
                        || is_numeric($input[$y][$x + 1])
                        || is_numeric($input[$y + 1][$x - 1])
                        || is_numeric($input[$y + 1][$x])
                        || is_numeric($input[$y + 1][$x + 1])
                    )) {
                    $parts[] = "$x,$y";
                }
            }
        }
        return array_reduce($numbers, function (int $total, array $number) use ($parts) {
            return $total + (self::determineNumberIsForPart($parts, $number['location'], strlen(strval($number['number'])))
                    ? $number['number'] : 0);
        }, 0);
    }

    public static function determineNumberIsForPart(array $parts, string $numberStart, int $numberLength): bool
    {
        $location = explode(',', $numberStart);
        if (in_array(sprintf("%d,%d", $location[0] - 1, $location[1]), $parts)
            || in_array(sprintf("%d,%d", $location[0] + $numberLength, $location[1]), $parts)) {
            return true;
        }
        for ($i = -1; $i < $numberLength + 1; $i++) {
            if (in_array(sprintf("%d,%d", $location[0] + $i, $location[1] - 1), $parts)
                || in_array(sprintf("%d,%d", $location[0] + $i, $location[1] + 1), $parts)) {
                return true;
            }
        }
        return false;
    }
}