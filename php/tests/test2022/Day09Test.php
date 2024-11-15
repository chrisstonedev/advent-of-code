<?php

namespace test\test2022;

use aoc\aoc2022\Day09 as Day;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day09Test extends TestCase
{
    public function testPart1()
    {
        $testInput = Utils::ReadAllLines('2022_09_test');
        $this->assertSame(13, Day::executePartOne($testInput));
    }

    public function testPart2()
    {
        $this->markTestSkipped('Did not solve part 2 in PHP yet.');
        $input = Utils::ReadAllLines('2022_09_test');
        $this->assertSame(1, Day::executePartTwo($input));
    }

    public function testPart2FromString()
    {
        $this->markTestSkipped('Did not solve part 2 in PHP yet.');
        $input = [
            'R 5',
            'U 8',
            'L 8',
            'D 3',
            'R 17',
            'D 10',
            'L 25',
            'U 20',
        ];
        $this->assertSame(36, Day::executePartTwo($input));
    }
}