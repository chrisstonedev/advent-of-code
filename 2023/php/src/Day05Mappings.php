<?php

declare(strict_types=1);

namespace aoc2023;

class Day05Mappings
{
    /** @var Day05Mapping[] */
    private array $mappings;
    /** @var int[] */
    private array $startRanges;
    /** @var int[] */
    private array $destinationRanges;
    private int $mappingCount = 0;

    public function addValue(int $destinationRangeStart, int $sourceRangeStart, int $rangeLength): void
    {
        $this->mappings[] = new Day05Mapping($destinationRangeStart, $sourceRangeStart, $rangeLength);
        $this->startRanges[] = $sourceRangeStart;
        sort($this->startRanges);
        $this->destinationRanges[] = $destinationRangeStart;
        sort($this->destinationRanges);
        $this->mappingCount++;
    }

    public function getBestMappingForNext(int $source): Day05Mapping|false
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

    public function getBestMappingForPrevious(int $destination): Day05Mapping|false
    {
        if ($destination < $this->destinationRanges[0]) {
            return false;
        }
        if ($destination >= $this->destinationRanges[$this->mappingCount - 1]) {
            return $this->getMappingWhereDestinationRangeStart($this->destinationRanges[$this->mappingCount - 1]);
        }
        $potentialIndex = (int)($this->mappingCount / 2);
        if ($this->destinationRanges[$potentialIndex] === $destination) {
            return $this->getMappingWhereDestinationRangeStart($this->destinationRanges[$potentialIndex]);
        } elseif ($this->destinationRanges[$potentialIndex] > $destination) {
            for ($i = $potentialIndex - 1; $i >= 0; $i--) {
                $startRange = $this->destinationRanges[$i];
                if ($startRange <= $destination) {
                    return $this->getMappingWhereDestinationRangeStart($this->destinationRanges[$i]);
                }
            }
        } else {
            for ($i = $potentialIndex + 1; $i < $this->mappingCount; $i++) {
                $startRange = $this->destinationRanges[$i];
                if ($startRange === $destination) {
                    return $this->getMappingWhereDestinationRangeStart($this->destinationRanges[$i]);
                } elseif ($startRange > $destination) {
                    return $this->getMappingWhereDestinationRangeStart($this->destinationRanges[$i - 1]);
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

    public function getMappingWhereDestinationRangeStart(int $destinationRangeStart): Day05Mapping
    {
        $array = array_filter($this->mappings, fn($mapping) => $mapping->destinationRangeStart === $destinationRangeStart, ARRAY_FILTER_USE_BOTH);
        return array_shift($array);
    }
}