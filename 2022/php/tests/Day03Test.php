<?php

namespace test2022;

use aoc2022\Day03;
use PHPUnit\Framework\TestCase;

class Day03Test extends TestCase
{
    const DAY_NUMBER = '03';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day03::executePartOne($testInput));
    }

    public function part1Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 157],
            ['input' . self::DAY_NUMBER, 8053],
        ];
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day03::executePartTwo($input));
    }

    public function part2Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 70],
            ['input' . self::DAY_NUMBER, 2425],
        ];
    }
}