<?php

declare(strict_types=1);

namespace aoc\aoc2022;

use InvalidArgumentException;

class Day02
{
    public static function executePartOne(array $input): int
    {
        $score = 0;
        foreach ($input as $line) {
            $lineData = explode(' ', $line);
            $opponentChoice = $lineData[0];
            $playerChoice = $lineData[1];
            $score += self::getScoreFromRoundBasedOnBothHands($opponentChoice, $playerChoice);
        }
        return $score;
    }

    public static function executePartTwo(array $input): int
    {
        $score = 0;
        foreach ($input as $line) {
            $lineData = explode(' ', $line);
            $opponentChoice = $lineData[0];
            $result = $lineData[1];
            $score += self::getScoreBasedOnOpponentHandAndEndResult($opponentChoice, $result);
        }
        return $score;
    }

    const string HAND_ROCK = 'r';
    const string HAND_PAPER = 'p';
    const string HAND_SCISSORS = 's';
    const string RESULT_LOSE = 'l';
    const string RESULT_DRAW = 'd';
    const string RESULT_WIN = 'w';

    private static function getScoreFromRoundBasedOnBothHands(string $opponentChoice, string $playerChoice): int
    {
        $opponentHand = self::getOpponentHandFromChoiceCode($opponentChoice);
        $playerHand = match ($playerChoice) {
            'X' => self::HAND_ROCK,
            'Y' => self::HAND_PAPER,
            'Z' => self::HAND_SCISSORS,
            default => throw new InvalidArgumentException('Player choice code is always X, Y, or Z'),
        };
        $result = match ([$opponentHand, $playerHand]) {
            [self::HAND_ROCK, self::HAND_PAPER], [self::HAND_PAPER, self::HAND_SCISSORS], [self::HAND_SCISSORS, self::HAND_ROCK] => self::RESULT_WIN,
            [self::HAND_ROCK, self::HAND_ROCK], [self::HAND_PAPER, self::HAND_PAPER], [self::HAND_SCISSORS, self::HAND_SCISSORS] => self::RESULT_DRAW,
            default => self::RESULT_LOSE,
        };
        return self::getScore($playerHand, $result);
    }

    private static function getScoreBasedOnOpponentHandAndEndResult(string $opponentChoice, string $resultCode): int
    {
        $opponentHand = self::getOpponentHandFromChoiceCode($opponentChoice);
        $result = match ($resultCode) {
            'X' => self::RESULT_LOSE,
            'Y' => self::RESULT_DRAW,
            'Z' => self::RESULT_WIN,
            default => throw new InvalidArgumentException('Result code is always X, Y, or Z'),
        };
        $playerHand = match ([$opponentHand, $result]) {
            [self::HAND_ROCK, self::RESULT_DRAW], [self::HAND_PAPER, self::RESULT_LOSE], [self::HAND_SCISSORS, self::RESULT_WIN] => self::HAND_ROCK,
            [self::HAND_ROCK, self::RESULT_WIN], [self::HAND_PAPER, self::RESULT_DRAW], [self::HAND_SCISSORS, self::RESULT_LOSE] => self::HAND_PAPER,
            default => self::HAND_SCISSORS,
        };
        return self::getScore($playerHand, $result);
    }

    private static function getOpponentHandFromChoiceCode(string $opponentChoice): string
    {
        return match ($opponentChoice) {
            'A' => self::HAND_ROCK,
            'B' => self::HAND_PAPER,
            'C' => self::HAND_SCISSORS,
            default => throw new InvalidArgumentException('Opponent choice is always A, B, or C'),
        };
    }

    private static function getScore(string $playerChoice, string $result): int
    {
        return self::getScoreFromPlayerHand($playerChoice) + self::getScoreFromResult($result);
    }

    private static function getScoreFromPlayerHand(string $playerChoice): int
    {
        return match ($playerChoice) {
            self::HAND_ROCK => 1,
            self::HAND_PAPER => 2,
            self::HAND_SCISSORS => 3,
            default => 0,
        };
    }

    private static function getScoreFromResult(string $result): int
    {
        return match ($result) {
            self::RESULT_WIN => 6,
            self::RESULT_DRAW => 3,
            default => 0,
        };
    }
}