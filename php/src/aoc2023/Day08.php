<?php

declare(strict_types=1);

namespace aoc\aoc2023;

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
            $currentNode = $moveRight ? $data[$currentNode]['right'] : $data[$currentNode]['left'];
            $trips++;
        }
        return $trips;
    }

    public static function executePartTwo(array $input): int
    {
        $directions = $input[0];
        $data = self::prepareData($input);
        $trips = 0;
//        $currentNodes = array_values(array_filter(array_keys($data), fn($key) => str_ends_with($key, 'A')));
        $currentNodesReverse = array_values(array_filter(array_keys($data), fn($key) => str_ends_with($key, 'A')));
        $currentNodes = [];
        for ($jj = count($currentNodesReverse) - 1; $jj >= 0; $jj--) {
            $currentNodes[] = $currentNodesReverse[$jj];
        }

        $allNodesAreAtTheEnd = false;
        while (!$allNodesAreAtTheEnd) {
//            $allNodesAreAtTheEnd = ($trips + 1) % 44225543 === 0;
            $allNodesAreAtTheEnd = true;
            $moveRight = $directions[$trips % strlen($directions)] === 'R';
//            for ($i = 3; $i < count($currentNodes); $i++) {
            for ($i = 0; $i < count($currentNodes); $i++) {
                $currentNodes[$i] = $moveRight ? $data[$currentNodes[$i]]['right'] : $data[$currentNodes[$i]]['left'];
                if ($allNodesAreAtTheEnd && !str_ends_with($currentNodes[$i], 'Z')) {
//                    if ($i > 3) {
                    if ($i > 1) {
                        $currentTrip = $trips + 1;
                        print_r("On $currentTrip trips, it needed to go to index $i to find one not ending in Z\n");
                        flush();
                        ob_flush();
                    }
                    $allNodesAreAtTheEnd = false;
                }
            }
            $trips++;
        }
        return $trips;
    }

    private static function prepareData(array $input): array
    {
        $data = [];
        for ($i = 2; $i < count($input); $i++) {
            preg_match_all('/\w+/', $input[$i], $values);
            $data[$values[0][0]] = [
                'left' => $values[0][1],
                'right' => $values[0][2],
            ];
        }
        return $data;
    }
}