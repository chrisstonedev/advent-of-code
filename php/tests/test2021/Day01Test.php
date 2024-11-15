<?php

namespace test\test2021;

use aoc\aoc2021\Day01;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day01Test extends TestCase
{
    #[DataProvider('day1Part1Provider')] public function testDay1Part1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day01::ExecutePartOne($testInput));
    }

    #[DataProvider('day1Part2Provider')] public function testDay1Part2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day01::ExecutePartTwo($input));
    }

    public static function day1Part1Provider(): array
    {
        return [['2021_01_test', 7], ['2021_01_input', 1713]];
    }

    public static function day1Part2Provider(): array
    {
        return [['2021_01_test', 5], ['2021_01_input', 1734]];
    }
}