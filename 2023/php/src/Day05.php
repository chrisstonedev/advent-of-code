<?php

declare(strict_types=1);

namespace aoc2023;

class Day05
{
    public static function executePartOne(array $input): int
    {
        $seeds = self::getSeeds($input[0]);
        $almanac = self::parseInputAsAlmanac($input);
        $locations = array_map(fn($value): int => self::calculateLocationForSeed($almanac, $value), $seeds);
        return min($locations);
    }

    public static function executePartTwo(array $input): int
    {
        $minimumLocation = PHP_INT_MAX;
        $seeds = self::getSeeds($input[0]);
        $almanac = self::parseInputAsAlmanac($input);
        print_r($seeds);
        print_r("\n");
        ob_flush();
        flush();
        for ($i = 0; $i < count($seeds); $i += 2) {
            $startSeed = $seeds[$i];
            $seedRange = $seeds[$i + 1];
            print_r("Starting $startSeed\n");
            ob_flush();
            flush();
            for ($j = $startSeed; $j < $startSeed + $seedRange; $j++) {
                $iteration = $j - $startSeed + 1;
                if ($iteration % 100000 === 0) {
                    print_r("Completed $iteration out of $seedRange (current minimum is $minimumLocation)\n");
                    ob_flush();
                    flush();
                }
                $location = self::calculateLocationForSeed($almanac, $j);
                if ($location < $minimumLocation) {
                    $minimumLocation = $location;
                }
            }
        }
        return $minimumLocation;
    }

    public static function parseInputAsAlmanac(array $input): Day05Almanac
    {
        $almanac = new Day05Almanac();
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
        foreach ($mappings as $mapping) {
            $destination = $mapping->mapValue($start);
            if ($destination)
                return $destination;
        }
        return $start;
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

    public static function getSeeds(string $inputLineWithSeeds): array
    {
        preg_match_all('/\d+/', $inputLineWithSeeds, $seedsMatches);
        return array_map('intval', $seedsMatches[0]);
    }
}