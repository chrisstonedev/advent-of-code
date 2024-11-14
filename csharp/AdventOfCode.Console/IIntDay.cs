namespace AdventOfCode.Console;

internal interface IIntDay : IDay
{
    int PartTwoTestAnswer { get; }
    int ExecutePartTwo(string[] input);
}