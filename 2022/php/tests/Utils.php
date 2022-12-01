<?php

namespace test2022;

class Utils
{
    public static function ReadAllLines(string $filename): array
    {
        $filepath = '../../data/' . $filename . '.txt';
        return file($filepath, FILE_IGNORE_NEW_LINES);
    }
}