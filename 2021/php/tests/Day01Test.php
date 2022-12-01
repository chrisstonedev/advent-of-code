<?php

namespace test2021;

use aoc2021\Day01;
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
        return [['Day01_test', 7], ['Day01', 1713]];
    }

    public function day1Part2Provider(): array
    {
        return [['Day01_test', 5], ['Day01', 1734]];
    }
}