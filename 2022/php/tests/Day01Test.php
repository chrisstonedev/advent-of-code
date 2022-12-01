<?php

namespace test2022;

use aoc2022\Day01;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    /**
     * @dataProvider day1Part1Provider
     */
    public function testDay1Part1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day01::ExecutePartOne($testInput));
    }

    /**
     * @dataProvider day1Part2Provider
     */
    public function testDay1Part2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day01::ExecutePartTwo($input));
    }

    public function day1Part1Provider(): array
    {
        return [
            ['Day01_test', 24000],
            ['Day01', 69281],
        ];
    }

    public function day1Part2Provider(): array
    {
        return [
            ['Day01_test', 45000],
            ['Day01', 201524],
        ];
    }

    public function testDay1MethodReturnsTheExpectedOutputForTestData()
    {
        $input = Utils::ReadAllLines('Day01_test');
        $result = Day01::getCaloriesCarriedByEachElfInDescendingOrder($input);
        $this->assertSame([24000, 11000, 10000, 6000, 4000], $result);
    }
}