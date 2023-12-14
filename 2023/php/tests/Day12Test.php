<?php

declare(strict_types=1);

namespace test2023;

use aoc2023\Day12 as Day;
use PHPUnit\Framework\TestCase;

class Day12Test extends TestCase
{
    const DAY_NUMBER = '12';

    /** @dataProvider getCombinationsProvider */
    public function testGetCombinations(int $totalCharacters, int $questionCharacters, array $expected)
    {
        $actual = Day::getCombinations($totalCharacters, $questionCharacters);
        $this->assertSame($expected, $actual);
    }

    public static function getCombinationsProvider(): array
    {
        return [
            [1, 1, ['#']],
            [2, 1, ['#.', '.#']],
            [2, 2, ['##']],
            [3, 1, ['#..', '.#.', '..#']],
            [3, 2, ['##.', '#.#', '.##']],
            [3, 3, ['###']],
            [4, 1, ['#...', '.#..', '..#.', '...#']],
            [4, 2, ['##..', '#.#.', '#..#', '.##.', '.#.#', '..##']],
            [4, 3, ['###.', '##.#', '#.##', '.###']],
            [4, 4, ['####']],
            [5, 3, ['###..', '##.#.', '##..#', '#.##.', '#.#.#', '#..##', '.###.', '.##.#', '.#.##', '..###']],
            [8, 4, ['####....', '###.#...', '###..#..', '###...#.', '###....#', '##.##...', '##.#.#..', '##.#..#.', '##.#...#', '##..##..', '##..#.#.', '##..#..#', '##...##.', '##...#.#', '##....##', '#.###...', '#.##.#..', '#.##..#.', '#.##...#', '#.#.##..', '#.#.#.#.', '#.#.#..#', '#.#..##.', '#.#..#.#', '#.#...##', '#..###..', '#..##.#.', '#..##..#', '#..#.##.', '#..#.#.#', '#..#..##', '#...###.', '#...##.#', '#...#.##', '#....###', '.####...', '.###.#..', '.###..#.', '.###...#', '.##.##..', '.##.#.#.', '.##.#..#', '.##..##.', '.##..#.#', '.##...##', '.#.###..', '.#.##.#.', '.#.##..#', '.#.#.##.', '.#.#.#.#', '.#.#..##', '.#..###.', '.#..##.#', '.#..#.##', '.#...###', '..####..', '..###.#.', '..###..#', '..##.##.', '..##.#.#', '..##..##', '..#.###.', '..#.##.#', '..#.#.##', '..#..###', '...####.', '...###.#', '...##.##', '...#.###', '....####']],
        ];
    }

    /** @dataProvider replaceStringsProvider */
    public function testReplaceStrings(string $stringToBeReplaced, array $stringReplaceIdeas, array $expected)
    {
        $actual = Day::replaceStrings($stringToBeReplaced, $stringReplaceIdeas);
        $this->assertSame($expected, $actual);
    }

    public static function replaceStringsProvider(): array
    {
        return [
            ['.?.', ['#'], ['.#.']],
            ['.?.?', ['#.', '.#'], ['.#..', '...#']],
            ['.??.', ['##'], ['.##.']],
            ['??.?', ['#..', '.#.', '..#'], ['#...', '.#..', '...#']],
            ['?.??', ['##.', '#.#', '.##'], ['#.#.', '#..#', '..##']],
            ['?.?.?', ['###'], ['#.#.#']],
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
            'test' => ['test' . self::DAY_NUMBER, 21],
            'input' => ['input' . self::DAY_NUMBER, 7506],
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
            'test' => ['test' . self::DAY_NUMBER, 525152],
//            'input' => ['input' . self::DAY_NUMBER, 0],
        ];
    }
}