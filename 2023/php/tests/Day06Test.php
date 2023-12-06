<?php

namespace test2023;

use aoc2023\Day06 as Day;
use PHPUnit\Framework\TestCase;

class Day06Test extends TestCase
{
    const DAY_NUMBER = '06';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 288],
            'input' => ['input' . self::DAY_NUMBER, 449820],
        ];
    }

    /** @dataProvider part2Provider */
    public function testPart2(string $filename, int $expected)
    {
        $input = \test2023\Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 71503],
            'input' => ['input' . self::DAY_NUMBER, 42250895],
        ];
    }
}