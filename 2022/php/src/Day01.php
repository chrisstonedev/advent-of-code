<?php

declare(strict_types=1);

namespace aoc2022;

class Day01
{
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
        $caloriesForCurrentElf = 0;
        $caloriesForEachElf = [];
        for ($i = 0; $i < count($input); $i++) {
            if ($input[$i] !== '') {
                $caloriesForCurrentElf += intval($input[$i]);
            }
            if ($input[$i] === '' || $i === count($input) - 1) {
                $caloriesForEachElf[] = $caloriesForCurrentElf;
                $caloriesForCurrentElf = 0;
            }
        }

        rsort($caloriesForEachElf);
        return $caloriesForEachElf;
    }
}