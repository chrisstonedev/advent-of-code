<?php

namespace test\test2023;

use aoc\aoc2023\Day05 as Day;
use aoc\aoc2023\Day05Almanac;
use aoc\aoc2023\Day05Mapping;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day05Test extends TestCase
{
    const string DAY_NUMBER = '05';
    private Day05Almanac $expectedAlmanac;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedAlmanac = new Day05Almanac();
        $this->expectedAlmanac->seedToSoil->addValue(50, 98, 2);
        $this->expectedAlmanac->seedToSoil->addValue(52, 50, 48);
        $this->expectedAlmanac->soilToFertilizer->addValue(0, 15, 37);
        $this->expectedAlmanac->soilToFertilizer->addValue(37, 52, 2);
        $this->expectedAlmanac->soilToFertilizer->addValue(39, 0, 15);
        $this->expectedAlmanac->fertilizerToWater->addValue(49, 53, 8);
        $this->expectedAlmanac->fertilizerToWater->addValue(0, 11, 42);
        $this->expectedAlmanac->fertilizerToWater->addValue(42, 0, 7);
        $this->expectedAlmanac->fertilizerToWater->addValue(57, 7, 4);
        $this->expectedAlmanac->waterToLight->addValue(88, 18, 7);
        $this->expectedAlmanac->waterToLight->addValue(18, 25, 70);
        $this->expectedAlmanac->lightToTemperature->addValue(45, 77, 23);
        $this->expectedAlmanac->lightToTemperature->addValue(81, 45, 19);
        $this->expectedAlmanac->lightToTemperature->addValue(68, 64, 13);
        $this->expectedAlmanac->temperatureToHumidity->addValue(0, 69, 1);
        $this->expectedAlmanac->temperatureToHumidity->addValue(1, 0, 69);
        $this->expectedAlmanac->humidityToLocation->addValue(60, 56, 37);
        $this->expectedAlmanac->humidityToLocation->addValue(56, 93, 4);
    }

    public function testParseIntoAlmanac()
    {
        $testInput = Utils::ReadAllLines(sprintf("2023_%s_test", self::DAY_NUMBER));
        $this->assertEquals($this->expectedAlmanac, Day::parseInputAsAlmanac($testInput));
    }

    #[DataProvider('moveToNextAreaProvider')] public function testMoveToNextArea(int $input, int $expected)
    {
        $this->assertSame($expected, Day::moveToNextArea($this->expectedAlmanac->seedToSoil, $input));
    }

    public static function moveToNextAreaProvider(): array
    {
        return [
            'no mapping defined (0)' => [0, 0],
            'no mapping defined (1)' => [1, 1],
            'no mapping defined (48)' => [48, 48],
            'no mapping defined (49)' => [49, 49],
            'second defined mapping (50)' => [50, 52],
            'second defined mapping (51)' => [51, 53],
            'second defined mapping (96)' => [96, 98],
            'second defined mapping (97)' => [97, 99],
            'first defined mapping (98)' => [98, 50],
            'first defined mapping (99)' => [99, 51],
        ];
    }

    #[DataProvider('mapValueFromObjectProvider')] public function testMapValueFromObject(int $input, int|false $expected)
    {
        $mapping = new Day05Mapping(50, 98, 2);
        $this->assertSame($expected, $mapping->mapValue($input));
    }

    public static function mapValueFromObjectProvider(): array
    {
        return [
            'no mapping defined (0)' => [0, false],
            'no mapping defined (97)' => [97, false],
            'first defined mapping (98)' => [98, 50],
            'first defined mapping (99)' => [99, 51],
        ];
    }

    #[DataProvider('calculateLocationForSeedProvider')] public function testCalculateLocationForSeed(int $input, int $expected)
    {
        $this->assertSame($expected, Day::calculateLocationForSeed($this->expectedAlmanac, $input));
    }

    public static function calculateLocationForSeedProvider(): array
    {
        return [
            'Seed 79' => [79, 82],
            'Seed 14' => [14, 43],
            'Seed 55' => [55, 86],
            'Seed 13' => [13, 35],
        ];
    }

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 35],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 650599855],
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
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 46],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 1240035],
        ];
    }
}