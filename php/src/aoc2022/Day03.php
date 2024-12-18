<?php

declare(strict_types=1);

namespace aoc\aoc2022;

class Day03
{
    public static function executePartOne(array $input): int
    {
        $sum = 0;
        foreach ($input as $line) {
            $components = str_split($line, strlen($line) / 2);
            $uniqueItemTypesInFirstCompartment = array_unique(str_split($components[0]));
            foreach ($uniqueItemTypesInFirstCompartment as $character) {
                if (str_contains($components[1], $character)) {
                    $sum += self::getPriorityFromCharacter($character);
                }
            }
        }
        return $sum;
    }

    public static function executePartTwo(array $input): int
    {
        $sum = 0;
        $inputInGroupsOfThree = array_chunk($input, 3);
        foreach ($inputInGroupsOfThree as $groupOfThree) {
            $uniqueItemTypesInFirstRucksack = array_unique(str_split($groupOfThree[0]));
            foreach ($uniqueItemTypesInFirstRucksack as $character) {
                if (str_contains($groupOfThree[1], $character) && str_contains($groupOfThree[2], $character)) {
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