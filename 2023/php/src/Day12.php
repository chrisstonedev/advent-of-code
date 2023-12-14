<?php

declare(strict_types=1);

namespace aoc2023;

class Day12
{
    public static function executePartOne(array $input): int
    {
        $lineNo = 0;
        $possibleArrangements = 0;
        foreach ($input as $line) {
            print_r("line $lineNo: $line\n");
            flush();
            ob_flush();
            $lineNo++;
            $parts = explode(' ', $line);
            $record = $parts[0];
            $instructions = array_map('intval', explode(',', $parts[1]));

            $possibleArrangements += self::getCountOfPossibleArrangements($record, $instructions);
        }
        return $possibleArrangements;
    }

    public static function executePartTwo(array $input): int
    {
        $lineNo = 0;
        $possibleArrangements = 0;
        foreach ($input as $line) {
            $lineNo++;
            $parts = explode(' ', $line);
            $record = $parts[0];
            $instructions = array_map('intval', explode(',', $parts[1]));
            $allInstructions = [];
            $recordParts = [];
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < count($instructions); $j++) {
                    $allInstructions[] = $instructions[$j];
                }
                $recordParts[] = $record;
            }
            $fullRecord = implode('?', $recordParts);
            print_r("line $lineNo: $fullRecord\n");
            flush();
            ob_flush();

            $possibleArrangements += self::getCountOfPossibleArrangements($fullRecord, $allInstructions);
        }
        return $possibleArrangements;
    }

    public static function getCountOfPossibleArrangements(string $record, array $instructions)
    {
        $poundsAlreadyDefined = substr_count($record, '#');
        $questions = substr_count($record, '?');
        $totalPoundsNeeded = array_sum($instructions);
        $poundsWeStillNeed = $totalPoundsNeeded - $poundsAlreadyDefined;

        $combinations = self::getCombinations($questions, $poundsWeStillNeed);
        return self::replaceStringsEx($record, $combinations, $instructions);
    }

    public static function getCombinations(int $totalCharacters, int $questionCharacters): array
    {
        $inputWord = str_repeat('#', $questionCharacters) . str_repeat('.', $totalCharacters - $questionCharacters);
        $letters = str_split($inputWord);

        $currentSet = [''];

        for ($i = 0; $i < $totalCharacters; $i++) {
            $temporarySet = [];
            foreach ($currentSet as $currentWordInProgress) {
                foreach ($letters as $letter) {
                    // put some conditional here so we don't add impossible combinations
                    $newWord = $currentWordInProgress . $letter;
                    if (substr_count($newWord, '#') <= $questionCharacters
                        && substr_count($newWord, '.') <= ($totalCharacters - $questionCharacters)
                        && !in_array($newWord, $temporarySet)) {
                        $temporarySet[] = $newWord;
                    }
                }
            }
            $currentSet = $temporarySet;
        }
        return $currentSet;
    }

    public static function replaceStrings(string $stringToBeReplaced, array $stringReplaceIdeas): array
    {
        $stringsReplaced = [];
        foreach ($stringReplaceIdeas as $stringReplaceIdea) {
            $newString = $stringToBeReplaced;
            for ($i = 0; $i < strlen($stringReplaceIdea); $i++) {
                $position = strpos($newString, '?');
                $newString = substr_replace($newString, $stringReplaceIdea[$i], $position, 1);
            }
            $stringsReplaced[] = $newString;
        }
        return $stringsReplaced;
    }

    public static function replaceStringsEx(string $stringToBeReplaced, array $stringReplaceIdeas, array $requiredPattern): int
    {
        $pattern = '/' . implode('\.+', array_map(fn($number) => '#{' . $number . '}', $requiredPattern)) . '/';
        $stringsReplaced = 0;
        foreach ($stringReplaceIdeas as $stringReplaceIdea) {
            $newString = $stringToBeReplaced;
            for ($i = 0; $i < strlen($stringReplaceIdea); $i++) {
                $position = strpos($newString, '?');
                $newString = substr_replace($newString, $stringReplaceIdea[$i], $position, 1);
            }
            if (preg_match($pattern, $newString)) {
                $stringsReplaced++;
            }
        }
        return $stringsReplaced;
    }
}