<?php

declare(strict_types=1);

namespace aoc2022;

class Day04
{
    public static function executePartOne(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $assignments = explode(',', $line);
            $assignmentRange1 = Day04AssignmentRange::createAssignmentRange($assignments[0]);
            $assignmentRange2 = Day04AssignmentRange::createAssignmentRange($assignments[1]);
            if ($assignmentRange1->contains($assignmentRange2) || $assignmentRange2->contains($assignmentRange1)) {
                $count++;
            }
        }
        return $count;
    }

    public static function executePartTwo(array $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            $assignments = explode(',', $line);
            $assignmentRange1 = Day04AssignmentRange::createAssignmentRange($assignments[0]);
            $assignmentRange2 = Day04AssignmentRange::createAssignmentRange($assignments[1]);
            if ($assignmentRange1->overlaps($assignmentRange2)) {
                $count++;
            }
        }
        return $count;
    }
}