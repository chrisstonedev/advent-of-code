<?php

namespace test2023;

use aoc2023\Day05 as Day;
use aoc2023\Day05Almanac;
use aoc2023\Day05Mapping;
use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
{
    const DAY_NUMBER = '05';
    private Day05Almanac $expectedAlmanac;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedAlmanac = new Day05Almanac();
        $this->expectedAlmanac->seedToSoil[] = new Day05Mapping(50, 98, 2);
        $this->expectedAlmanac->seedToSoil[] = new Day05Mapping(52, 50, 48);
        $this->expectedAlmanac->soilToFertilizer[] = new Day05Mapping(0, 15, 37);
        $this->expectedAlmanac->soilToFertilizer[] = new Day05Mapping(37, 52, 2);
        $this->expectedAlmanac->soilToFertilizer[] = new Day05Mapping(39, 0, 15);
        $this->expectedAlmanac->fertilizerToWater[] = new Day05Mapping(49, 53, 8);
        $this->expectedAlmanac->fertilizerToWater[] = new Day05Mapping(0, 11, 42);
        $this->expectedAlmanac->fertilizerToWater[] = new Day05Mapping(42, 0, 7);
        $this->expectedAlmanac->fertilizerToWater[] = new Day05Mapping(57, 7, 4);
        $this->expectedAlmanac->waterToLight[] = new Day05Mapping(88, 18, 7);
        $this->expectedAlmanac->waterToLight[] = new Day05Mapping(18, 25, 70);
        $this->expectedAlmanac->lightToTemperature[] = new Day05Mapping(45, 77, 23);
        $this->expectedAlmanac->lightToTemperature[] = new Day05Mapping(81, 45, 19);
        $this->expectedAlmanac->lightToTemperature[] = new Day05Mapping(68, 64, 13);
        $this->expectedAlmanac->temperatureToHumidity[] = new Day05Mapping(0, 69, 1);
        $this->expectedAlmanac->temperatureToHumidity[] = new Day05Mapping(1, 0, 69);
        $this->expectedAlmanac->humidityToLocation[] = new Day05Mapping(60, 56, 37);
        $this->expectedAlmanac->humidityToLocation[] = new Day05Mapping(56, 93, 4);
    }

    public function testParseIntoAlmanac()
    {
        $testInput = Utils::ReadAllLines('test' . self::DAY_NUMBER);
        $this->assertEquals($this->expectedAlmanac, Day::parseInputAsAlmanac($testInput));
    }

    /** @dataProvider moveToNextAreaProvider */
    public function testMoveToNextArea(int $input, int $expected)
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

    /** @dataProvider mapValueFromObjectProvider */
    public function testMapValueFromObject(int $input, int|false $expected)
    {
        $this->assertSame($expected, $this->expectedAlmanac->seedToSoil[0]->mapValue($input));
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

    /** @dataProvider calculateLocationForSeedProvider */
    public function testCalculateLocationForSeed(int $input, int $expected)
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

    /** @dataProvider part1Provider */
    public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => ['test' . self::DAY_NUMBER, 35],
            'input' => ['input' . self::DAY_NUMBER, 650599855],
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
            'test' => ['test' . self::DAY_NUMBER, 46],
            'input' => ['input' . self::DAY_NUMBER, 1240035],
        ];
    }
}