<?php

declare(strict_types=1);

namespace aoc2022;

class Day10
{
    public static function executePartOne(array $input): int
    {
        $x = 1;
        $answer = 0;
        $cycle = 1;
        for ($index = 0; $index < count($input); $index++) {
            $cycle++;
            $answer += self::checkCycleAndAddToAnswer($cycle, $x);
            $line = $input[$index];
            if (strpos($line, 'addx') !== false) {
                $value = intval(substr($line, 5));
                $x += $value;
                $cycle++;
                $answer += self::checkCycleAndAddToAnswer($cycle, $x);
            }
        }
        return $answer;
    }

    public static function executePartTwo(array $input): int
    {
        return 0;
    }

    private static function checkCycleAndAddToAnswer(int $cycle, int $x)
    {
        if (($cycle + 20) % 40 === 0) {
            return $cycle * $x;
        }
        return 0;
    }
}