<?php

namespace test\test2022;

use aoc\aoc2022\Day06 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day06Test extends TestCase
{
    const string DAY_NUMBER = '06';

    #[DataProvider('part1FromFileProvider')] public function testPart1FromFile(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput[0]));
    }

    public static function part1FromFileProvider(): array
    {
        return [
            'test data' => [sprintf("2022_%s_test", self::DAY_NUMBER), 7],
            'my puzzle input' => [sprintf("2022_%s_input", self::DAY_NUMBER), 1480],
        ];
    }

    #[DataProvider('part1FromStringProvider')] public function testPart1FromString(string $input, int $expected)
    {
        $this->assertSame($expected, Day::executePartOne($input));
    }

    public static function part1FromStringProvider(): array
    {
        return [
            '1' => ['bvwbjplbgvbhsrlpgdmjqwftvncz', 5],
            '2' => ['nppdvjthqldpwncqszvftbrmjlhg', 6],
            '3' => ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 10],
            '4' => ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 11],
        ];
    }

    #[DataProvider('part2FromFileProvider')] public function testPart2FromFile(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input[0]));
    }

    public static function part2FromFileProvider(): array
    {
        return [
            'test data' => [sprintf("2022_%s_test", self::DAY_NUMBER), 19],
            'my puzzle input' => [sprintf("2022_%s_input", self::DAY_NUMBER), 2746],
        ];
    }

    #[DataProvider('part2FromStringProvider')] public function testPart2FromString(string $input, int $expected)
    {
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2FromStringProvider(): array
    {
        return [
            '1' => ['bvwbjplbgvbhsrlpgdmjqwftvncz', 23],
            '2' => ['nppdvjthqldpwncqszvftbrmjlhg', 23],
            '3' => ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', 29],
            '4' => ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', 26],
        ];
    }
}