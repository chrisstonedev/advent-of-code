<?php

declare(strict_types=1);

namespace test2023;

use aoc2023\Day07 as Day;
use PHPUnit\Framework\TestCase;

class Day07Test extends TestCase
{
    const DAY_NUMBER = '07';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 6440],
            'input' => ['input' . self::DAY_NUMBER, 249204891],
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
            'test' => ['test' . self::DAY_NUMBER, 5905],
//            'input' => ['input' . self::DAY_NUMBER, 42250895],
        ];
    }
}