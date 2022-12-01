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
        foreach ($input as $index => $calories) {
            if ($calories !== '') {
                $caloriesForCurrentElf += intval($calories);
            }
            if ($calories === '' || $index === count($input) - 1) {
                $caloriesForEachElf[] = $caloriesForCurrentElf;
                $caloriesForCurrentElf = 0;
            }
        }

        rsort($caloriesForEachElf);
        return $caloriesForEachElf;
    }
}