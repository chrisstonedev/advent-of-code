<?php

declare(strict_types=1);

namespace aoc2023;

class Day07
{
    public static function executePartOne(array $input): int
    {
        usort($input, function ($x, $y) {
            $xHand = self::getHandType($x);
            $yHand = self::getHandType($y);
            if ($xHand !== $yHand) {
                return $xHand > $yHand ? -1 : 1;
            }

            preg_match_all('/\w+/', $x, $xValues);
            $xCards = str_split($xValues[0][0]);
            preg_match_all('/\w+/', $y, $yValues);
            $yCards = str_split($yValues[0][0]);

            for ($i = 0; $i < count($xCards); $i++) {
                $xValue = self::getCardValue($xCards[$i]);
                $yValue = self::getCardValue($yCards[$i]);
                if ($xValue !== $yValue) {
                    return $xValue > $yValue ? -1 : 1;
                }
            }

            return 0;
        });
        $finalValue = 0;
        for ($i = 0; $i < count($input); $i++) {
            $value = intval(explode(' ', $input[$i])[1]);
            $finalValue += ($value * (count($input) - $i));
        }
        return $finalValue;
    }

    public static function executePartTwo(array $input): int
    {
        usort($input, function ($x, $y) {
            $xHand = self::getHandType($x);
            $yHand = self::getHandType($y);
            if ($xHand !== $yHand) {
                return $xHand > $yHand ? -1 : 1;
            }

            preg_match_all('/\w+/', $x, $xValues);
            $xCards = str_split($xValues[0][0]);
            preg_match_all('/\w+/', $y, $yValues);
            $yCards = str_split($yValues[0][0]);

            for ($i = 0; $i < count($xCards); $i++) {
                $xValue = self::getCardValue($xCards[$i], 0);
                $yValue = self::getCardValue($yCards[$i], 0);
                if ($xValue !== $yValue) {
                    return $xValue > $yValue ? -1 : 1;
                }
            }

            return 0;
        });
        $finalValue = 0;
        for ($i = 0; $i < count($input); $i++) {
            $value = intval(explode(' ', $input[$i])[1]);
            $finalValue += ($value * (count($input) - $i));
        }
        return $finalValue;
    }

    public static function getHandType(string $line): int
    {
        preg_match_all('/\w+/', $line, $values);
        $hand = str_split($values[0][0]);
        $counts = array_count_values($hand);
        if (array_search(5, $counts)) {
            return 6;
        } elseif (array_search(4, $counts)) {
            return 5;
        } elseif (array_search(3, $counts) && array_search(2, $counts)) {
            return 4;
        } elseif (array_search(3, $counts)) {
            return 3;
        } elseif (count(array_keys($counts, 2)) === 2) {
            return 2;
        } elseif (array_search(2, $counts)) {
            return 1;
        } else {
            return 0;
        }
    }

    private static function getCardValue(string|int $card, int $jValue = 11): int
    {
        return match ($card) {
            'A' => 14,
            'K' => 13,
            'Q' => 12,
            'J' => $jValue,
            'T' => 10,
            default => intval($card),
        };
    }
}