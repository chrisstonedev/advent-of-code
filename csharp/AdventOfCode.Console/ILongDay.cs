namespace AdventOfCode.Console;

internal interface ILongDay : IDay
{
    long PartTwoTestAnswerLong { get; }
    long ExecutePartTwoLong(string[] input);
}