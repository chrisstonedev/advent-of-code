<?php

declare(strict_types=1);

namespace aoc2023;

class Day04
{
    public static function executePartOne(array $input): int
    {
        $value = 0;
        foreach ($input as $card) {
            $numbers = explode(' | ', explode(': ', $card)[1]);
            preg_match_all('/\d+/', $numbers[0], $winningNumbers);
            preg_match_all('/\d+/', $numbers[1], $yourNumbers);
            $test = array_intersect($winningNumbers[0], $yourNumbers[0]);
            if (count($test) > 0) {
                $value += pow(2, count($test) - 1);
            }
        }
        return $value;
    }

    public static function executePartTwo(array $input): int
    {
        $scratchcards = 0;
        $repeats = [];
        foreach ($input as $index => $card) {
            $scratchcards++;
            $numbers = explode(' | ', explode(': ', $card)[1]);
            preg_match_all('/\d+/', $numbers[0], $winningNumbers);
            preg_match_all('/\d+/', $numbers[1], $yourNumbers);
            $test = array_intersect($winningNumbers[0], $yourNumbers[0]);
            for ($i = 0; $i < count($test); $i++) {
                $repeats[] = $index + $i + 1;
            }
        }
        while ($repeats) {
            $repeats = self::extracted($repeats, $input, $scratchcards);
        }
        return $scratchcards;
    }

    public static function extracted(array $repeats, array $input, int &$scratchcards): array
    {
        $newRepeats = [];
        foreach ($repeats as $index) {
            $card = $input[$index];
            $scratchcards++;
            $numbers = explode(' | ', explode(': ', $card)[1]);
            preg_match_all('/\d+/', $numbers[0], $winningNumbers);
            preg_match_all('/\d+/', $numbers[1], $yourNumbers);
            $test = array_intersect($winningNumbers[0], $yourNumbers[0]);
            for ($i = 0; $i < count($test); $i++) {
                $newRepeats[] = $index + $i + 1;
            }
        }
        return $newRepeats;
    }
}