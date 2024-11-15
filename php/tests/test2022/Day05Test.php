<?php

namespace test\test2022;

use aoc\aoc2022\Day05 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day05Test extends TestCase
{
    const string DAY_NUMBER = '05';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, string $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test data' => [sprintf("2022_%s_test", self::DAY_NUMBER), 'CMZ'],
            'my puzzle input' => [sprintf("2022_%s_input", self::DAY_NUMBER), 'TPGVQPFDH'],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, string $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test data' => [sprintf("2022_%s_test", self::DAY_NUMBER), 'MCD'],
            'my puzzle input' => [sprintf("2022_%s_input", self::DAY_NUMBER), 'DMRDFRHHH'],
        ];
    }
}