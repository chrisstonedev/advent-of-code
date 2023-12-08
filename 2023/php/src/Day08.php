<?php

declare(strict_types=1);

namespace aoc2023;

class Day08
{
    public static function executePartOne(array $input): int
    {
        $directions = $input[0];
        $data = self::prepareData($input);
        $trips = 0;
        $currentNode = 'AAA';
        while ($currentNode !== 'ZZZ') {
            $moveRight = $directions[$trips % strlen($directions)] === 'R';
            $currentNode = self::getNextNode($data, $currentNode, $moveRight);
            $trips++;
        }
        return $trips;
    }

    public static function executePartTwo(array $input): int
    {
        $directions = $input[0];
        $data = self::prepareData($input);
        $trips = 0;
        $currentNodes1 = array_filter($data, fn($element) => str_ends_with($element['pattern'], 'A'));
        $currentNodes = array_values(array_map(fn($value): string => $value['pattern'], $currentNodes1));
        $allNodesAreAtTheEnd = false;
        print_r($currentNodes);
        flush();
        ob_flush();
        while (!$allNodesAreAtTheEnd) {
            $allNodesAreAtTheEnd = true;
            $moveRight = $directions[$trips % strlen($directions)] === 'R';
            for ($i = 0; $i < count($currentNodes); $i++) {
                $currentNodes[$i] = self::getNextNode($data, $currentNodes[$i], $moveRight);
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

    private static function prepareData(array $input): array
    {
        $data = [];
        for ($i = 2; $i < count($input); $i++) {
            preg_match_all('/\w+/', $input[$i], $values);
            $data[] = [
                'pattern' => $values[0][0],
                'left' => $values[0][1],
                'right' => $values[0][2],
            ];
        }
        return $data;
    }

    private static function getNextNode(array $data, mixed $currentNode, bool $moveRight): string
    {
        $object = current(array_filter($data, fn($element) => $element['pattern'] === $currentNode));
        return $moveRight ? $object['right'] : $object['left'];
    }
}