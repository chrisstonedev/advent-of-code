<?php

declare(strict_types=1);

namespace aoc2023;

class Day05Almanac
{
    /** @var Day05Mapping[] */
    public array $seedToSoil;
    /** @var Day05Mapping[] */
    public array $soilToFertilizer;
    /** @var Day05Mapping[] */
    public array $fertilizerToWater;
    /** @var Day05Mapping[] */
    public array $waterToLight;
    /** @var Day05Mapping[] */
    public array $lightToTemperature;
    /** @var Day05Mapping[] */
    public array $temperatureToHumidity;
    /** @var Day05Mapping[] */
    public array $humidityToLocation;
}