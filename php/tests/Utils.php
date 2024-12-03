<?php

namespace test;

class Utils
{
    public static function ReadAllLines(string $filename): array
    {
        $filepath = dirname(__FILE__) . '../../../../aoc-data/' . $filename . '.txt';
        return file($filepath, FILE_IGNORE_NEW_LINES);
    }
}