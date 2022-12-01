<?php

namespace test2022;

use aoc2022\Day01 as Day;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    const DAY_NUMBER = 'Day01';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::ExecutePartOne($testInput));
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::ExecutePartTwo($input));
    }

    public function part1Provider(): array
    {
        return [
            [self::DAY_NUMBER . '_test', 24000],
            [self::DAY_NUMBER, 69281],
        ];
    }

    public function part2Provider(): array
    {
        return [
            [self::DAY_NUMBER . '_test', 45000],
            [self::DAY_NUMBER, 201524],
        ];
    }

    public function testMethodReturnsTheExpectedOutputForTestData()
    {
        $input = Utils::ReadAllLines('Day01_test');
        $result = Day::getCaloriesCarriedByEachElfInDescendingOrder($input);
        $this->assertSame([24000, 11000, 10000, 6000, 4000], $result);
    }
}