<?php

namespace test2022;

use aoc2022\Day05 as Day;
use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
{
    const DAY_NUMBER = 'Day05';

    /**
     * @dataProvider part1Provider
     */
    public function testPart1(string $filename, string $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public function part1Provider(): array
    {
        return [
            'test data' => [self::DAY_NUMBER . '_test', 'CMZ'],
            'my puzzle input' => [self::DAY_NUMBER, 'TPGVQPFDH'],
        ];
    }

    /**
     * @dataProvider part2Provider
     */
    public function testPart2(string $filename, string $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public function part2Provider(): array
    {
        return [
            'test data' => [self::DAY_NUMBER . '_test', 'MCD'],
            'my puzzle input' => [self::DAY_NUMBER, 'DMRDFRHHH'],
        ];
    }
}