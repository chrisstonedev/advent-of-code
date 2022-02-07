namespace advent_of_code_2021;

internal interface IDay
{
    int DayNumber { get; }
    int PartOneTestAnswer { get; }
    int PartTwoTestAnswer { get; }
    int ExecutePartOne(string[] input);
    int ExecutePartTwo(string[] input);
}