namespace AdventOfCode._2021.Console;

public class Day13 : IDay
{
    public int DayNumber => 13;
    public int PartOneTestAnswer => 17;
    public int PartTwoTestAnswer => -1;

    public int ExecutePartOne(string[] input)
    {
        var result = FormatInputData(input);

        return result.Points.Length;
    }

    public static InputData FormatInputData(string[] input)
    {
        var indexOf = Array.IndexOf(input, string.Empty);
        var firstPartOfFile = input.Take(indexOf).Select(point =>
        {
            var coordinates = point.Split(',').Select(int.Parse).ToArray();
            return new Point(coordinates[0], coordinates[1]);
        }).ToArray();
        var secondPart = input.Skip(indexOf + 1).Select(foldStep =>
        {
            var pieces = foldStep[11..].Split('=');
            return new Fold(pieces[0], int.Parse(pieces[1]));
        }).ToArray();
        var result = new InputData(firstPartOfFile, secondPart);
        return result;
    }

    public int ExecutePartTwo(string[] input)
    {
        return 0;
    }

    public record struct Point(int X, int Y);

    public record struct Fold(string Orientation, int LineNumber);

    public record struct InputData(Point[] Points, Fold[] Folds);
}