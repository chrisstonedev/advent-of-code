<?php

declare(strict_types=1);

namespace aoc\aoc2023;

class Day05Almanac
{
    public Day05Mappings $seedToSoil;
    public Day05Mappings $soilToFertilizer;
    public Day05Mappings $fertilizerToWater;
    public Day05Mappings $waterToLight;
    public Day05Mappings $lightToTemperature;
    public Day05Mappings $temperatureToHumidity;
    public Day05Mappings $humidityToLocation;

    public function __construct()
    {
        $this->seedToSoil = new Day05Mappings();
        $this->soilToFertilizer = new Day05Mappings();
        $this->fertilizerToWater = new Day05Mappings();
        $this->waterToLight = new Day05Mappings();
        $this->lightToTemperature = new Day05Mappings();
        $this->temperatureToHumidity = new Day05Mappings();
        $this->humidityToLocation = new Day05Mappings();
    }
}