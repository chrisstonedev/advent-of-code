<?php

namespace test\test2022;

use aoc\aoc2022\Day02;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day02Test extends TestCase
{
    const string DAY_NUMBER = '02';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day02::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 15],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 12535],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day02::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            [sprintf("2022_%s_test", self::DAY_NUMBER), 12],
            [sprintf("2022_%s_input", self::DAY_NUMBER), 15457],
        ];
    }
}