<?php

declare(strict_types=1);

namespace aoc2022;

class Day09
{
    public static function executePartOne(array $input): int
    {
        $head = [0, 0];
        $tail = null;
        $tailPositions = [];
        foreach ($input as $instruction) {
            $instructions = explode(' ', $instruction);
            $numberOfSteps = intval($instructions[1]);
            for ($i = 0; $i < $numberOfSteps; $i++) {
                $proposedNewHead = self::getProposedNewHead($head, $instructions[0]);
                if ($tail === null || (abs($proposedNewHead[0] - $tail[0]) > 1 && abs($proposedNewHead[1] - $tail[1]) > 0) || (abs($proposedNewHead[0] - $tail[0]) > 0 && abs($proposedNewHead[1] - $tail[1]) > 1)) {
                    $tail = $head;
                } else {
                    switch ($instructions[0]) {
                        case 'U':
                            if ($head[1] > $tail[1]) {
                                $tail[1]++;
                            }
                            break;
                        case 'D':
                            if ($head[1] < $tail[1]) {
                                $tail[1]--;
                            }
                            break;
                        case 'L':
                            if ($head[0] < $tail[0]) {
                                $tail[0]--;
                            }
                            break;
                        case 'R':
                            if ($head[0] > $tail[0]) {
                                $tail[0]++;
                            }
                            break;
                    }
                }
                $tailPositions = self::addToTailPositions($tail, $tailPositions);
                $head = $proposedNewHead;
            }
        }
        return count($tailPositions);
    }

    public static function executePartTwo(array $input): int
    {
        return 0;
    }

    private static function addToTailPositions(array $tail, array $tailPositions): array
    {
        $tailKey = implode(',', $tail);
        if (array_key_exists($tailKey, $tailPositions)) {
            $tailPositions[$tailKey]++;
        } else {
            $tailPositions[$tailKey] = 1;
        }
        return $tailPositions;
    }

    private static function getProposedNewHead(array $head, string $direction): array
    {
        switch ($direction) {
            case 'U':
                $head[1]++;
                break;
            case 'D':
                $head[1]--;
                break;
            case 'L':
                $head[0]--;
                break;
            case 'R':
                $head[0]++;
                break;
        }
        return $head;
    }
}