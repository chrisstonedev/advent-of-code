<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day13
{
    public static function executePartOne(array $input): int
    {
        $patterns = [];
        $pattern = [];
        foreach ($input as $line) {
            if ($line === '') {
                $patterns[] = $pattern;
                $pattern = [];
                continue;
            }
            $pattern[] = $line;
        }
        $patterns[] = $pattern;
        $value = 0;
        foreach ($patterns as $pattern) {
            $value += self::calculateValue($pattern);
        }
        return $value;
    }

    public static function executePartTwo(array $input): int
    {
        $patterns = [];
        $pattern = [];
        foreach ($input as $line) {
            if ($line === '') {
                $patterns[] = $pattern;
                $pattern = [];
                continue;
            }
            $pattern[] = $line;
        }
        $patterns[] = $pattern;
        $value = 0;
        foreach ($patterns as $pattern) {
            $value += self::calculateValueWithFuzzyEquality($pattern);
        }
        return $value;
    }

    private static function calculateValue(array $pattern): int
    {
        $rowValue = self::lookForRowValue($pattern);
        if ($rowValue) {
            return 100 * $rowValue;
        }

        $transposedArray = self::transposeArray($pattern);

        $columnValue = self::lookForRowValue($transposedArray);
        return $columnValue ?: 0;
    }

    private static function calculateValueWithFuzzyEquality(array $pattern): int
    {
        $rowValue = self::lookForRowValueWithFuzzyEquality($pattern);
        if ($rowValue) {
            return 100 * $rowValue;
        }

        $transposedArray = self::transposeArray($pattern);

        $columnValue = self::lookForRowValueWithFuzzyEquality($transposedArray);
        return $columnValue ?: 0;
    }

    private static function transposeArray(array $pattern): array
    {
        $transposedArray = [];
        for ($row = 0; $row < count($pattern); $row++) {
            for ($column = 0; $column < strlen($pattern[$row]); $column++) {
                $transposedArray[$column] .= $pattern[$row][$column];
            }
        }
        return $transposedArray;
    }

    private static function lookForRowValue(array $pattern): int|false
    {
        $rowPairs = [];
        for ($row = 1; $row < count($pattern); $row++) {
            if ($pattern[$row - 1] === $pattern[$row]) {
                $rowPairs[] = $row;
            }
        }

        foreach ($rowPairs as $rowPair) {
            $rowPairIsValid = true;
            for ($i = 1; (($rowPair + $i) < count($pattern) && ($rowPair - 1 - $i) >= 0); $i++) {
                if ($pattern[$rowPair + $i] !== $pattern[$rowPair - 1 - $i]) {
                    $rowPairIsValid = false;
                    break;
                }
            }
            if ($rowPairIsValid) {
                return $rowPair;
            }
        }

        return false;
    }

    private static function lookForRowValueWithFuzzyEquality(array $pattern): int|false
    {
        $rowPairs = [];
        for ($row = 1; $row < count($pattern); $row++) {
            $equality = self::checkEquality($pattern[$row - 1], $pattern[$row]);
            if ($equality > 0) {
                $rowPairs[] = $row;
            }
        }

        foreach ($rowPairs as $rowPair) {
            $rowPairIsValid = true;
            $foundOneIssue = false;
            for ($i = 0; (($rowPair + $i) < count($pattern) && ($rowPair - 1 - $i) >= 0); $i++) {
                $equality1 = self::checkEquality($pattern[$rowPair + $i], $pattern[$rowPair - 1 - $i]);
                if ($equality1 === 1 && !$foundOneIssue) {
                    $foundOneIssue = true;
                    continue;
                }
                if ($equality1 === 2) {
                    continue;
                }
                $rowPairIsValid = false;
                break;
            }
            if ($rowPairIsValid && $foundOneIssue) {
                return $rowPair;
            }
        }

        return false;
    }

    private static function checkEquality(string $line1, string $line2): int
    {
        if ($line1 === $line2) {
            return 2;
        }
        for ($i = 0; $i < strlen($line1); $i++) {
            $fakeLine1 = substr_replace($line1, $line1[$i] === '#' ? '.' : '#', $i, 1);
            if ($fakeLine1 === $line2) {
                return 1;
            }
        }
        return 0;
    }
}