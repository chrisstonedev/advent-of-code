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
            if ($playerChoice === 'X') {
                $score += 1;
                if ($opponentChoice === 'A') {
                    $score += 3;
                } elseif ($opponentChoice === 'C') {
                    $score += 6;
                }
            } elseif ($playerChoice === 'Y') {
                $score += 2;
                if ($opponentChoice === 'A') {
                    $score += 6;
                } elseif ($opponentChoice === 'B') {
                    $score += 3;
                }
            } elseif ($playerChoice === 'Z') {
                $score += 3;
                if ($opponentChoice === 'B') {
                    $score += 6;
                } elseif ($opponentChoice === 'C') {
                    $score += 3;
                }
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
            $playerChoice = $lineData[1];
            if ($playerChoice === 'X') {
                if ($opponentChoice === 'A') {
                    $score += 3;
                } elseif ($opponentChoice === 'B') {
                    $score += 1;
                } elseif ($opponentChoice === 'C') {
                    $score += 2;
                }
            } elseif ($playerChoice === 'Y') {
                $score += 3;
                if ($opponentChoice === 'A') {
                    $score += 1;
                } elseif ($opponentChoice === 'B') {
                    $score += 2;
                } elseif ($opponentChoice === 'C') {
                    $score += 3;
                }
            } elseif ($playerChoice === 'Z') {
                $score += 6;
                if ($opponentChoice === 'A') {
                    $score += 2;
                } elseif ($opponentChoice === 'B') {
                    $score += 3;
                } elseif ($opponentChoice === 'C') {
                    $score += 1;
                }
            }
        }
        return $score;
    }
}