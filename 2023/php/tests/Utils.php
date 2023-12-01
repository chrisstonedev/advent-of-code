<?php

namespace test2023;

class Utils
{
    public static function ReadAllLines(string $filename): array
    {
        $filepath = dirname(__FILE__) . '../../../data/' . $filename . '.txt';
        return file($filepath, FILE_IGNORE_NEW_LINES);
    }
}