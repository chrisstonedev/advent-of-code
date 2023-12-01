<?php

namespace test2023;

use aoc2023\Day01 as Day;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    const DAY_NUMBER = '01';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::ExecutePartOne($testInput));
    }

    /** @dataProvider part2Provider */
    public function testPart2(string $filename, int $expected)
    {
        $this->markTestSkipped('not yet implemented');
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::ExecutePartTwo($input));
    }

    public static function part1Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 142],
//            ['input' . self::DAY_NUMBER, 0],
        ];
    }

    public static function part2Provider(): array
    {
        return [
            ['test' . self::DAY_NUMBER, 0],
//            ['input' . self::DAY_NUMBER, 0],
        ];
    }
}