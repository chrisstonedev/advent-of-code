﻿namespace AdventOfCode._2021.Console;

internal interface IDay
{
    int DayNumber { get; }
    int PartOneTestAnswer { get; }
    int ExecutePartOne(string[] input);
}