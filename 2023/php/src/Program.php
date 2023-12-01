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
echo sprintf("  Part 1: %s\n", Day01::ExecutePartOne($day1Input));
echo sprintf("  Part 2: %s\n", Day01::ExecutePartTwo($day1Input));

echo "Day 2\n";
$day2Input = ReadAllLines('input02');
echo sprintf("  Part 1: %s\n", Day02::ExecutePartOne($day2Input));
echo sprintf("  Part 2: %s\n", Day02::ExecutePartTwo($day2Input));

echo "Day 3\n";
$day3Input = ReadAllLines('input03');
echo sprintf("  Part 1: %s\n", Day03::ExecutePartOne($day3Input));
echo sprintf("  Part 2: %s\n", Day03::ExecutePartTwo($day3Input));

echo "Day 4\n";
$day4Input = ReadAllLines('input04');
echo sprintf("  Part 1: %s\n", Day04::ExecutePartOne($day4Input));
echo sprintf("  Part 2: %s\n", Day04::ExecutePartTwo($day4Input));

echo "Day 5\n";
$day5Input = ReadAllLines('input05');
echo sprintf("  Part 1: %s\n", Day05::ExecutePartOne($day5Input));
echo sprintf("  Part 2: %s\n", Day05::ExecutePartTwo($day5Input));

echo "Day 6\n";
$day6Input = ReadAllLines('input06');
echo sprintf("  Part 1: %s\n", Day06::ExecutePartOne($day6Input[0]));
echo sprintf("  Part 2: %s\n", Day06::ExecutePartTwo($day6Input[0]));

echo "Day 7\n";
$day7Input = ReadAllLines('input07');
echo sprintf("  Part 1: %s\n", Day07::ExecutePartOne($day7Input));
echo sprintf("  Part 2: %s\n", Day07::ExecutePartTwo($day7Input));

echo "Day 8\n";
$day8Input = ReadAllLines('input08');
echo sprintf("  Part 1: %s\n", Day08::ExecutePartOne($day8Input));
echo sprintf("  Part 2: %s\n", Day08::ExecutePartTwo($day8Input));

echo "Day 9\n";
$day9Input = ReadAllLines('input09');
echo sprintf("  Part 1: %s\n", Day09::ExecutePartOne($day9Input));
echo sprintf("  Part 2: %s\n", Day09::ExecutePartTwo($day9Input));
