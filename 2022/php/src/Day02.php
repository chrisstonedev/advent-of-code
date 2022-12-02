<?php

declare(strict_types=1);

namespace aoc2022;

use InvalidArgumentException;

class Day02
{
    public static function ExecutePartOne(array $input): int
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

    public static function ExecutePartTwo(array $input): int
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

    const HAND_ROCK = 'r';
    const HAND_PAPER = 'p';
    const HAND_SCISSORS = 's';
    const RESULT_LOSE = 'l';
    const RESULT_DRAW = 'd';
    const RESULT_WIN = 'w';

    private static function getScoreFromRoundBasedOnBothHands(string $opponentChoice, string $playerChoice): int
    {
        $opponentHand = self::getOpponentHandFromChoiceCode($opponentChoice);
        switch ($playerChoice) {
            case 'X':
                $playerHand = self::HAND_ROCK;
                break;
            case 'Y':
                $playerHand = self::HAND_PAPER;
                break;
            case 'Z':
                $playerHand = self::HAND_SCISSORS;
                break;
            default:
                throw new InvalidArgumentException('Player choice code is always X, Y, or Z');
        }
        switch ([$opponentHand, $playerHand]) {
            case [self::HAND_ROCK, self::HAND_PAPER]:
            case [self::HAND_PAPER, self::HAND_SCISSORS]:
            case [self::HAND_SCISSORS, self::HAND_ROCK]:
                $result = self::RESULT_WIN;
                break;
            case [self::HAND_ROCK, self::HAND_ROCK]:
            case [self::HAND_PAPER, self::HAND_PAPER]:
            case [self::HAND_SCISSORS, self::HAND_SCISSORS]:
                $result = self::RESULT_DRAW;
                break;
            case [self::HAND_ROCK, self::HAND_SCISSORS]:
            case [self::HAND_PAPER, self::HAND_ROCK]:
            case [self::HAND_SCISSORS, self::HAND_PAPER]:
            default:
                $result = self::RESULT_LOSE;
                break;
        }
        return self::getScore($playerHand, $result);
    }

    private static function getScoreBasedOnOpponentHandAndEndResult(string $opponentChoice, string $resultCode): int
    {
        $opponentHand = self::getOpponentHandFromChoiceCode($opponentChoice);
        switch ($resultCode) {
            case 'X':
                $result = self::RESULT_LOSE;
                break;
            case 'Y':
                $result = self::RESULT_DRAW;
                break;
            case 'Z':
                $result = self::RESULT_WIN;
                break;
            default:
                throw new InvalidArgumentException('Result code is always X, Y, or Z');
        }
        switch ([$opponentHand, $result]) {
            case [self::HAND_ROCK, self::RESULT_DRAW]:
            case [self::HAND_PAPER, self::RESULT_LOSE]:
            case [self::HAND_SCISSORS, self::RESULT_WIN]:
                $playerHand = self::HAND_ROCK;
                break;
            case [self::HAND_ROCK, self::RESULT_WIN]:
            case [self::HAND_PAPER, self::RESULT_DRAW]:
            case [self::HAND_SCISSORS, self::RESULT_LOSE]:
                $playerHand = self::HAND_PAPER;
                break;
            case [self::HAND_ROCK, self::RESULT_LOSE]:
            case [self::HAND_PAPER, self::RESULT_WIN]:
            case [self::HAND_SCISSORS, self::RESULT_DRAW]:
            default:
                $playerHand = self::HAND_SCISSORS;
                break;
        }
        return self::getScore($playerHand, $result);
    }

    private static function getOpponentHandFromChoiceCode(string $opponentChoice): string
    {
        switch ($opponentChoice) {
            case 'A':
                $opponentHand = self::HAND_ROCK;
                break;
            case 'B':
                $opponentHand = self::HAND_PAPER;
                break;
            case 'C':
                $opponentHand = self::HAND_SCISSORS;
                break;
            default:
                throw new InvalidArgumentException('Opponent choice is always A, B, or C');
        }
        return $opponentHand;
    }

    private static function getScore(string $playerChoice, string $result): int
    {
        return self::getScoreFromPlayerHand($playerChoice) + self::getScoreFromResult($result);
    }

    private static function getScoreFromPlayerHand(string $playerChoice): int
    {
        switch ($playerChoice) {
            case self::HAND_ROCK:
                return 1;
            case self::HAND_PAPER:
                return 2;
            case self::HAND_SCISSORS:
                return 3;
            default:
                return 0;
        }
    }

    private static function getScoreFromResult(string $result): int
    {
        switch ($result) {
            case self::RESULT_WIN:
                return 6;
            case self::RESULT_DRAW:
                return 3;
            case self::RESULT_LOSE:
            default:
                return 0;
        }
    }
}