<?php

declare(strict_types=1);

namespace aoc2022;
require '../vendor/autoload.php';

function ReadAllLines(string $filename): array
{
    $filepath = dirname(__FILE__) . '../../../data/' . $filename . '.txt';
    return file($filepath, FILE_IGNORE_NEW_LINES);
}

echo "Day 1\n";
$day1Input = ReadAllLines('input01');
$day1Part1 = Day01::ExecutePartOne($day1Input);
echo "  Part 1: $day1Part1\n";
echo "Day 2\n";
