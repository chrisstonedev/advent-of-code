<?php

declare(strict_types=1);

namespace test2023;

use aoc2023\Day11 as Day;
use PHPUnit\Framework\TestCase;

class Day11Test extends TestCase
{
    const DAY_NUMBER = '11';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 374],
            'input' => ['input' . self::DAY_NUMBER, 10154062],
        ];
    }

    /** @dataProvider multiplyByFactorProvider */
    public function testMultiplyByFactor(int $factor, int $expected)
    {
        $input = Utils::ReadAllLines('test' . self::DAY_NUMBER);
        $this->assertSame($expected, Day::multiplyByFactor($input, $factor));
    }

    public static function multiplyByFactorProvider(): array
    {
        return [
            'factor of 10' => [10, 1030],
            'factor of 100' => [100, 8410],
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
            'test' => ['test' . self::DAY_NUMBER, 82000210],
            'input' => ['input' . self::DAY_NUMBER, 553083047914],
        ];
    }
}