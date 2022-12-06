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
        $stacks = [];
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
            if ($moveMultipleCratesTogether) {
                $toBeMoved = [];
                for ($movement = 0; $movement < $instructionData[0]; $movement++) {
                    $thing = array_pop($stacks[$instructionData[1] - 1]);
                    $toBeMoved[] = $thing;
                }
                for ($movement = 0; $movement < $instructionData[0]; $movement++) {
                    $thing = array_pop($toBeMoved);
                    $stacks[$instructionData[2] - 1][] = $thing;
                }
            } else {
                for ($movement = 0; $movement < $instructionData[0]; $movement++) {
                    $thing = array_pop($stacks[$instructionData[1] - 1]);
                    $stacks[$instructionData[2] - 1][] = $thing;
                }
            }
        }
        $result = '';
        foreach ($stacks as $stack) {
            $result = $result . array_pop($stack);
        }
        return $result;
    }
}