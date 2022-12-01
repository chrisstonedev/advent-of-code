<?php

namespace test2021;

class Utils
{
    public static function ReadAllLines(string $filename): array
    {
        $filepath = '../../data/' . $filename . '.txt';
        return file($filepath);
    }
}