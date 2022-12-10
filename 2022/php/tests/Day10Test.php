<?php

namespace test2022;

use aoc2022\Day10 as Day;
use PHPUnit\Framework\TestCase;

class Day10Test extends TestCase
{
    public function testPart1()
    {
        $testInput = Utils::ReadAllLines('test10');
        $this->assertSame(13140, Day::executePartOne($testInput));
    }

    public function testPart2()
    {
        $input = Utils::ReadAllLines('test10');
        $this->assertSame(0, Day::executePartTwo($input));
    }
}