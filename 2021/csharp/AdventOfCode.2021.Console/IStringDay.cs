namespace AdventOfCode._2021.Console;

internal interface IStringDay : IDay
{
    string PartTwoTestAnswerString { get; }
    string ExecutePartTwoString(string[] input);
}