<?php

namespace test2023;

use aoc2023\Day01 as Day;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    const DAY_NUMBER = '01';

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 142],
            'input' => ['input' . self::DAY_NUMBER, 54081],
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
            'test' => ['test' . self::DAY_NUMBER, 142],
            'input' => ['input' . self::DAY_NUMBER, 54649],
        ];
    }

    public function testPart2WithoutFile()
    {
        $part2Input = [
            'two1nine',
            'eightwothree',
            'abcone2threexyz',
            'xtwone3four',
            '4nineeightseven2',
            'zoneight234',
            '7pqrstsixteen',
        ];
        $this->assertSame(281, Day::executePartTwo($part2Input));
    }

    /** @dataProvider getBasicCalibrationValueFromLineProvider */
    public function testGetBasicCalibrationValueFromLine(string $line, int $expected)
    {
        $this->assertSame($expected, Day::getBasicCalibrationValueFromLine($line));
    }

    public static function getBasicCalibrationValueFromLineProvider(): array
    {
        return [
            '1abc2' => ['1abc2', 12],
            'pqr3stu8vwx' => ['pqr3stu8vwx', 38],
            'a1b2c3d4e5f' => ['a1b2c3d4e5f', 15],
            'treb7uchet' => ['treb7uchet', 77],
        ];
    }

    /** @dataProvider getAdvancedCalibrationValueFromLineProvider */
    public function testGetAdvancedCalibrationValueFromLine(string $line, int $expected)
    {
        $this->assertSame($expected, Day::getAdvancedCalibrationValueFromLine($line));
    }

    public static function getAdvancedCalibrationValueFromLineProvider(): array
    {
        return [
            'two1nine' => ['two1nine', 29],
            'eightwothree' => ['eightwothree', 83],
            'abcone2threexyz' => ['abcone2threexyz', 13],
            'xtwone3four' => ['xtwone3four', 24],
            '4nineeightseven2' => ['4nineeightseven2', 42],
            'zoneight234' => ['zoneight234', 14],
            '7pqrstsixteen' => ['7pqrstsixteen', 76],
            'parsing "12"' => ['onetwo', 12],
            'parsing "23"' => ['twothree', 23],
            'parsing "34"' => ['threefour', 34],
            'parsing "45"' => ['fourfive', 45],
            'parsing "56"' => ['fivesix', 56],
            'parsing "67"' => ['sixseven', 67],
            'parsing "78"' => ['seveneight', 78],
            'parsing "89"' => ['eightnine', 89],
            'parsing "91"' => ['nineone', 91],
            'data in front and in back' => ['tnineonex', 91],
            'front of data is partial number' => ['ninineonex', 91],
        ];
    }
}