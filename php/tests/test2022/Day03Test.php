<?php

namespace test\test2022;

use aoc\aoc2022\Day03;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day03Test extends TestCase
{
    const string DAY_NUMBER = '03';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day03::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 157],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 8053],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day03::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 70],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 2425],
        ];
    }
}