<?php

declare(strict_types=1);

namespace aoc2023;

class Day10
{
    const FACE_RIGHT = ['-', 'L', 'F', 'S'];
    const FACE_LEFT = ['-', 'J', '7', 'S'];
    const FACE_UP = ['|', 'L', 'J', 'S'];
    const FACE_DOWN = ['|', '7', 'F', 'S'];

    public static function executePartOne(array $input): int
    {
        $paths = self::getPaths($input);
        return max($paths);
    }

    public static function executePartTwo(array $input): int
    {
        $paths = self::getPaths($input);
        self::renderPrettyGrid($input, $paths);
        return 0;
    }

    private static function getPaths(array $input): array
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

                $line = $positionValues[0];
                $column = $positionValues[1];
                $checkToTheRight = in_array($input[$line][$column], self::FACE_RIGHT);
                $checkToTheLeft = in_array($input[$line][$column], self::FACE_LEFT);
                $checkUp = in_array($input[$line][$column], self::FACE_UP);
                $checkDown = in_array($input[$line][$column], self::FACE_DOWN);

                if ($checkToTheRight) {
                    $line = $positionValues[0];
                    $column = $positionValues[1] + 1;
                    if (!isset($paths["$line,$column"]) && in_array(substr($input[$line], $column, 1), self::FACE_LEFT)) {
                        $paths["$line,$column"] = $value + 1;
                    }
                }

                if ($checkToTheLeft && $column > 0) {
                    $line = $positionValues[0];
                    $column = $positionValues[1] - 1;
                    if (!isset($paths["$line,$column"]) && in_array(substr($input[$line], $column, 1), self::FACE_RIGHT)) {
                        $paths["$line,$column"] = $value + 1;
                    }
                }

                if ($checkUp) {
                    $line = $positionValues[0] - 1;
                    $column = $positionValues[1];
                    if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], self::FACE_DOWN)) {
                        $paths["$line,$column"] = $value + 1;
                    }
                }

                if ($checkDown) {
                    $line = $positionValues[0] + 1;
                    $column = $positionValues[1];
                    if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], self::FACE_UP)) {
                        $paths["$line,$column"] = $value + 1;
                    }
                }
            }
        }
        return $paths;
    }

    public static function renderPrettyGrid(array $input, array $paths): string
    {
        $grid = [];
        for ($i = 0; $i < count($input); $i++) {
            $gridRowText = '';
            for ($j = 0; $j < strlen($input[$i]); $j++) {
                if (!isset($paths["$i,$j"])) {
                    $gridRowText .= ' ';
                } else {
                    $letter = $input[$i][$j];
                    if ($letter === '-') {
                        $gridRowText .= '─';
                    } elseif ($letter === '|') {
                        $gridRowText .= '│';
                    } elseif ($letter === 'F') {
                        $gridRowText .= '┌';
                    } elseif ($letter === '7') {
                        $gridRowText .= '┐';
                    } elseif ($letter === 'L') {
                        $gridRowText .= '└';
                    } elseif ($letter === 'J') {
                        $gridRowText .= '┘';
                    } else {
                        $gridRowText .= '#';
                    }
                }
            }
            $grid[] = $gridRowText;
        }
        $gridText = implode("\n", $grid);
        print_r($gridText);
        return $gridText;
    }
}