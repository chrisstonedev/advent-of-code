<?php

declare(strict_types=1);

namespace aoc2023;

class Day01
{
    private static array $numberWords = [
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9',
    ];

    public static function executePartOne(array $input): int
    {
        $result = 0;
        foreach ($input as $line) {
            $result += self::getBasicCalibrationValueFromLine($line);
        }
        return $result;
    }

    public static function executePartTwo(array $input): int
    {
        $result = 0;
        foreach ($input as $line) {
            $result += self::getAdvancedCalibrationValueFromLine($line);
        }
        return $result;
    }

    public static function getBasicCalibrationValueFromLine(string $line): int
    {
        $number = '';
        foreach (str_split($line) as $character) {
            if (is_numeric($character)) {
                $number = $character;
                break;
            }
        }
        foreach (array_reverse(str_split($line)) as $character) {
            if (is_numeric($character)) {
                $number .= $character;
                break;
            }
        }
        return intval($number);
    }

    public static function getAdvancedCalibrationValueFromLine(string $line): int
    {
        $number = '';
        for ($i = 0; $i < strlen($line); $i++) {
            if (is_numeric(substr($line, $i, 1))) {
                $number = substr($line, $i, 1);
                break;
            }
            $numberFromStartOfString = self::getNumberFromStartOfString(substr($line, $i));
            if ($numberFromStartOfString) {
                $number = $numberFromStartOfString;
                break;
            }
        }
        for ($i = strlen($line) - 1; $i >= 0; $i--) {
            if (is_numeric(substr($line, $i, 1))) {
                $number .= substr($line, $i, 1);
                break;
            }
            $numberFromStartOfString = self::getNumberFromEndOfString(substr($line, 0, $i + 1));
            if ($numberFromStartOfString) {
                $number .= $numberFromStartOfString;
                break;
            }
        }
        return intval($number);
    }

    private static function getNumberFromStartOfString(string $text): string|false
    {
        foreach (self::$numberWords as $word => $number) {
            if (str_starts_with($text, $word)) {
                return $number;
            }
        }
        return false;
    }

    private static function getNumberFromEndOfString(string $text): string|false
    {
        foreach (self::$numberWords as $word => $number) {
            if (str_ends_with($text, $word)) {
                return $number;
            }
        }
        return false;
    }
}