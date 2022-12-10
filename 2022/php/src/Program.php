<?php

declare(strict_types=1);

namespace aoc2022;

use InvalidArgumentException;

require '../vendor/autoload.php';

function ReadAllLines(string $filename): array
{
    $filepath = dirname(__FILE__) . '../../../data/' . $filename . '.txt';
    return file($filepath, FILE_IGNORE_NEW_LINES);
}

function executePartOne(int $day, array $inputArray): string
{
    switch ($day) {
        case 1:
            return strval(Day01::executePartOne($inputArray));
        case 2:
            return strval(Day02::executePartOne($inputArray));
        case 3:
            return strval(Day03::executePartOne($inputArray));
        case 4:
            return strval(Day04::executePartOne($inputArray));
        case 5:
            return Day05::executePartOne($inputArray);
        case 6:
            return strval(Day06::executePartOne($inputArray[0]));
        case 7:
            return strval(Day07::executePartOne($inputArray));
        case 8:
            return strval(Day08::executePartOne($inputArray));
        case 9:
            return strval(Day09::executePartOne($inputArray));
        case 10:
            return strval(Day10::executePartOne($inputArray));
        default:
            throw new InvalidArgumentException('Day number is not available');
    }
}

function executePartTwo(int $day, array $inputArray): string
{
    switch ($day) {
        case 1:
            return strval(Day01::executePartTwo($inputArray));
        case 2:
            return strval(Day02::executePartTwo($inputArray));
        case 3:
            return strval(Day03::executePartTwo($inputArray));
        case 4:
            return strval(Day04::executePartTwo($inputArray));
        case 5:
            return Day05::executePartTwo($inputArray);
        case 6:
            return strval(Day06::executePartTwo($inputArray[0]));
        case 7:
            return strval(Day07::executePartTwo($inputArray));
        case 8:
            return strval(Day08::executePartTwo($inputArray));
        case 9:
            return strval(Day09::executePartTwo($inputArray));
        case 10:
            return strval(Day10::executePartTwo($inputArray));
        default:
            throw new InvalidArgumentException('Day number is not available');
    }
}

for ($day = 1; $day <= 10; $day++) {
    echo "Day $day\n";
    $input = ReadAllLines(sprintf('input%02d', $day));
    echo sprintf("  Part 1: %s\n", executePartOne($day, $input));
    echo sprintf("  Part 2: %s\n", executePartTwo($day, $input));
}
