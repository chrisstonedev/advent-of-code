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
        $textThatCouldBeANumber = '';
        /** @var string $character */
        foreach (str_split($line) as $character) {
            if (is_numeric($character)) {
                $number = $character;
                break;
            }
            if ($textThatCouldBeANumber === 'o' && $character == 'n') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 't' && in_array($character, ['w', 'h'])) {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'f' && in_array($character, ['o', 'i'])) {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 's' && in_array($character, ['i', 'e'])) {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'e' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'n' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'on' && $character == 'e') {
                $number = '1';
                break;
            } elseif ($textThatCouldBeANumber === 'tw' && $character == 'o') {
                $number = '2';
                break;
            } elseif ($textThatCouldBeANumber === 'th' && $character == 'r') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'fo' && $character == 'u') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'fi' && $character == 'v') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'si' && $character == 'x') {
                $number = '6';
                break;
            } elseif ($textThatCouldBeANumber === 'se' && $character == 'v') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'ei' && $character == 'g') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'ni' && $character == 'n') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'thr' && $character == 'e') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'fou' && $character == 'r') {
                $number = '4';
                break;
            } elseif ($textThatCouldBeANumber === 'fiv' && $character == 'e') {
                $number = '5';
                break;
            } elseif ($textThatCouldBeANumber === 'sev' && $character == 'e') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'eig' && $character == 'h') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'nin' && $character == 'e') {
                $number = '9';
                break;
            } elseif ($textThatCouldBeANumber === 'thre' && $character == 'e') {
                $number = '3';
                break;
            } elseif ($textThatCouldBeANumber === 'seve' && $character == 'n') {
                $number = '7';
                break;
            } elseif ($textThatCouldBeANumber === 'eigh' && $character == 't') {
                $number = '8';
                break;
            } else {
                $textThatCouldBeANumber = '';
            }
            if ($textThatCouldBeANumber === '' && in_array($character, ['o', 't', 'f', 's', 'e', 'n'])) {
                $textThatCouldBeANumber = $character;
            }
        }
        $textThatCouldBeANumber = '';
        foreach (array_reverse(str_split($line)) as $character) {
            if (is_numeric($character)) {
                $number .= $character;
                break;
            }
            if ($textThatCouldBeANumber === 'e' && in_array($character, ['n', 'e', 'v'])) {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'o' && $character == 'w') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'r' && $character == 'u') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'x' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'n' && $character == 'e') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 't' && $character == 'h') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'en' && $character == 'o') {
                $number .= '1';
                break;
            } elseif ($textThatCouldBeANumber === 'ow' && $character == 't') {
                $number .= '2';
                break;
            } elseif ($textThatCouldBeANumber === 'ee' && $character == 'r') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'ru' && $character == 'o') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'ev' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'xi' && $character == 's') {
                $number .= '6';
                break;
            } elseif ($textThatCouldBeANumber === 'ne' && $character == 'v') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'th' && $character == 'g') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'en' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'eer' && $character == 'h') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'ruo' && $character == 'f') {
                $number .= '4';
                break;
            } elseif ($textThatCouldBeANumber === 'evi' && $character == 'f') {
                $number .= '5';
                break;
            } elseif ($textThatCouldBeANumber === 'nev' && $character == 'e') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'thg' && $character == 'i') {
                $textThatCouldBeANumber .= $character;
            } elseif ($textThatCouldBeANumber === 'eni' && $character == 'n') {
                $number .= '9';
                break;
            } elseif ($textThatCouldBeANumber === 'eerh' && $character == 't') {
                $number .= '3';
                break;
            } elseif ($textThatCouldBeANumber === 'neve' && $character == 's') {
                $number .= '7';
                break;
            } elseif ($textThatCouldBeANumber === 'thgi' && $character == 'e') {
                $number .= '8';
                break;
            } else {
                $textThatCouldBeANumber = '';
            }
            if ($textThatCouldBeANumber === '' && in_array($character, ['e', 'o', 'r', 'x', 'n', 't'])) {
                $textThatCouldBeANumber .= $character;
            }
        }
        return intval($number);
    }
}