<?php

namespace test2022;

use aoc2022\Day04 as Day;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    const DAY_NUMBER = 'Day04';

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
            [self::DAY_NUMBER . '_test', 2],
            [self::DAY_NUMBER, 576],
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
            [self::DAY_NUMBER . '_test', 4],
            [self::DAY_NUMBER, 905],
        ];
    }
}