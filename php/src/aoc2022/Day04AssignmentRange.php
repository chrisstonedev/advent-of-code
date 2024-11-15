<?php

namespace aoc\aoc2022;

class Day04AssignmentRange
{
    function __construct(int $firstAssignedSection, int $lastAssignedSection)
    {
        $this->firstAssignedSection = $firstAssignedSection;
        $this->lastAssignedSection = $lastAssignedSection;
    }

    private int $firstAssignedSection;
    private int $lastAssignedSection;

    public static function createAssignmentRange(string $rangeAsHyphenSeparatedNumbersText): Day04AssignmentRange
    {
        $firstAssignmentRange = array_map('intval', explode('-', $rangeAsHyphenSeparatedNumbersText));
        return new Day04AssignmentRange($firstAssignmentRange[0], $firstAssignmentRange[1]);
    }

    public function getFirstAssignedSection(): int
    {
        return $this->firstAssignedSection;
    }

    public function getLastAssignedSection(): int
    {
        return $this->lastAssignedSection;
    }

    public function contains(Day04AssignmentRange $assignmentRange): bool
    {
        return $this->getFirstAssignedSection() <= $assignmentRange->getFirstAssignedSection()
            && $this->getLastAssignedSection() >= $assignmentRange->getLastAssignedSection();
    }

    public function overlaps(Day04AssignmentRange $assignmentRange): bool
    {
        return $this->getFirstAssignedSection() <= $assignmentRange->getFirstAssignedSection()
            ? $this->getLastAssignedSection() >= $assignmentRange->getFirstAssignedSection()
            : $this->getFirstAssignedSection() <= $assignmentRange->getLastAssignedSection();
    }

}