<?php

namespace test\test2022;

use aoc\aoc2022\Day10 as Day;
use PHPUnit\Framework\TestCase;
use test\Utils;

class Day10Test extends TestCase
{
    public function testPart1()
    {
        $testInput = Utils::ReadAllLines('2022_10_test');
        $this->assertSame(13140, Day::executePartOne($testInput));
    }

    public function testPart2()
    {
        $input = Utils::ReadAllLines('2022_10_test');
        $expected = '##..##..##..##..##..##..##..##..##..##..
###...###...###...###...###...###...###.
####....####....####....####....####....
#####.....#####.....#####.....#####.....
######......######......######......####
#######.......#######.......#######.....';
        $this->assertSame($expected, Day::executePartTwo($input));
    }
}