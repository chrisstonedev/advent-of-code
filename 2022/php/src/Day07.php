<?php

declare(strict_types=1);

namespace aoc2022;

class Day07
{
    public static function executePartOne(array $input): int
    {
        $totalOfEachDirectory = ['/' => 0];
        $currentWorkingDirectory = '';
        foreach ($input as $inputLine) {
            if (substr($inputLine, 0, 2) === '$ ') {
                if (substr($inputLine, 2, 3) === 'cd ') {
                    $relativePathToNewDirectory = substr($inputLine, 5);
                    if ($relativePathToNewDirectory === '..') {
                        $lastPosition = strrpos($currentWorkingDirectory, '/');
                        $currentWorkingDirectory = substr($currentWorkingDirectory, 0, $lastPosition);
                        if (strlen($currentWorkingDirectory) === 0) {
                            $currentWorkingDirectory = '/';
                        }
                    } elseif ($relativePathToNewDirectory === '/') {
                        $currentWorkingDirectory = '/';
                    } else {
                        if (substr($currentWorkingDirectory, -1) === '/') {
                            $currentWorkingDirectory .= $relativePathToNewDirectory;
                        } else {
                            $currentWorkingDirectory .= '/' . $relativePathToNewDirectory;
                        }
                    }
                }
            } else {
                $things = explode(' ', $inputLine);
                if ($things[0] === 'dir') {
                    if (substr($currentWorkingDirectory, -1) === '/') {
                        $absoluteDirectoryPath = $currentWorkingDirectory . $things[1];
                    } else {
                        $absoluteDirectoryPath = $currentWorkingDirectory . '/' . $things[1];
                    }
                    $totalOfEachDirectory[$absoluteDirectoryPath] = 0;
                } else {
                    $totalOfEachDirectory[$currentWorkingDirectory] += $things[0];
                }
            }
        }
        $callback = function (string $path, int $element) use ($totalOfEachDirectory): int {
            $result = 0;
            foreach (array_keys($totalOfEachDirectory) as $key) {
                if (substr($key, 0, strlen($path)) === $path) {
                    $result += $totalOfEachDirectory[$key];
                }
            }
            return $result;
        };
        $totalOfEachDirectoryRecursively = array_map($callback, array_keys($totalOfEachDirectory), array_values($totalOfEachDirectory));
        $result = 0;
        foreach ($totalOfEachDirectoryRecursively as $total) {
            if ($total <= 100000) {
                $result += $total;
            }
        }
        return $result;
    }

    public static function executePartTwo(array $input): int
    {
        $totalOfEachDirectory = ['/' => 0];
        $currentWorkingDirectory = '';
        foreach ($input as $inputLine) {
            if (substr($inputLine, 0, 2) === '$ ') {
                if (substr($inputLine, 2, 3) === 'cd ') {
                    $relativePathToNewDirectory = substr($inputLine, 5);
                    if ($relativePathToNewDirectory === '..') {
                        $lastPosition = strrpos($currentWorkingDirectory, '/');
                        $currentWorkingDirectory = substr($currentWorkingDirectory, 0, $lastPosition);
                        if (strlen($currentWorkingDirectory) === 0) {
                            $currentWorkingDirectory = '/';
                        }
                    } elseif ($relativePathToNewDirectory === '/') {
                        $currentWorkingDirectory = '/';
                    } else {
                        if (substr($currentWorkingDirectory, -1) === '/') {
                            $currentWorkingDirectory .= $relativePathToNewDirectory;
                        } else {
                            $currentWorkingDirectory .= '/' . $relativePathToNewDirectory;
                        }
                    }
                }
            } else {
                $things = explode(' ', $inputLine);
                if ($things[0] === 'dir') {
                    if (substr($currentWorkingDirectory, -1) === '/') {
                        $absoluteDirectoryPath = $currentWorkingDirectory . $things[1];
                    } else {
                        $absoluteDirectoryPath = $currentWorkingDirectory . '/' . $things[1];
                    }
                    $totalOfEachDirectory[$absoluteDirectoryPath] = 0;
                } else {
                    $totalOfEachDirectory[$currentWorkingDirectory] += $things[0];
                }
            }
        }
        $callback = function (string $path, int $element) use ($totalOfEachDirectory): int {
            $result = 0;
            foreach (array_keys($totalOfEachDirectory) as $key) {
                if (substr($key, 0, strlen($path)) === $path) {
                    $result += $totalOfEachDirectory[$key];
                }
            }
            return $result;
        };
        $totalOfEachDirectoryRecursively = array_map($callback, array_keys($totalOfEachDirectory), array_values($totalOfEachDirectory));
        $totalSpaceCurrently = $totalOfEachDirectoryRecursively[0];
        sort($totalOfEachDirectoryRecursively);
        foreach ($totalOfEachDirectoryRecursively as $total) {
            if ($totalSpaceCurrently - $total <= 40000000) {
                return $total;
            }
        }
        return -1;
    }
}