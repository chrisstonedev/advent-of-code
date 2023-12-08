<?php

declare(strict_types=1);

namespace aoc2023;

class Day08
{
    public static function executePartOne(array $input): int
    {
        $data = [];
        $directions = $input[0];
        for ($i = 2; $i < count($input); $i++) {
            preg_match_all('/\w+/', $input[$i], $values);
            $data[] = [
                'pattern' => $values[0][0],
                'left' => $values[0][1],
                'right' => $values[0][2],
            ];
        }
        $currentNode = 'AAA';
        $trips = 0;
        while ($currentNode !== 'ZZZ') {
            $object = current(array_filter($data, fn($element) => $element['pattern'] === $currentNode));
            $currentNode = $directions[$trips % strlen($directions)] === 'R' ? $object['right'] : $object['left'];
            $trips++;
        }
        return $trips;
    }

    public static function executePartTwo(array $input): int
    {
        $data = [];
        $directions = $input[0];
        for ($i = 2; $i < count($input); $i++) {
            preg_match_all('/\w+/', $input[$i], $values);
            $data[] = [
                'pattern' => $values[0][0],
                'left' => $values[0][1],
                'right' => $values[0][2],
            ];
        }
        $trips = 0;
        $currentNodes = array_filter($data, fn($element) => str_ends_with($element['pattern'], 'A'));
        $currentNodes = array_values(array_map(fn($value): string => $value['pattern'], $currentNodes));
        $allNodesAreAtTheEnd = false;
        print_r($currentNodes);
        flush();
        ob_flush();
        while (!$allNodesAreAtTheEnd) {
            $allNodesAreAtTheEnd = true;
            for ($i = 0; $i < count($currentNodes); $i++) {
                $object = current(array_filter($data, fn($element) => $element['pattern'] === $currentNodes[$i]));
                $currentNodes[$i] = $directions[$trips % strlen($directions)] === 'R' ? $object['right'] : $object['left'];
                if (!str_ends_with($currentNodes[$i], 'Z')) {
                    $allNodesAreAtTheEnd = false;
                }
            }
            $trips++;
            print_r($currentNodes);
            flush();
            ob_flush();
        }
        return $trips;
    }
}