<?php

declare(strict_types=1);

namespace aoc2023;

class Day05
{
    public static function executePartOne(array $input): int
    {
        $value = 0;
        $almanac = self::parseInputAsAlmanac($input);
        $locations = array_map(fn($value): int => self::calculateLocationForSeed($almanac, $value), $almanac->seeds);
        return min($locations);
    }

    public static function executePartTwo(array $input): int
    {
        return self::executePartOne($input);
    }

    public static function parseInputAsAlmanac(array $input): Day05Almanac
    {
        $almanac = new Day05Almanac();
        preg_match_all('/\d+/', $input[0], $seeds);
        $almanac->seeds = array_map('intval', $seeds[0]);
        $mapStep = 0;
        for ($i = 3; $i < count($input); $i++) {
            if (strlen($input[$i]) === 0) {
                $mapStep++;
                $i++;
                continue;
            }
            preg_match_all('/\d+/', $input[$i], $mappingValues);
            $mapping = new Day05Mapping(intval($mappingValues[0][0]), intval($mappingValues[0][1]),
                intval($mappingValues[0][2]));
            switch ($mapStep) {
                case 0:
                    $almanac->seedToSoil[] = $mapping;
                    break;
                case 1:
                    $almanac->soilToFertilizer[] = $mapping;
                    break;
                case 2:
                    $almanac->fertilizerToWater[] = $mapping;
                    break;
                case 3:
                    $almanac->waterToLight[] = $mapping;
                    break;
                case 4:
                    $almanac->lightToTemperature[] = $mapping;
                    break;
                case 5:
                    $almanac->temperatureToHumidity[] = $mapping;
                    break;
                case 6:
                    $almanac->humidityToLocation[] = $mapping;
                    break;
            }
        }
        return $almanac;
    }

    /** @param Day05Mapping[] $mappings */
    public static function moveToNextArea(array $mappings, int $start): int
    {
        $mappingDictionary = [];
        foreach ($mappings as $mapping) {
            for ($i = 0; $i < $mapping->rangeLength; $i++) {
                $mappingDictionary[$mapping->sourceRangeStart + $i] = $mapping->destinationRangeStart + $i;
            }
        }
        return $mappingDictionary[$start] ?? $start;
    }

    public static function calculateLocationForSeed(Day05Almanac $almanac, int $seed): int
    {
        $soil = self::moveToNextArea($almanac->seedToSoil, $seed);
        $fertilizer = self::moveToNextArea($almanac->soilToFertilizer, $soil);
        $water = self::moveToNextArea($almanac->fertilizerToWater, $fertilizer);
        $light = self::moveToNextArea($almanac->waterToLight, $water);
        $temperature = self::moveToNextArea($almanac->lightToTemperature, $light);
        $humidity = self::moveToNextArea($almanac->temperatureToHumidity, $temperature);
        return self::moveToNextArea($almanac->humidityToLocation, $humidity);
    }
}