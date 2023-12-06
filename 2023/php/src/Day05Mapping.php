<?php

declare(strict_types=1);

namespace aoc2023;

class Day05Mapping
{
    public int $destinationRangeStart;
    public int $sourceRangeStart;
    public int $rangeLength;

    public function __construct(int $destinationRangeStart, int $sourceRangeStart, int $rangeLength)
    {
        $this->destinationRangeStart = $destinationRangeStart;
        $this->sourceRangeStart = $sourceRangeStart;
        $this->rangeLength = $rangeLength;
    }

    public function mapValue(int $source): int|false
    {
        if ($source >= $this->sourceRangeStart && $source < $this->sourceRangeStart + $this->rangeLength) {
            return $source - $this->sourceRangeStart + $this->destinationRangeStart;
        }
        return false;
    }
}