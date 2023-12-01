<?php

declare(strict_types=1);

namespace aoc2023;

class Day01
{
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
            if (substr($line, $i, 3) === 'one') {
                $number = '1';
                break;
            }
            if (substr($line, $i, 3) === 'two') {
                $number = '2';
                break;
            }
            if (substr($line, $i, 5) === 'three') {
                $number = '3';
                break;
            }
            if (substr($line, $i, 4) === 'four') {
                $number = '4';
                break;
            }
            if (substr($line, $i, 4) === 'five') {
                $number = '5';
                break;
            }
            if (substr($line, $i, 3) === 'six') {
                $number = '6';
                break;
            }
            if (substr($line, $i, 5) === 'seven') {
                $number = '7';
                break;
            }
            if (substr($line, $i, 5) === 'eight') {
                $number = '8';
                break;
            }
            if (substr($line, $i, 4) === 'nine') {
                $number = '9';
                break;
            }
        }
        for ($i = strlen($line) - 1; $i >= 0; $i--) {
            if (is_numeric(substr($line, $i, 1))) {
                $number .= substr($line, $i, 1);
                break;
            }
            if (substr($line, $i, 3) === 'one') {
                $number .= '1';
                break;
            }
            if (substr($line, $i, 3) === 'two') {
                $number .= '2';
                break;
            }
            if (substr($line, $i, 5) === 'three') {
                $number .= '3';
                break;
            }
            if (substr($line, $i, 4) === 'four') {
                $number .= '4';
                break;
            }
            if (substr($line, $i, 4) === 'five') {
                $number .= '5';
                break;
            }
            if (substr($line, $i, 3) === 'six') {
                $number .= '6';
                break;
            }
            if (substr($line, $i, 5) === 'seven') {
                $number .= '7';
                break;
            }
            if (substr($line, $i, 5) === 'eight') {
                $number .= '8';
                break;
            }
            if (substr($line, $i, 4) === 'nine') {
                $number .= '9';
                break;
            }
        }
        return intval($number);
    }
}