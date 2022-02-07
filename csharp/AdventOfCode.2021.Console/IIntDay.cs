namespace AdventOfCode._2021.Console;

internal interface IIntDay : IDay
{
    int PartTwoTestAnswer { get; }
    int ExecutePartTwo(string[] input);
}