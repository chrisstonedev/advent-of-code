<?php

declare(strict_types=1);

namespace aoc2022;

class Day04
{
    public static function ExecutePartOne(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $components = explode(',', $line);
            $firstElf = explode('-', $components[0]);
            $secondElf = explode('-', $components[1]);
            $firstStarts = intval($firstElf[0]);
            $firstEnds = intval($firstElf[1]);
            $secondStarts = intval($secondElf[0]);
            $secondEnds = intval($secondElf[1]);
            // If the one of them starts at the same time or after the other and also ends at the same time or before.
            if (($firstStarts >= $secondStarts && $firstEnds <= $secondEnds) ||
                ($secondStarts >= $firstStarts && $secondEnds <= $firstEnds)) {
                $count++;
            }
        }
        return $count;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $components = explode(',', $line);
            $firstElf = explode('-', $components[0]);
            $secondElf = explode('-', $components[1]);
            $firstStarts = intval($firstElf[0]);
            $firstEnds = intval($firstElf[1]);
            $secondStarts = intval($secondElf[0]);
            $secondEnds = intval($secondElf[1]);
            // If the one of them starts at the same time or after the other and also ends at the same time or before.
            if (($firstStarts <= $secondStarts && $firstEnds >= $secondStarts) || ($secondStarts <= $firstStarts && $secondEnds >= $firstStarts)) {
                $count++;
            }
        }
        return $count;
    }
}