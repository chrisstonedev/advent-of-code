namespace AdventOfCode.Console;

internal interface IStringDay : IDay
{
    string PartTwoTestAnswerString { get; }
    string ExecutePartTwoString(string[] input);
}