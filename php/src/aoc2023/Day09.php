<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day09
{
    public static function executePartOne(array $input): int
    {
        $sum = 0;
        foreach ($input as $line) {
            preg_match_all('/-?\d+/', $line, $inputNumbers);
            $sum += intval($inputNumbers[0][count($inputNumbers[0]) - 1]);
            $differences = self::getDifferencesArray($inputNumbers[0]);

            while (count(array_filter($differences)) !== 0) {
                $sum += $differences[count($differences) - 1];
                $differences = self::getDifferencesArray($differences);
            }
        }
        return $sum;
    }

    public static function executePartTwo(array $input): int
    {
        $sum = 0;
        foreach ($input as $line) {
            preg_match_all('/-?\d+/', $line, $inputNumbers);
            $theInputNumbers = array_reverse($inputNumbers[0]);
            $sum += intval($theInputNumbers[count($theInputNumbers) - 1]);
            $differences = self::getDifferencesArray($theInputNumbers);

            while (count(array_filter($differences)) !== 0) {
                $sum += $differences[count($differences) - 1];
                $differences = self::getDifferencesArray($differences);
            }
        }
        return $sum;
    }

    /**
     * @param int[] $differences
     * @return int[]
     */
    public static function getDifferencesArray(array $differences): array
    {
        $differences2 = [];
        for ($i = 1; $i < count($differences); $i++) {
            $differences2[] = $differences[$i] - $differences[$i - 1];
        }
        return $differences2;
    }
}