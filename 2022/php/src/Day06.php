<?php

declare(strict_types=1);

namespace aoc2022;

class Day06
{
    public static function executePartOne(string $input): int
    {
        return self::findMarkerByIndexAfterSpecifiedAmountOfUniqueCharacters($input, 4);
    }

    public static function executePartTwo(string $input): int
    {
        return self::findMarkerByIndexAfterSpecifiedAmountOfUniqueCharacters($input, 14);
    }

    private static function findMarkerByIndexAfterSpecifiedAmountOfUniqueCharacters(string $input, int $numberOfUniqueCharacters): int
    {
        for ($indexToTest = $numberOfUniqueCharacters; $indexToTest <= strlen($input); $indexToTest++) {
            $potentialMarker = substr($input, $indexToTest - $numberOfUniqueCharacters, $numberOfUniqueCharacters);
            if (self::areAllCharactersUnique($potentialMarker)) {
                return $indexToTest;
            }
        }
        return -1;
    }

    private static function areAllCharactersUnique(string $potentialMarker): bool
    {
        $numberOfUniqueCharacters = strlen($potentialMarker);
        for ($i = 0; $i < $numberOfUniqueCharacters - 1; $i++) {
            for ($j = $i + 1; $j < $numberOfUniqueCharacters; $j++) {
                if ($potentialMarker[$i] === $potentialMarker[$j]) {
                    return false;
                }
            }
        }
        return true;
    }
}