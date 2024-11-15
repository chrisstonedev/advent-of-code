<?php

declare(strict_types=1);

namespace aoc\aoc2022;

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
            if (str_contains($line, 'addx')) {
                $value = intval(substr($line, 5));
                $x += $value;
                $cycle++;
                $answer += self::checkCycleAndAddToAnswer($cycle, $x);
            }
        }
        return $answer;
    }

    public static function executePartTwo(array $input): string
    {
        $x = 1;
        $answer = '';
        $cycle = 1;
        for ($index = 0; $index < count($input); $index++) {
            $answer .= self::checkCycleAndAddToAnswerPart2($cycle, $x);
            $cycle++;
            $line = $input[$index];
            if (str_contains($line, 'addx')) {
                $answer .= self::checkCycleAndAddToAnswerPart2($cycle, $x);
                $cycle++;
                $value = intval(substr($line, 5));
                $x += $value;
            }
        }

        return $answer;
    }

    private static function checkCycleAndAddToAnswer(int $cycle, int $x): int
    {
        if (($cycle + 20) % 40 === 0) {
            return $cycle * $x;
        }
        return 0;
    }

    private static function checkCycleAndAddToAnswerPart2(int $cycle, int $x): string
    {
        $currentPosition = ($cycle - 1) % 40;
        $result = $currentPosition >= $x - 1 && $currentPosition <= $x + 1 ? '#' : '.';
        if ($cycle % 40 === 0 && $cycle < 240) {
            return "$result\n";
        }
        return $result;
    }
}