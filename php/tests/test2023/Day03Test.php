<?php

namespace test\test2023;

use aoc\aoc2023\Day03 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day03Test extends TestCase
{
    const string DAY_NUMBER = '03';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 4361],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 521601],
        ];
    }

    #[DataProvider('part1WithoutFilesProvider')] public function testPart1WithoutFiles(array $contents, int $expected)
    {
        $this->assertSame($expected, Day::executePartOne($contents));
    }

    public static function part1WithoutFilesProvider(): array
    {
        return [
            'a single part number' => [['456*'], 456],
            'sum of two part numbers' => [['456*2'], 458],
            'a single number with no part' => [['456.'], 0],
        ];
    }

    #[DataProvider('determineNumberIsForPartProvider')] public function testDetermineNumberIsForPart(array $parts, string $numberStart, int $numberLength, bool $expected)
    {
        $this->assertSame($expected, Day::determineNumberIsForPart($parts, $numberStart, $numberLength));
    }

    public static function determineNumberIsForPartProvider(): array
    {
        return [
            'part precedes number' => [['0,0'], '1,0', 1, true],
            'part is too far from number' => [['0,0'], '2,0', 1, false],
            'part succeeds number' => [['2,0'], '1,0', 1, true],
            'part succeeds long number' => [['4,0'], '1,0', 3, true],
            'part is in top-left corner' => [['0,0'], '1,1', 3, true],
            'part is in bottom-right corner' => [['4,1'], '1,0', 3, true],
            'part is out of reach beyond bottom-right corner' => [['5,1'], '1,0', 3, false],
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
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 467835],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 80694070],
        ];
    }
}