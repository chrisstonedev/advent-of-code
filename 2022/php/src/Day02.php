<?php

declare(strict_types=1);

namespace aoc2022;

class Day02
{
    public static function ExecutePartOne(array $input): int
    {
        $score = 0;
        foreach ($input as $line) {
            $lineData = explode(' ', $line);
            $opponentChoice = $lineData[0];
            $playerChoice = $lineData[1];
            switch ($playerChoice) {
                case 'X':
                    $score += 1;
                    break;
                case 'Y':
                    $score += 2;
                    break;
                case 'Z':
                    $score += 3;
                    break;
            }
            switch ([$opponentChoice, $playerChoice]) {
                case ['A', 'X']:
                case ['B', 'Y']:
                case ['C', 'Z']:
                    $score += 3;
                    break;
                case ['A', 'Y']:
                case ['B', 'Z']:
                case ['C', 'X']:
                    $score += 6;
                    break;
            }
        }
        return $score;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $score = 0;
        foreach ($input as $line) {
            $lineData = explode(' ', $line);
            $opponentChoice = $lineData[0];
            $result = $lineData[1];

            switch ($result) {
                case 'Y':
                    $score += 3;
                    break;
                case 'Z':
                    $score += 6;
                    break;
            }
            switch ([$opponentChoice, $result]) {
                case ['A', 'Y']:
                case ['B', 'X']:
                case ['C', 'Z']:
                    $score += 1;
                    break;
                case ['A', 'Z']:
                case ['B', 'Y']:
                case ['C', 'X']:
                    $score += 2;
                    break;
                case ['A', 'X']:
                case ['B', 'Z']:
                case ['C', 'Y']:
                    $score += 3;
                    break;
            }
        }
        return $score;
    }
}