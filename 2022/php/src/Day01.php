<?php

declare(strict_types=1);

namespace aoc2022;

class Day01
{
    const INTEGER_MAP = 'intval';

    public static function ExecutePartOne(array $input): int
    {
        $caloriesCarriedByEachElf = self::getCaloriesCarriedByEachElfInDescendingOrder($input);
        return $caloriesCarriedByEachElf[0];
    }

    public static function ExecutePartTwo(array $input): int
    {
        $caloriesCarriedByEachElf = self::getCaloriesCarriedByEachElfInDescendingOrder($input);
        return $caloriesCarriedByEachElf[0] + $caloriesCarriedByEachElf[1] + $caloriesCarriedByEachElf[2];
    }

    public static function getCaloriesCarriedByEachElfInDescendingOrder(array $input): array
    {
        $inputAsIntegers = array_map(self::INTEGER_MAP, $input);
        $calorieList = [];
        $sums = [];
        for ($i = 0; $i < count($inputAsIntegers); $i++) {
            if ($inputAsIntegers[$i] > 0) {
                $calorieList[] = $inputAsIntegers[$i];
            } else {
                $sums[] = array_sum($calorieList);
                $calorieList = [];
            }
        }
        $sums[] = array_sum($calorieList);

        rsort($sums);
        return $sums;
    }
}