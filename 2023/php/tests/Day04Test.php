<?php

namespace test2023;

use aoc2023\Day04 as Day;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    const DAY_NUMBER = '04';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 13],
            'input' => ['input' . self::DAY_NUMBER, 28750],
        ];
    }

    /** @dataProvider part2Provider */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 30],
            'input' => ['input' . self::DAY_NUMBER, 10212704],
        ];
    }
}