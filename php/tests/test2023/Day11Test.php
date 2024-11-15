<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day11 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day11Test extends TestCase
{
    const string DAY_NUMBER = '11';

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 374],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 10154062],
        ];
    }

    #[DataProvider('multiplyByFactorProvider')] public function testMultiplyByFactor(int $factor, int $expected)
    {
        $input = Utils::ReadAllLines(sprintf("2023_%s_test", self::DAY_NUMBER));
        $this->assertSame($expected, Day::multiplyByFactor($input, $factor));
    }

    public static function multiplyByFactorProvider(): array
    {
        return [
            'factor of 10' => [10, 1030],
            'factor of 100' => [100, 8410],
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
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 82000210],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 553083047914],
        ];
    }
}