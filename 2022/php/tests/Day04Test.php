<?php

namespace test2022;

use aoc2022\Day04 as Day;
use aoc2022\Day04AssignmentRange;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    const DAY_NUMBER = 'Day04';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public function part1Provider(): array
    {
        return [
            'test data' => [self::DAY_NUMBER . '_test', 2],
            'my puzzle input' => [self::DAY_NUMBER, 576],
        ];
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public function part2Provider(): array
    {
        return [
            'test data' => [self::DAY_NUMBER . '_test', 4],
            'my puzzle input' => [self::DAY_NUMBER, 905],
        ];
    }

    /**
     * @dataProvider assignmentRangeContainsProvider
     */
    public function testAssignmentRangeContains(
        int  $firstRangeFirstSection,
        int  $firstRangeLastSection,
        int  $secondRangeFirstSection,
        int  $secondRangeLastSection,
        bool $expected)
    {
        $assignmentRange1 = new Day04AssignmentRange($firstRangeFirstSection, $firstRangeLastSection);
        $assignmentRange2 = new Day04AssignmentRange($secondRangeFirstSection, $secondRangeLastSection);
        $actual = $assignmentRange1->contains($assignmentRange2);
        $this->assertSame($expected, $actual);
    }

    public function assignmentRangeContainsProvider(): array
    {
        return [
            'assignments have no overlap' => [2, 4, 6, 8, false],
            'second assignment is fully contained in the first' => [2, 8, 4, 6, true],
            'first assignment is fully contained in the second' => [4, 6, 2, 8, false],
            'last section of first assignment matches first section in second assignment' => [2, 8, 8, 10, false],
            'first section of first assignment matches last section in second assignment' => [8, 10, 2, 8, false],
        ];
    }

    /**
     * @dataProvider assignmentRangeOverlapsProvider
     */
    public function testAssignmentRangeOverlaps(
        int  $firstRangeFirstSection,
        int  $firstRangeLastSection,
        int  $secondRangeFirstSection,
        int  $secondRangeLastSection,
        bool $expected)
    {
        $assignmentRange1 = new Day04AssignmentRange($firstRangeFirstSection, $firstRangeLastSection);
        $assignmentRange2 = new Day04AssignmentRange($secondRangeFirstSection, $secondRangeLastSection);
        $actual = $assignmentRange1->overlaps($assignmentRange2);
        $this->assertSame($expected, $actual);
    }

    public function assignmentRangeOverlapsProvider(): array
    {
        return [
            'assignments have no overlap' => [2, 4, 6, 8, false],
            'second assignment is fully contained in the first' => [2, 8, 4, 6, true],
            'first assignment is fully contained in the second' => [4, 6, 2, 8, true],
            'last section of first assignment matches first section in second assignment' => [2, 8, 8, 10, true],
            'first section of first assignment matches last section in second assignment' => [8, 10, 2, 8, true],
        ];
    }
}