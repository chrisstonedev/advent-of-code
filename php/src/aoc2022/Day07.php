<?php

declare(strict_types=1);

namespace aoc\aoc2022;

use function substr;

class Day07
{
    public static function executePartOne(array $input): int
    {
        $totalOfEachDirectoryRecursively = self::getTotalSizeOfEachDirectoryRecursively($input);
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
        $totalOfEachDirectoryRecursively = self::getTotalSizeOfEachDirectoryRecursively($input);
        $totalSpaceCurrently = $totalOfEachDirectoryRecursively['/'];
        sort($totalOfEachDirectoryRecursively);
        foreach ($totalOfEachDirectoryRecursively as $total) {
            if ($totalSpaceCurrently - $total <= 40000000) {
                return $total;
            }
        }
        return -1;
    }

    private static function getTotalSizeOfEachDirectoryRecursively(array $input): array
    {
        $totalOfEachDirectory = ['/' => 0];
        $currentWorkingDirectory = '';
        foreach ($input as $inputLine) {
            if (str_starts_with($inputLine, '$ cd ')) {
                $currentWorkingDirectory = self::getNewWorkingDirectory($currentWorkingDirectory, substr($inputLine, 5));
                if (!array_key_exists($currentWorkingDirectory, $totalOfEachDirectory)) {
                    $totalOfEachDirectory[$currentWorkingDirectory] = 0;
                }
            } elseif (!str_starts_with($inputLine, '$ ') && !str_starts_with($inputLine, 'dir ')) {
                $listFileComponents = explode(' ', $inputLine);
                $totalOfEachDirectory[$currentWorkingDirectory] += intval($listFileComponents[0]);
            }
        }
        $callback = function (&$directorySizeRecursively, string $path) use ($totalOfEachDirectory) {
            $result = 0;
            foreach (array_keys($totalOfEachDirectory) as $key) {
                if (str_starts_with($key, $path)) {
                    $result += $totalOfEachDirectory[$key];
                }
            }
            $directorySizeRecursively = $result;
        };
        array_walk($totalOfEachDirectory, $callback);
        return $totalOfEachDirectory;
    }

    private static function appendDirectoryToPath($currentWorkingDirectory, $relativePathToNewDirectory): string
    {
        if ($currentWorkingDirectory === '/') {
            return "/$relativePathToNewDirectory";
        }
        return "$currentWorkingDirectory/$relativePathToNewDirectory";
    }

    private static function getNewWorkingDirectory(string $currentWorkingDirectory, $relativePathToNewDirectory): string
    {
        if ($relativePathToNewDirectory === '/' || ($relativePathToNewDirectory === '..' && substr_count($currentWorkingDirectory, '/') === 1)) {
            return '/';
        }
        if ($relativePathToNewDirectory !== '..') {
            return self::appendDirectoryToPath($currentWorkingDirectory, $relativePathToNewDirectory);
        }
        $lastPositionOfSlash = strrpos($currentWorkingDirectory, '/');
        return substr($currentWorkingDirectory, 0, $lastPositionOfSlash);
    }
}