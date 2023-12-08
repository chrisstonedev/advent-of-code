<?php

declare(strict_types=1);

namespace test2023;

use aoc2023\Day08 as Day;
use PHPUnit\Framework\TestCase;

class Day08Test extends TestCase
{
    const DAY_NUMBER = '08';

    public function testPart1WithoutFile()
    {
        $input = [
            'LLR',
            '',
            'AAA = (BBB, BBB)',
            'BBB = (AAA, ZZZ)',
            'ZZZ = (ZZZ, ZZZ)',
        ];
        $this->assertSame(6, Day::executePartOne($input));
    }

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 2],
            'input' => ['input' . self::DAY_NUMBER, 21883],
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
            'test' => ['test' . self::DAY_NUMBER, 6],
            'input' => ['input' . self::DAY_NUMBER, 0],
        ];
    }
}