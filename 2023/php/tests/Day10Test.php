<?php

declare(strict_types=1);

namespace test2023;

use aoc2023\Day10 as Day;
use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    const DAY_NUMBER = '10';

    /** @dataProvider part1WithoutFilesProvider */
    public function testPart1WithoutFiles(array $testInput, int $expected)
    {
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1WithoutFilesProvider(): array
    {
        return [
            'distance of 0' => [['S.'], 0],
            'distance of 1' => [['S-'], 1],
            'distance of 2' => [['S-7'], 2],
        ];
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
            'test' => ['test' . self::DAY_NUMBER, 8],
            'input' => ['input' . self::DAY_NUMBER, 6786],
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
            'test' => ['test' . self::DAY_NUMBER, 1],
            'input' => ['input' . self::DAY_NUMBER, 495],
        ];
    }

    /** @dataProvider part2WithoutFilesProvider */
    public function testPart2WithoutFiles(array $input, int $expected)
    {
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2WithoutFilesProvider(): array
    {
        return [
            '3 inside box with no padding' => [['S---7','|...|','L---J'], 3],
            '3 inside box with padding' => [['.S---7.','.|...|.','.L---J.'], 3],
            'box with upper-right corner' => [['.S--7..','.|..L7.','.L---J.'], 2],
            'box with lower-right corner' => [['.S---7.','.|..FJ.','.L--J..'], 2],
            'box with upper-left corner' => [['..S--7.','.FJ..|.','.L---J.'], 2],
            'box with lower-left corner' => [['.S---7.','.L7..|.','..L--J.'], 2],
        ];
    }
}