namespace advent_of_code_2021;

internal interface ILongDay : IDay
{
    long PartTwoTestAnswerLong { get; }
    long ExecutePartTwoLong(string[] input);
}