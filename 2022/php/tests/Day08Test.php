<?php

namespace test2022;

use aoc2022\Day08 as Day;
use PHPUnit\Framework\TestCase;

class Day08Test extends TestCase
{
    const DAY_NUMBER = '08';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public function part1Provider(): array
    {
        return [
            'test data' => ['test' . self::DAY_NUMBER, 21],
            'my puzzle input' => ['input' . self::DAY_NUMBER, 1835],
        ];
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public function part2Provider(): array
    {
        return [
            'test data' => ['test' . self::DAY_NUMBER, 8],
            'my puzzle input' => ['input' . self::DAY_NUMBER, 263670],
        ];
    }
}