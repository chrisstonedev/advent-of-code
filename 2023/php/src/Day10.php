<?php

declare(strict_types=1);

namespace aoc2023;

class Day10
{
    const FACE_RIGHT = ['-', 'L', 'F'];
    const FACE_LEFT = ['-', 'J', '7'];
    const FACE_UP = ['|', 'L', 'J'];
    const FACE_DOWN = ['|', '7', 'F'];
    const ENCLOSED_SEARCH_OUTSIDE = 0;
    const ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_BOTTOM = 1;
    const ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_TOP = 2;
    const ENCLOSED_SEARCH_INSIDE = 3;
    const ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_TOP = 4;
    const ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_BOTTOM = 5;

    public static function executePartOne(array $input): int
    {
        $paths = self::getPaths($input);
        return max($paths);
    }

    public static function executePartTwo(array $input): int
    {
        $paths = self::getPaths($input);
        $enclosedThings = self::getEnclosedThings($input, $paths);
        return count($enclosedThings);
    }

    public static function getPaths(array &$input): array
    {
        $paths = [];
        for ($i = 0; $i < count($input); $i++) {
            $possibleStartPosition = strpos($input[$i], 'S');
            if ($possibleStartPosition !== false) {
                $paths["$i,$possibleStartPosition"] = 0;

                $foundToTheRight = false;
                $foundToTheLeft = false;
                $foundUp = false;
                $foundDown = false;

                $positionValues = [$i, $possibleStartPosition];
                if (in_array($input[$positionValues[0]][$positionValues[1] + 1], self::FACE_LEFT)) {
                    $foundToTheRight = true;
                }

                if ($positionValues[1] > 0) {
                    if (in_array($input[$positionValues[0]][$positionValues[1] - 1], self::FACE_RIGHT)) {
                        $foundToTheLeft = true;
                    }
                }

                if (in_array($input[$positionValues[0] - 1][$positionValues[1]], self::FACE_DOWN)) {
                    $foundUp = true;
                }

                if (in_array($input[$positionValues[0] + 1][$positionValues[1]], self::FACE_UP)) {
                    $foundDown = true;
                }

                if ($foundUp && $foundToTheLeft) {
                    $input[$positionValues[0]][$positionValues[1]] = 'J';
                } elseif ($foundUp && $foundDown) {
                    $input[$positionValues[0]][$positionValues[1]] = '|';
                } elseif ($foundUp && $foundToTheRight) {
                    $input[$positionValues[0]][$positionValues[1]] = 'L';
                } elseif ($foundToTheLeft && $foundToTheRight) {
                    $input[$positionValues[0]][$positionValues[1]] = '-';
                } elseif ($foundToTheLeft && $foundDown) {
                    $input[$positionValues[0]][$positionValues[1]] = '7';
                } elseif ($foundToTheRight && $foundDown) {
                    $input[$positionValues[0]][$positionValues[1]] = 'F';
                }

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
                    $column = $positionValues[1] + 1;
                    if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], self::FACE_LEFT)) {
                        $paths["$line,$column"] = $value + 1;
                    }
                }

                if ($checkToTheLeft && $column > 0) {
                    $column = $positionValues[1] - 1;
                    if (!isset($paths["$line,$column"]) && in_array($input[$line][$column], self::FACE_RIGHT)) {
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

    public static function renderPrettyGrid(array $input, array $paths, ?array $enclosedThings): string
    {
        $grid = [];
        for ($i = 0; $i < count($input); $i++) {
            $gridRowText = '';
            for ($j = 0; $j < strlen($input[$i]); $j++) {
                if (isset($enclosedThings["$i,$j"])) {
                    $gridRowText .= '1';
                } elseif (!isset($paths["$i,$j"])) {
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
        return implode("\n", $grid);
    }

    public
    static function getEnclosedThings(array $input, array $paths): array
    {
        $enclosedThings = [];
        for ($line = 0; $line < count($input); $line++) {
            $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
            for ($column = 0; $column < strlen($input[$line]); $column++) {
                if (!isset($paths["$line,$column"])) {
                    if ($currentState === self::ENCLOSED_SEARCH_INSIDE) {
                        $enclosedThings["$line,$column"] = 1;
                    }
                    continue;
                }
                if ($currentState === self::ENCLOSED_SEARCH_OUTSIDE && $input[$line][$column] == 'F') {
                    $currentState = self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_BOTTOM;
                } elseif ($currentState === self::ENCLOSED_SEARCH_OUTSIDE && $input[$line][$column] == 'L') {
                    $currentState = self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_TOP;
                } elseif ($currentState === self::ENCLOSED_SEARCH_OUTSIDE && $input[$line][$column] === '|') {
                    $currentState = self::ENCLOSED_SEARCH_INSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_BOTTOM && $input[$line][$column] == 'J') {
                    $currentState = self::ENCLOSED_SEARCH_INSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_BOTTOM && $input[$line][$column] == '7') {
                    $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_TOP && $input[$line][$column] == 'J') {
                    $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_IN_FROM_TOP && $input[$line][$column] == '7') {
                    $currentState = self::ENCLOSED_SEARCH_INSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_INSIDE && $input[$line][$column] == 'L') {
                    $currentState = self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_TOP;
                } elseif ($currentState === self::ENCLOSED_SEARCH_INSIDE && $input[$line][$column] == 'F') {
                    $currentState = self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_BOTTOM;
                } elseif ($currentState === self::ENCLOSED_SEARCH_INSIDE && $input[$line][$column] == '|') {
                    $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_BOTTOM && $input[$line][$column] == 'J') {
                    $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_BOTTOM && $input[$line][$column] == '7') {
                    $currentState = self::ENCLOSED_SEARCH_INSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_TOP && $input[$line][$column] == 'J') {
                    $currentState = self::ENCLOSED_SEARCH_INSIDE;
                } elseif ($currentState === self::ENCLOSED_SEARCH_ON_THE_WAY_OUT_FROM_TOP && $input[$line][$column] == '7') {
                    $currentState = self::ENCLOSED_SEARCH_OUTSIDE;
                }
            }
        }
        return $enclosedThings;
    }
}