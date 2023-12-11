<?php

declare(strict_types=1);

namespace aoc2023;

class Day05Mappings
{
    /** @var Day05Mapping[] */
    private array $mappings;
    /** @var int[] */
    private array $startRanges;
    private int $mappingCount = 0;

    public function addValue(int $destinationRangeStart, int $sourceRangeStart, int $rangeLength): void
    {
        $this->mappings[] = new Day05Mapping($destinationRangeStart, $sourceRangeStart, $rangeLength);
        $this->startRanges[] = $sourceRangeStart;
        sort($this->startRanges);
        $this->mappingCount++;
    }

    public function getBestMapping(int $source): Day05Mapping|false
    {
        if ($source < $this->startRanges[0]) {
            return false;
        }
        if ($source >= $this->startRanges[$this->mappingCount - 1]) {
            return $this->getMappingWhereSourceRangeStart($this->startRanges[$this->mappingCount - 1]);
        }
        $potentialIndex = (int)($this->mappingCount / 2);
        if ($this->startRanges[$potentialIndex] === $source) {
            return $this->getMappingWhereSourceRangeStart($this->startRanges[$potentialIndex]);
        } elseif ($this->startRanges[$potentialIndex] > $source) {
            for ($i = $potentialIndex - 1; $i >= 0; $i--) {
                $startRange = $this->startRanges[$i];
                if ($startRange <= $source) {
                    return $this->getMappingWhereSourceRangeStart($this->startRanges[$i]);
                }
            }
        } else {
            for ($i = $potentialIndex + 1; $i < $this->mappingCount; $i++) {
                $startRange = $this->startRanges[$i];
                if ($startRange === $source) {
                    return $this->getMappingWhereSourceRangeStart($this->startRanges[$i]);
                } elseif ($startRange > $source) {
                    return $this->getMappingWhereSourceRangeStart($this->startRanges[$i - 1]);
                }
            }
        }
        return false;
    }

    public function getMappingWhereSourceRangeStart(int $sourceRangeStart): Day05Mapping
    {
        $array = array_filter($this->mappings, fn($mapping) => $mapping->sourceRangeStart === $sourceRangeStart, ARRAY_FILTER_USE_BOTH);
        return array_shift($array);
    }
}