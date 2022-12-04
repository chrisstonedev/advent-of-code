<?php

declare(strict_types=1);

namespace aoc2022;

class Day04
{
    public static function executePartOne(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $sectionAssignmentRanges = self::parseSectionAssignmentRanges($line);
            if (self::eitherAssignmentRangeFullyContainsTheOther($sectionAssignmentRanges)) {
                $count++;
            }
        }
        return $count;
    }

    public static function executePartTwo(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $sectionAssignmentRanges = self::parseSectionAssignmentRanges($line);
            if (self::eitherAssignmentRangePartiallyContainsTheOther($sectionAssignmentRanges)) {
                $count++;
            }
        }
        return $count;
    }

    private static function parseSectionAssignmentRanges(string $inputTextLine): array
    {
        $assignments = explode(',', $inputTextLine);
        $firstAssignmentRange = explode('-', $assignments[0]);
        $secondAssignmentRange = explode('-', $assignments[1]);
        return [
            ['first' => intval($firstAssignmentRange[0]), 'last' => intval($firstAssignmentRange[1])],
            ['first' => intval($secondAssignmentRange[0]), 'last' => intval($secondAssignmentRange[1])],
        ];
    }

    private static function eitherAssignmentRangeFullyContainsTheOther(array $assignmentRanges): bool
    {
        return (self::isAssignmentRangeFullyContainedInTheOther($assignmentRanges[0], $assignmentRanges[1]) ||
            self::isAssignmentRangeFullyContainedInTheOther($assignmentRanges[1], $assignmentRanges[0]));
    }

    private static function eitherAssignmentRangePartiallyContainsTheOther(array $assignmentRanges): bool
    {
        return self::isAssignmentRangePartiallyContainedInTheOther($assignmentRanges[0], $assignmentRanges[1]) ||
            self::isAssignmentRangePartiallyContainedInTheOther($assignmentRanges[1], $assignmentRanges[0]);
    }

    private static function isAssignmentRangeFullyContainedInTheOther(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return self::isFirstAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange)
            && self::isLastAssignedSectionTheSameOrBeforeTheLastAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange);
    }

    private static function isAssignmentRangePartiallyContainedInTheOther(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return self::isFirstAssignedSectionTheSameOrBeforeTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange)
            && self::isLastAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange);
    }

    private static function isFirstAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return $assignmentRange['first'] >= $otherAssignmentRange['first'];
    }

    private static function isLastAssignedSectionTheSameOrBeforeTheLastAssignedSectionOfOtherRange(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return $assignmentRange['last'] <= $otherAssignmentRange['last'];
    }

    private static function isFirstAssignedSectionTheSameOrBeforeTheFirstAssignedSectionOfOtherRange(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return $assignmentRange['first'] <= $otherAssignmentRange['first'];
    }

    private static function isLastAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange(array $assignmentRange, array $otherAssignmentRange): bool
    {
        return $assignmentRange['last'] >= $otherAssignmentRange['first'];
    }
}