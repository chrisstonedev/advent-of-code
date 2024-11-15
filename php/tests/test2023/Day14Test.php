<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day14 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day14Test extends TestCase
{
    const string DAY_NUMBER = '14';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        if (str_contains($filename, 'input')) {
            $this->markTestSkipped('Did not solve part 1 in PHP yet.');
        }
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 136],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 0],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        if (str_contains($filename, 'input')) {
            $this->markTestSkipped('Did not solve part 1 in PHP yet.');
        }
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 0],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 0],
        ];
    }
}