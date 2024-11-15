<?php

declare(strict_types=1);

namespace aoc\aoc2023;

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
            $xHand = self::getBestHandType($x);
            $yHand = self::getBestHandType($y);
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

    public static function getBestHandType(string $line): int
    {
        if (!str_contains($line, 'J')) {
            return self::getHandType($line);
        }
        $allHandCounts = self::getAllHandCounts($line);
        foreach ($allHandCounts as $counts) {
            if (array_search(5, $counts)) {
                return 6;
            }
        }
        foreach ($allHandCounts as $counts) {
            if (array_search(4, $counts)) {
                return 5;
            }
        }
        foreach ($allHandCounts as $counts) {
            if (array_search(3, $counts) && array_search(2, $counts)) {
                return 4;
            }
        }
        foreach ($allHandCounts as $counts) {
            if (array_search(3, $counts)) {
                return 3;
            }
        }
        foreach ($allHandCounts as $counts) {
            if (count(array_keys($counts, 2)) === 2) {
                return 2;
            }
        }
        foreach ($allHandCounts as $counts) {
            if (array_search(2, $counts)) {
                return 1;
            }
        }
        return 0;
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

    private static function getAllHandCounts(string $line): array
    {
        $data = [];
        $letters = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'T', 'Q', 'K'];
        foreach ($letters as $letter) {
            $attempt = str_replace('J', $letter, $line);
            preg_match_all('/\w+/', $attempt, $values);
            $hand = str_split($values[0][0]);
            $data[] = array_count_values($hand);
        }
        return $data;
    }
}