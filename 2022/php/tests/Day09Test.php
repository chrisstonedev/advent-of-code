<?php

namespace test2022;

use aoc2022\Day09 as Day;
use PHPUnit\Framework\TestCase;

class Day09Test extends TestCase
{
    public function testPart1()
    {
        $testInput = Utils::ReadAllLines('test09');
        $this->assertSame(13, Day::executePartOne($testInput));
    }

    public function testPart2()
    {
        $input = Utils::ReadAllLines('test09');
        $this->assertSame(1, Day::executePartTwo($input));
    }

    public function testPart2FromString()
    {
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