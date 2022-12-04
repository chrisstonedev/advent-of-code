<?php

declare(strict_types=1);

namespace aoc2022;

class Day04
{
    public static function ExecutePartOne(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $elves = self::GetElfInformation($line);
            // If the one of them starts at the same time or after the other and also ends at the same time or before.
            if (self::EitherElfCompletelyOverlapsAnother($elves)) {
                $count++;
            }
        }
        return $count;
    }

    public static function ExecutePartTwo(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $elves = self::GetElfInformation($line);
            // If the one of them starts at the same time or after the other and also ends at the same time or before.
            if (self::EitherElfPartiallyOverlapsAnother($elves)) {
                $count++;
            }
        }
        return $count;
    }

    private static function GetElfInformation($line): array
    {
        $elves = explode(',', $line);
        $firstElf = array_map('intval', explode('-', $elves[0]));
        $secondElf = array_map('intval', explode('-', $elves[1]));
        return [$firstElf, $secondElf];
    }

    public static function EitherElfCompletelyOverlapsAnother($elves): bool
    {
        $firstStarts = $elves[0][0];
        $firstEnds = $elves[0][1];
        $secondStarts = $elves[1][0];
        $secondEnds = $elves[1][1];
        return ($firstStarts >= $secondStarts && $firstEnds <= $secondEnds) ||
            ($secondStarts >= $firstStarts && $secondEnds <= $firstEnds);
    }

    public static function EitherElfPartiallyOverlapsAnother($elves): bool
    {
        $firstStarts = $elves[0][0];
        $firstEnds = $elves[0][1];
        $secondStarts = $elves[1][0];
        $secondEnds = $elves[1][1];
        return ($firstStarts <= $secondStarts && $firstEnds >= $secondStarts) ||
            ($secondStarts <= $firstStarts && $secondEnds >= $firstStarts);
    }
}