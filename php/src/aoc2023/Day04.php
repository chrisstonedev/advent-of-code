<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day04
{
    public static function executePartOne(array $input): int
    {
        $value = 0;
        foreach ($input as $card) {
            $countOfWinningNumbers = self::getCountOfWinningNumbers($card);
            if ($countOfWinningNumbers > 0) {
                $value += pow(2, $countOfWinningNumbers - 1);
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
            $countOfWinningNumbers = self::getCountOfWinningNumbers($card);
            for ($i = 0; $i < $countOfWinningNumbers; $i++) {
                $repeats[] = $index + $i + 1;
            }
        }
        while ($repeats) {
            $repeats = self::continueEvaluatingRepeatCards($repeats, $input, $scratchcards);
        }
        return $scratchcards;
    }

    public static function getCountOfWinningNumbers(string $card): int
    {
        $numbers = explode(' | ', explode(': ', $card)[1]);
        preg_match_all('/\d+/', $numbers[0], $winningNumbers);
        preg_match_all('/\d+/', $numbers[1], $yourNumbers);
        $winningNumbers = array_intersect($winningNumbers[0], $yourNumbers[0]);
        return count($winningNumbers);
    }

    public static function continueEvaluatingRepeatCards(array $repeats, array $input, int &$scratchcards): array
    {
        $newRepeats = [];
        foreach ($repeats as $index) {
            $scratchcards++;
            $countOfWinningNumbers = self::getCountOfWinningNumbers($input[$index]);
            for ($i = 0; $i < $countOfWinningNumbers; $i++) {
                $newRepeats[] = $index + $i + 1;
            }
        }
        return $newRepeats;
    }
}