<?php

namespace test2022;

use aoc2022\Day02;
use PHPUnit\Framework\TestCase;

class Day02Test extends TestCase
{
    const DAY_NUMBER = '02';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day02::executePartOne($testInput));
    }

    public function part1Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 15],
            ['input' . self::DAY_NUMBER, 12535],
        ];
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day02::executePartTwo($input));
    }

    public function part2Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 12],
            ['input' . self::DAY_NUMBER, 15457],
        ];
    }
}