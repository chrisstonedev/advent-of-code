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
        $firstAssignmentRange = Day04AssignmentRange::createAssignmentRange($assignments[0]);
        $secondAssignmentRange = Day04AssignmentRange::createAssignmentRange($assignments[1]);
        return [$firstAssignmentRange, $secondAssignmentRange];
    }

    private static function eitherAssignmentRangeFullyContainsTheOther(array $assignmentRanges): bool
    {
        return (self::isAssignmentRangeFullyContainedInTheOther($assignmentRanges[0], $assignmentRanges[1])
            || self::isAssignmentRangeFullyContainedInTheOther($assignmentRanges[1], $assignmentRanges[0]));
    }

    private static function eitherAssignmentRangePartiallyContainsTheOther(array $assignmentRanges): bool
    {
        return self::isAssignmentRangePartiallyContainedInTheOther($assignmentRanges[0], $assignmentRanges[1])
            || self::isAssignmentRangePartiallyContainedInTheOther($assignmentRanges[1], $assignmentRanges[0]);
    }

    private static function isAssignmentRangeFullyContainedInTheOther(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return self::isFirstAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange)
            && self::isLastAssignedSectionTheSameOrBeforeTheLastAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange);
    }

    private static function isAssignmentRangePartiallyContainedInTheOther(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return self::isFirstAssignedSectionTheSameOrBeforeTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange)
            && self::isLastAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange($assignmentRange, $otherAssignmentRange);
    }

    private static function isFirstAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return $assignmentRange->getFirstAssignedSection() >= $otherAssignmentRange->getFirstAssignedSection();
    }

    private static function isLastAssignedSectionTheSameOrBeforeTheLastAssignedSectionOfOtherRange(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return $assignmentRange->getLastAssignedSection() <= $otherAssignmentRange->getLastAssignedSection();
    }

    private static function isFirstAssignedSectionTheSameOrBeforeTheFirstAssignedSectionOfOtherRange(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return $assignmentRange->getFirstAssignedSection() <= $otherAssignmentRange->getFirstAssignedSection();
    }

    private static function isLastAssignedSectionTheSameOrAfterTheFirstAssignedSectionOfOtherRange(
        Day04AssignmentRange $assignmentRange, Day04AssignmentRange $otherAssignmentRange): bool
    {
        return $assignmentRange->getLastAssignedSection() >= $otherAssignmentRange->getFirstAssignedSection();
    }
}