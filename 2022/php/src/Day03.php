<?php

declare(strict_types=1);

namespace aoc2022;

class Day03
{
    public static function ExecutePartOne(array $input): int
    {
        $sum = 0;
        foreach ($input as $line) {
            $components = str_split($line, strlen($line) / 2);
            $uniqueItemTypesInFirstCompartment = array_unique(str_split($components[0]));
            foreach ($uniqueItemTypesInFirstCompartment as $character) {
                if (strpos($components[1], $character) !== false) {
                    $sum += self::getPriorityFromCharacter($character);
                }
            }
        }
        return $sum;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $sum = 0;
        $inputInGroupsOfThree = array_chunk($input, 3);
        foreach ($inputInGroupsOfThree as $groupOfThree) {
            $uniqueItemTypesInFirstRucksack = array_unique(str_split($groupOfThree[0]));
            foreach ($uniqueItemTypesInFirstRucksack as $character) {
                if (strpos($groupOfThree[1], $character) !== false && strpos($groupOfThree[2], $character) !== false) {
                    $sum += self::getPriorityFromCharacter($character);
                }
            }
        }
        return $sum;
    }

    public static function getPriorityFromCharacter($character): int
    {
        $asciiValue = ord($character);
        return $asciiValue <= 90 ? $asciiValue - 38 : $asciiValue - 96;
    }
}