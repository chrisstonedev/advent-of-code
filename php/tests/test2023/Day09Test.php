<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day09 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day09Test extends TestCase
{
    const string DAY_NUMBER = '09';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 114],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 1647269739],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 2],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 864],
        ];
    }
}