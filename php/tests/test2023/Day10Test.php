<?php

declare(strict_types=1);

namespace test\test2023;

use aoc\aoc2023\Day10 as Day;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day10Test extends TestCase
{
    const string DAY_NUMBER = '10';

    #[DataProvider('part1WithoutFilesProvider')] public function testPart1WithoutFiles(array $testInput, int $expected)
    {
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1WithoutFilesProvider(): array
    {
        return [
            'distance of 0' => [['S.', '..'], 0],
            'distance of 1' => [['S-', '|.'], 1],
            'distance of 2' => [['S7', 'LJ'], 2],
        ];
    }

    #[DataProvider('part1Provider')] public function testPart1(string $filename, int $expected)
    {
        $testInput = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartOne($testInput));
    }

    public static function part1Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 8],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 6786],
        ];
    }

    #[DataProvider('part2Provider')] public function testPart2(string $filename, int $expected)
    {
        $input = Utils::ReadAllLines($filename);
        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2Provider(): array
    {
        return [
            'test' => [sprintf("2023_%s_test", self::DAY_NUMBER), 1],
            'input' => [sprintf("2023_%s_input", self::DAY_NUMBER), 495],
        ];
    }

    #[DataProvider('part2WithoutFilesProvider')] public function testPart2WithoutFiles(array $input, int $expected)
    {
        $inputCopy = $input;
        $paths = Day::getPaths($inputCopy);
        $enclosed = Day::getEnclosedThings($input, $paths);
        print_r(Day::renderPrettyGrid($input, $paths, $enclosed));

        $this->assertSame($expected, Day::executePartTwo($input));
    }

    public static function part2WithoutFilesProvider(): array
    {
        return [
            '3 inside box with no padding' => [['S---7', '|...|', 'L---J'], 3],
            '3 inside box with padding' => [['.S---7.', '.|...|.', '.L---J.'], 3],
            'box with upper-right corner' => [['.S--7..', '.|..L7.', '.L---J.'], 2],
            'box with lower-right corner' => [['.S---7.', '.|..FJ.', '.L--J..'], 2],
            'box with upper-left corner' => [['..S--7.', '.FJ..|.', '.L---J.'], 2],
            'box with lower-left corner' => [['.S---7.', '.L7..|.', '..L--J.'], 2],
            'start in horizontal bar' => [['.F-S-7.', '.|...|.', '.L---J.'], 3],
            'start in upper-right corner' => [['.F---S.', '.|...|.', '.L---J.'], 3],
            'start in lower-left corner' => [['.F---7.', '.|...|.', '.S---J.'], 3],
            'start in lower-right corner' => [['.F---7.', '.|...|.', '.L---S.'], 3],
        ];
    }

    #[DataProvider('renderPrettyGridProvider')] public function testRenderPrettyGrid(array $input, array $expected)
    {
        $paths = Day::getPaths($input);
        $this->assertSame(implode("\n", $expected), Day::renderPrettyGrid($input, $paths, null));
    }

    public static function renderPrettyGridProvider(): array
    {
        return [
            '3 inside box with no padding' => [['S---7', '|...|', 'L---J'], ['┌───┐', '│   │', '└───┘']],
            '3 inside box with padding' => [['.S---7.', '.|...|.', '.L---J.'], [' ┌───┐ ', ' │   │ ', ' └───┘ ']],
            'box with upper-right corner' => [['.S--7..', '.|..L7.', '.L---J.'], [' ┌──┐  ', ' │  └┐ ', ' └───┘ ']],
            'box with lower-right corner' => [['.S---7.', '.|..FJ.', '.L--J..'], [' ┌───┐ ', ' │  ┌┘ ', ' └──┘  ']],
            'box with upper-left corner' => [['..S--7.', '.FJ..|.', '.L---J.'], ['  ┌──┐ ', ' ┌┘  │ ', ' └───┘ ']],
            'box with lower-left corner' => [['.S---7.', '.L7..|.', '..L--J.'], [' ┌───┐ ', ' └┐  │ ', '  └──┘ ']],
            'start in horizontal bar' => [['.F-S-7.', '.|...|.', '.L---J.'], [' ┌───┐ ', ' │   │ ', ' └───┘ ']],
            'start in upper-right corner' => [['.F---S.', '.|...|.', '.L---J.'], [' ┌───┐ ', ' │   │ ', ' └───┘ ']],
            'start in lower-left corner' => [['.F---7.', '.|...|.', '.S---J.'], [' ┌───┐ ', ' │   │ ', ' └───┘ ']],
            'start in lower-right corner' => [['.F---7.', '.|...|.', '.L---S.'], [' ┌───┐ ', ' │   │ ', ' └───┘ ']],
        ];
    }
}