<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day06
{
    public static function executePartOne(array $input): int
    {
        preg_match_all('/\d+/', $input[0], $timeStrings);
        $times = array_map('intval', $timeStrings[0]);
        preg_match_all('/\d+/', $input[1], $distanceStrings);
        $distances = array_map('intval', $distanceStrings[0]);
        return self::calculateAnswer($times, $distances);
    }

    public static function executePartTwo(array $input): int
    {
        $times = [intval(preg_replace("/[^0-9]/", '', $input[0]))];
        $distances = [intval(preg_replace("/[^0-9]/", '', $input[1]))];
        return self::calculateAnswer($times, $distances);
    }

    /**
     * @param int[] $times
     * @param int[] $distances
     */
    public static function calculateAnswer(array $times, array $distances): int
    {
        $waysToWinRace = [];
        for ($i = 0; $i < count($times); $i++) {
            $timeLimit = $times[$i];
            for ($speed = 1; $speed <= $timeLimit / 2; $speed++) {
                if (($speed * ($timeLimit - $speed)) > $distances[$i]) {
                    $waysToWinRace[$i]++;
                    if ($speed < $timeLimit / 2)
                        $waysToWinRace[$i]++;
                }
            }
        }
        return array_reduce($waysToWinRace, fn(int $total, int $number) => $total * $number, 1);
    }
}