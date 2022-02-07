namespace AdventOfCode._2021.Console;

public class Day13 : IDay
{
    public int DayNumber => 13;
    public int PartOneTestAnswer => 17;
    public int PartTwoTestAnswer => -1;

    public int ExecutePartOne(string[] input)
    {
        var result = FormatInputData(input);
        var finalPoints = FoldPaper(result.Points, result.Folds.First());

        return finalPoints.Length;
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

    public static Point[] FoldPaper(Point[] resultPoints, Fold fold)
    {
        int CalculateFoldNumber(int initialValue)
        {
            return 2 * fold.LineNumber - initialValue;
        }

        for (var i = 0; i < resultPoints.Length; i++)
        {
            switch (fold.Orientation)
            {
                case "x" when resultPoints[i].X > fold.LineNumber:
                    resultPoints[i].X = CalculateFoldNumber(resultPoints[i].X);
                    break;
                case "y" when resultPoints[i].Y > fold.LineNumber:
                    resultPoints[i].Y = CalculateFoldNumber(resultPoints[i].Y);
                    break;
            }
        }

        return resultPoints.Distinct().ToArray();
    }

    public int ExecutePartTwo(string[] input)
    {
        return 0;
    }

    public record struct Point(int X, int Y);

    public record struct Fold(string Orientation, int LineNumber);

    public record struct InputData(Point[] Points, Fold[] Folds);
}