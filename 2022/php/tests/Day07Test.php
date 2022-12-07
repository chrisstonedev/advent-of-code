<?php

namespace test2022;

use aoc2022\Day07 as Day;
use PHPUnit\Framework\TestCase;

class Day07Test extends TestCase
{
    const DAY_NUMBER = 'Day07';

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
            'test data' => [self::DAY_NUMBER . '_test', 95437],
            'my puzzle input' => [self::DAY_NUMBER, 1642503],
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
            'test data' => [self::DAY_NUMBER . '_test', 24933642],
            'my puzzle input' => [self::DAY_NUMBER, 6999588],
        ];
    }
}