namespace AdventOfCode._2021.Console;

internal interface ILongDay : IDay
{
    long PartTwoTestAnswerLong { get; }
    long ExecutePartTwoLong(string[] input);
}