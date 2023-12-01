<?php

declare(strict_types=1);

namespace aoc2023;
require '../vendor/autoload.php';

function ReadAllLines(string $filename): array
{
    $filepath = dirname(__FILE__) . '../../../data/' . $filename . '.txt';
    return file($filepath, FILE_IGNORE_NEW_LINES);
}

echo "Day 1\n";
$day1Input = ReadAllLines('input01');
echo sprintf("  Part 1: %s\n", Day01::executePartOne($day1Input));
echo sprintf("  Part 2: %s\n", Day01::executePartTwo($day1Input));
