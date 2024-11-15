<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day12 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day12Test extends TestCase
{
    const string DAY_NUMBER = '12';

    #[DataProvider('getCombinationsProvider')] public function testGetCombinations(int $totalCharacters, int $questionCharacters, array $expected)
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

    #[DataProvider('replaceStringsProvider')] public function testReplaceStrings(string $stringToBeReplaced, array $stringReplaceIdeas, array $expected)
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

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        if (str_contains($filename, 'input')) {
            $this->markTestSkipped('Test takes way too long to complete.');
        }
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 21],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 7506],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $this->markTestSkipped('Did not solve part 2 in PHP yet.');
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 525152],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 0],
        ];
    }
}