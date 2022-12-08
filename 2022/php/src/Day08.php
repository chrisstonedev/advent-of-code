<?php

declare(strict_types=1);

namespace aoc2022;

class Day08
{
    public static function executePartOne(array $input): int
    {
        $count = 0;
        for ($row = 0; $row < count($input); $row++) {
            for ($col = 0; $col < strlen($input[$row]); $col++) {
                if ($row === 0 || $row === count($input) - 1 || $col === 0 || $col === strlen($input[$row]) - 1) {
                    $count++;
                    continue;
                }

                $isVisible = true;
                for ($rowAbove = 0; $rowAbove < $row; $rowAbove++) {
                    if (intval(substr($input[$rowAbove], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                        $isVisible = false;
                        break;
                    }
                }
                if ($isVisible) {
                    $count++;
                    continue;
                }
                $isVisible = true;
                for ($rowBelow = count($input) - 1; $rowBelow > $row; $rowBelow--) {
                    if (intval(substr($input[$rowBelow], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                        $isVisible = false;
                        break;
                    }
                }
                if ($isVisible) {
                    $count++;
                    continue;
                }
                $isVisible = true;
                for ($colBefore = 0; $colBefore < $col; $colBefore++) {
                    if (intval(substr($input[$row], $colBefore, 1)) >= intval(substr($input[$row], $col, 1))) {
                        $isVisible = false;
                        break;
                    }
                }
                if ($isVisible) {
                    $count++;
                    continue;
                }
                $isVisible = true;
                for ($colAfter = count($input) - 1; $colAfter > $col; $colAfter--) {
                    if (intval(substr($input[$row], $colAfter, 1)) >= intval(substr($input[$row], $col, 1))) {
                        $isVisible = false;
                        break;
                    }
                }
                if ($isVisible) {
                    $count++;
                    continue;
                }
            }
        }
        return $count;
    }

    public static function executePartTwo(array $input): int
    {
        $highestScenicScore = 0;
        for ($row = 0; $row < count($input); $row++) {
            for ($col = 0; $col < strlen($input[$row]); $col++) {
                if ($row === 0 || $row === count($input) - 1 || $col === 0 || $col === strlen($input[$row]) - 1) {
                    continue;
                }

                $scenicScore = 0;
                $distance = 0;
                for ($rowAbove = $row - 1; $rowAbove >= 0; $rowAbove--) {
                    $distance++;
                    if (intval(substr($input[$rowAbove], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                        break;
                    }
                }
                $scenicScore = $distance;
                $distance = 0;
                for ($rowBelow = $row + 1; $rowBelow < count($input); $rowBelow++) {
                    $distance++;
                    if (intval(substr($input[$rowBelow], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                        break;
                    }
                }
                $scenicScore *= $distance;
                $distance = 0;
                for ($colBefore = $col - 1; $colBefore >= 0; $colBefore--) {
                    $distance++;
                    if (intval(substr($input[$row], $colBefore, 1)) >= intval(substr($input[$row], $col, 1))) {
                        break;
                    }
                }
                $scenicScore *= $distance;
                $distance = 0;
                for ($colAfter = $col + 1; $colAfter < count($input); $colAfter++) {
                    $distance++;
                    if (intval(substr($input[$row], $colAfter, 1)) >= intval(substr($input[$row], $col, 1))) {
                        break;
                    }
                }
                $scenicScore *= $distance;
                if ($scenicScore > $highestScenicScore) {
                    $highestScenicScore = $scenicScore;
                }
            }
        }
        return $highestScenicScore;
    }
}