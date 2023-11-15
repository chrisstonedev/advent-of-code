<?php

namespace test2022;

use aoc2022\Day01 as Day;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    const DAY_NUMBER = '01';

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
            ['test' . self::DAY_NUMBER, 24000],
            ['input' . self::DAY_NUMBER, 69281],
        ];
    }

    public function part2Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 45000],
            ['input' . self::DAY_NUMBER, 201524],
        ];
    }

    public function testMethodReturnsTheExpectedOutputForTestData()
    {
        $input = Utils::ReadAllLines('test01');
        $result = Day::getCaloriesCarriedByEachElfInDescendingOrder($input);
        $this->assertSame([24000, 11000, 10000, 6000, 4000], $result);
    }
}