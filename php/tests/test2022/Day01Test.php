<?php

namespace test\test2022;

use aoc\aoc2022\Day01 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day01Test extends TestCase
{
    const string DAY_NUMBER = '01';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part1Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 24000],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 69281],
        ];
    }

    public static function part2Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 45000],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 201524],
        ];
    }

    public function testMethodReturnsTheExpectedOutputForTestData()
    {
        $input = Utils::ReadAllLines('2022_01_test');
        $result = Day::getCaloriesCarriedByEachElfInDescendingOrder($input);
        $this->assertSame([24000, 11000, 10000, 6000, 4000], $result);
    }
}