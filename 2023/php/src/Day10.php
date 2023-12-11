<?php

declare(strict_types=1);

namespace aoc2023;

class Day10
{
    public static function executePartOne(array $input): int
    {
        $paths = [];
        for ($i = 0; $i < count($input); $i++) {
            $possibleStartPosition = strpos($input[$i], 'S');
            if ($possibleStartPosition !== false) {
                $paths["$i,$possibleStartPosition"] = 0;
                break;
            }
        }

        for ($value = 0; ; $value++) {
            /** @var string[] $keys */
            $keys = array_keys($paths, $value);
            if (count($keys) === 0) {
                break;
            }
            foreach ($keys as $key) {
                $positionValues = array_map('intval', explode(',', $key));

                // check to the right
                $line = $positionValues[0];
                $column = $positionValues[1] + 1;
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['-', 'J', '7'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check to the left
                $line = $positionValues[0];
                $column = $positionValues[1] - 1;
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['-', 'L', 'F'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check up
                $line = $positionValues[0] - 1;
                $column = $positionValues[1];
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['|', '7', 'F'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check down
                $line = $positionValues[0] + 1;
                $column = $positionValues[1];
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['|', 'L', 'J'])) {
                    $paths["$line,$column"] = $value + 1;
                }
            }
        }

        return max($paths);
    }

    public static function executePartTwo(array $input): int
    {
        $paths = [];
        for ($i = 0; $i < count($input); $i++) {
            $possibleStartPosition = strpos($input[$i], 'S');
            if ($possibleStartPosition !== false) {
                $paths["$i,$possibleStartPosition"] = 0;
                break;
            }
        }

        for ($value = 0; ; $value++) {
            /** @var string[] $keys */
            $keys = array_keys($paths, $value);
            if (count($keys) === 0) {
                break;
            }
            foreach ($keys as $key) {
                $positionValues = array_map('intval', explode(',', $key));

                // check to the right
                $line = $positionValues[0];
                $column = $positionValues[1] + 1;
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['-', 'J', '7'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check to the left
                $line = $positionValues[0];
                $column = $positionValues[1] - 1;
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['-', 'L', 'F'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check up
                $line = $positionValues[0] - 1;
                $column = $positionValues[1];
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['|', '7', 'F'])) {
                    $paths["$line,$column"] = $value + 1;
                }

                // check down
                $line = $positionValues[0] + 1;
                $column = $positionValues[1];
                if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], ['|', 'L', 'J'])) {
                    $paths["$line,$column"] = $value + 1;
                }
            }
        }

        $enclosed = 0;
        $enclosedCoords = [];
        for ($line = 0; $line < count($input); $line++) {
            for ($column = 0; $column < strlen($input[$i]); $column++) {
                // part of the loop
                if (isset($paths["$line,$column"])) {
                    continue;
                }
                // outside the loop
                $hasTilesAbove = false;
                for ($checkLine = 0; $checkLine < $line; $checkLine++) {
                    if (isset($paths["$checkLine,$column"])) {
                        $hasTilesAbove = true;
                        break;
                    }
                }
                if (!$hasTilesAbove) {
                    continue;
                }
                $hasTilesBelow = false;
                for ($checkLine = count($input) - 1; $checkLine > $line; $checkLine--) {
                    if (isset($paths["$checkLine,$column"])) {
                        $hasTilesBelow = true;
                        break;
                    }
                }
                if (!$hasTilesBelow) {
                    continue;
                }
                $hasTilesToTheLeft = false;
                for ($checkColumn = 0; $checkColumn < $column; $checkColumn++) {
                    if (isset($paths["$line,$checkColumn"])) {
                        $hasTilesToTheLeft = true;
                        break;
                    }
                }
                if (!$hasTilesToTheLeft) {
                    continue;
                }
                $hasTilesToTheRight = false;
                for ($checkColumn = strlen($input[$i]) - 1; $checkColumn > $column; $checkColumn--) {
                    if (isset($paths["$line,$checkColumn"])) {
                        $hasTilesToTheRight = true;
                        break;
                    }
                }
                if (!$hasTilesToTheRight) {
                    continue;
                }

                $enclosedCoords[] = "$line,$column";
                $enclosed++;
            }
        }
        print_r("\npaths:\n");
        print_r($paths);
        print_r("\nenclosed:\n");
        print_r($enclosedCoords);
        return $enclosed;
    }
}