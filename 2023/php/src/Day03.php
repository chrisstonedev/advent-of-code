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
                } elseif ($input[$y][$x] === '*') {
                    $adjacentNumbers = 0;
                    if (is_numeric($input[$y][$x - 1])) {
                        $adjacentNumbers++;
                    }
                    if (is_numeric($input[$y][$x + 1])) {
                        $adjacentNumbers++;
                    }
                    if (is_numeric($input[$y - 1][$x - 1])
                        && !is_numeric($input[$y - 1][$x])
                        && is_numeric($input[$y - 1][$x + 1])
                    ) {
                        $adjacentNumbers += 2;
                    } elseif (is_numeric($input[$y - 1][$x - 1])
                        || is_numeric($input[$y - 1][$x])
                        || is_numeric($input[$y - 1][$x + 1])
                    ) {
                        $adjacentNumbers++;
                    }
                    if (is_numeric($input[$y + 1][$x - 1])
                        && !is_numeric($input[$y + 1][$x])
                        && is_numeric($input[$y + 1][$x + 1])
                    ) {
                        $adjacentNumbers += 2;
                    } elseif (is_numeric($input[$y + 1][$x - 1])
                        || is_numeric($input[$y + 1][$x])
                        || is_numeric($input[$y + 1][$x + 1])
                    ) {
                        $adjacentNumbers++;
                    }
                    if ($adjacentNumbers === 2) {
                        $parts[] = "$x,$y";
                    }
                }
            }
        }
        $partNumbers = [];
        foreach ($numbers as $number) {
            $part = self::determinePartForNumber($parts, $number['location'], strlen(strval($number['number'])));
            if ($part) {
                $partNumbers[$part][] = $number['number'];
            }
        }

        return array_reduce($partNumbers, function (int $total, array $numbers) {
            return $total + ($numbers[0] * $numbers[1]);
        }, 0);
    }

    public static function determineNumberIsForPart(array $parts, string $numberStart, int $numberLength): bool
    {
        $location = explode(',', $numberStart);
        $x = intval($location[0]);
        $y = intval($location[1]);
        if (in_array(sprintf("%d,%d", $x - 1, $y), $parts)
            || in_array(sprintf("%d,%d", $x + $numberLength, $y), $parts)) {
            return true;
        }
        for ($i = -1; $i < $numberLength + 1; $i++) {
            if (in_array(sprintf("%d,%d", $x + $i, $y - 1), $parts)
                || in_array(sprintf("%d,%d", $x + $i, $y + 1), $parts)) {
                return true;
            }
        }
        return false;
    }

    public static function determinePartForNumber(array $parts, string $numberStart, int $numberLength): ?string
    {
        $location = explode(',', $numberStart);
        $x = intval($location[0]);
        $y = intval($location[1]);
        if (in_array(sprintf("%d,%d", $x - 1, $y), $parts)) {
            return sprintf("%d,%d", $x - 1, $y);
        }
        if (in_array(sprintf("%d,%d", $x + $numberLength, $y), $parts)) {
            return sprintf("%d,%d", $x + $numberLength, $y);
        }
        for ($i = -1; $i < $numberLength + 1; $i++) {
            if (in_array(sprintf("%d,%d", $x + $i, $y - 1), $parts)) {
                return sprintf("%d,%d", $x + $i, $y - 1);
            }
            if (in_array(sprintf("%d,%d", $x + $i, $y + 1), $parts)) {
                return sprintf("%d,%d", $x + $i, $y + 1);
            }
        }
        return null;
    }
}