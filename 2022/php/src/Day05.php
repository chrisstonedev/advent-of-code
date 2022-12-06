<?php

declare(strict_types=1);

namespace aoc2022;

class Day05
{
    public static function executePartOne(array $input): string
    {
        return self::getStack($input, false);
    }

    public static function executePartTwo(array $input): string
    {
        return self::getStack($input, true);
    }

    private static function getStack(array $input, bool $moveMultipleCratesTogether): string
    {
        $isInstructions = false;
        $crateGraphicalRepresentation = [];
        $instructions = [];
        foreach ($input as $line) {
            if (strlen($line) === 0) {
                $isInstructions = true;
                continue;
            }
            if ($isInstructions) {
                $instructions[] = $line;
            } else {
                $crateGraphicalRepresentation[] = $line;
            }
        }
        $stacks = [];
        for ($line = count($crateGraphicalRepresentation) - 1; $line >= 0; $line--) {
            if (empty($stacks)) {
                $stackCount = strlen(str_replace(' ', '', $crateGraphicalRepresentation[$line]));
                for ($index = 0; $index < $stackCount; $index++) {
                    $stacks[] = [];
                }
            } else {
                for ($index = 0; $index < count($stacks); $index++) {
                    $value = substr($crateGraphicalRepresentation[$line], 4 * $index + 1, 1);
                    if ($value !== ' ')
                        $stacks[$index][] = $value;
                }
            }
        }
        foreach ($instructions as $instruction) {
            $instructionData = preg_split('/move | from | to /', $instruction, -1, PREG_SPLIT_NO_EMPTY);
            $numberOfCratesToMove = $instructionData[0];
            $indexOfSourceStack = $instructionData[1] - 1;
            $valuesToMove = array_splice($stacks[$indexOfSourceStack], $numberOfCratesToMove * -1);
            if (!$moveMultipleCratesTogether) {
                $valuesToMove = array_reverse($valuesToMove);
            }
            $indexOfDestinationStack = $instructionData[2] - 1;
            $stacks[$indexOfDestinationStack] = array_merge($stacks[$indexOfDestinationStack], $valuesToMove);
        }

        $getTopCrateFromStack = function (array $element) {
            return array_pop($element);
        };
        return implode(array_map($getTopCrateFromStack, $stacks));
    }

}