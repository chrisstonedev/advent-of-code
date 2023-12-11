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
        $enclosed = 0;
        $enclosedThings = [];
        for ($line = 0; $line < count($input); $line++) {
            /*
             * 0 - outside
             * 1 - on the way in, coming from the bottom
             * 4 - on the way in, coming from the top
             * 2 - inside
             * 3 - on the way out, coming from the bottom
             * 5 - on the way out, coming from the top
             */
            $currentState = 0;
            for ($column = 0; $column < strlen($input[$line]); $column++) {
                if (!isset($paths["$line,$column"])) {
                    if ($currentState === 2) {
                        $enclosed++;
                        $enclosedThings["$line,$column"] = 1;
                    }
                    continue;
                }
                if ($currentState === 0 && ($input[$line][$column] == 'F' || $input[$line][$column] === 'S')) {
                    $currentState = 1;
                } elseif ($currentState === 0 && ($input[$line][$column] == 'L' || $input[$line][$column] === 'S')) {
                    $currentState = 4;
                } elseif ($currentState === 0 && ($input[$line][$column] === '|' || $input[$line][$column] === 'S')) {
                    $currentState = 2;
                } elseif ($currentState === 1 && ($input[$line][$column] == 'J' || $input[$line][$column] === 'S')) {
                    $currentState = 2;
                } elseif ($currentState === 1 && ($input[$line][$column] == '7' || $input[$line][$column] === 'S')) {
                    $currentState = 0;
                } elseif ($currentState === 4 && ($input[$line][$column] == 'J' || $input[$line][$column] === 'S')) {
                    $currentState = 0;
                } elseif ($currentState === 4 && ($input[$line][$column] == '7' || $input[$line][$column] === 'S')) {
                    $currentState = 2;
                } elseif ($currentState === 2 && ($input[$line][$column] == 'L' || $input[$line][$column] === 'S')) {
                    $currentState = 5;
                } elseif ($currentState === 2 && ($input[$line][$column] == 'F' || $input[$line][$column] === 'S')) {
                    $currentState = 3;
                } elseif ($currentState === 2 && ($input[$line][$column] == '|' || $input[$line][$column] === 'S')) {
                    $currentState = 0;
                } elseif ($currentState === 3 && ($input[$line][$column] == 'J' || $input[$line][$column] === 'S')) {
                    $currentState = 0;
                } elseif ($currentState === 3 && ($input[$line][$column] == '7' || $input[$line][$column] === 'S')) {
                    $currentState = 2;
                } elseif ($currentState === 5 && ($input[$line][$column] == 'J' || $input[$line][$column] === 'S')) {
                    $currentState = 2;
                } elseif ($currentState === 5 && ($input[$line][$column] == '7' || $input[$line][$column] === 'S')) {
                    $currentState = 0;
                }
            }
        }
        self::renderPrettyGridWithEnclosed($input, $paths, $enclosedThings);
        return $enclosed;
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

    public static function renderPrettyGridWithEnclosed(array $input, array $paths, array $enclosedThings): string
    {
        print_r("\n");
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
        $gridText = implode("\n", $grid);
        print_r($gridText);
        return $gridText;
    }
}