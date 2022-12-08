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
                if (self::isOnTheEdgeOfTheGrid($input, $row, $col) ||
                    self::isVisibleFromTheTop($input, $row, $col) ||
                    self::isVisibleFromTheBottom($input, $row, $col) ||
                    self::isVisibleFromTheLeft($input[$row], $col) ||
                    self::isVisibleFromTheRight($input[$row], $col)) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public static function executePartTwo(array $input): int
    {
        $highestScenicScore = 0;
        for ($row = 1; $row < count($input) - 1; $row++) {
            for ($col = 1; $col < strlen($input[$row]) - 1; $col++) {
                $scenicScore = self::getDistanceFromTheTop($input, $row, $col) *
                    self::getDistanceFromTheBottom($input, $row, $col) *
                    self::getDistanceFromTheLeft($input[$row], $col) *
                    self::getDistanceFromTheRight($input[$row], $col);
                if ($scenicScore > $highestScenicScore) {
                    $highestScenicScore = $scenicScore;
                }
            }
        }
        return $highestScenicScore;
    }

    private static function isOnTheEdgeOfTheGrid(array $input, int $row, int $col): bool
    {
        return $row === 0 || $row === count($input) - 1 || $col === 0 || $col === strlen($input[$row]) - 1;
    }

    private static function isVisibleFromTheTop(array $input, int $row, int $col): bool
    {
        for ($rowAbove = 0; $rowAbove < $row; $rowAbove++) {
            if (intval(substr($input[$rowAbove], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                return false;
            }
        }
        return true;
    }

    private static function isVisibleFromTheBottom(array $input, int $row, int $col): bool
    {
        for ($rowBelow = count($input) - 1; $rowBelow > $row; $rowBelow--) {
            if (intval(substr($input[$rowBelow], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                return false;
            }
        }
        return true;
    }

    private static function isVisibleFromTheLeft(string $rowData, int $col): bool
    {
        $isVisible = true;
        for ($colBefore = 0; $colBefore < $col; $colBefore++) {
            if (intval(substr($rowData, $colBefore, 1)) >= intval(substr($rowData, $col, 1))) {
                $isVisible = false;
                break;
            }
        }
        return $isVisible;
    }

    private static function isVisibleFromTheRight(string $rowData, int $col): bool
    {
        $isVisible = true;
        for ($colAfter = strlen($rowData) - 1; $colAfter > $col; $colAfter--) {
            if (intval(substr($rowData, $colAfter, 1)) >= intval(substr($rowData, $col, 1))) {
                $isVisible = false;
                break;
            }
        }
        return $isVisible;
    }

    private static function getDistanceFromTheTop(array $input, int $row, int $col): int
    {
        $distance = 0;
        for ($rowAbove = $row - 1; $rowAbove >= 0; $rowAbove--) {
            $distance++;
            if (intval(substr($input[$rowAbove], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                break;
            }
        }
        return $distance;
    }

    private static function getDistanceFromTheBottom(array $input, int $row, int $col): int
    {
        $distance = 0;
        for ($rowBelow = $row + 1; $rowBelow < count($input); $rowBelow++) {
            $distance++;
            if (intval(substr($input[$rowBelow], $col, 1)) >= intval(substr($input[$row], $col, 1))) {
                break;
            }
        }
        return $distance;
    }

    private static function getDistanceFromTheLeft(string $rowData, int $col): int
    {
        $distance = 0;
        for ($colBefore = $col - 1; $colBefore >= 0; $colBefore--) {
            $distance++;
            if (intval(substr($rowData, $colBefore, 1)) >= intval(substr($rowData, $col, 1))) {
                break;
            }
        }
        return $distance;
    }

    private static function getDistanceFromTheRight(string $rowData, int $col): int
    {
        $distance = 0;
        for ($colAfter = $col + 1; $colAfter < strlen($rowData); $colAfter++) {
            $distance++;
            if (intval(substr($rowData, $colAfter, 1)) >= intval(substr($rowData, $col, 1))) {
                break;
            }
        }
        return $distance;
    }
}