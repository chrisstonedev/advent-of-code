<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day08 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day08Test extends TestCase
{
    const string DAY_NUMBER = '08';

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

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 2],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 21883],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        if (str_contains($filename, 'input')) {
            $this->markTestSkipped('Test takes way too long to complete.');
        }
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 6],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 12833235391111],
        ];
    }
}