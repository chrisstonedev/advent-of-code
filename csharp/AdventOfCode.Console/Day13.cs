namespace AdventOfCode.Console;

public class Day13 : IStringDay
{
    public int DayNumber => 13;
    public int PartOneTestAnswer => 17;
    public string PartTwoTestAnswerString => ".";

    public int ExecutePartOne(string[] input)
    {
        var (points, folds) = FormatInputData(input);
        points = FoldPaper(points, folds.First());

        return points.Length;
    }

    [Obsolete($"Use {nameof(ExecutePartTwoString)} instead.")]
    public int ExecutePartTwo(string[] _) => throw new NotImplementedException();

    public string ExecutePartTwoString(string[] input)
    {
        var (points, folds) = FormatInputData(input);
        foreach (var fold in folds)
        {
            points = FoldPaper(points, fold);
        }

        var rawText = GetRawText(points);
        return InterpretRawText(rawText);
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

    public static Point[] FoldPaper(Point[] points, Fold fold)
    {
        int CalculateFoldNumber(int initialValue)
        {
            return 2 * fold.LineNumber - initialValue;
        }

        for (var i = 0; i < points.Length; i++)
        {
            switch (fold.Orientation)
            {
                case "x" when points[i].X > fold.LineNumber:
                    points[i].X = CalculateFoldNumber(points[i].X);
                    break;
                case "y" when points[i].Y > fold.LineNumber:
                    points[i].Y = CalculateFoldNumber(points[i].Y);
                    break;
            }
        }

        return points.Distinct().ToArray();
    }

    public static IEnumerable<string> GetRawText(Point[] points)
    {
        var width = points.Max(x => x.X);
        var height = points.Max(x => x.Y);

        for (var row = 0; row <= height; row++)
        {
            var line = string.Empty;
            for (var col = 0; col <= width; col++)
            {
                line += points.Contains(new Point(col, row)) ? "#" : ".";
            }

            yield return line;
        }
    }

    private static readonly Dictionary<string, string> KnownLetters = new()
    {
        {"####\n#...\n#...\n#...\n####", "."},
        {".##.\n#..#\n#..#\n####\n#..#\n#..#", "A"},
        {".##.\n#..#\n#...\n#...\n#..#\n.##.", "C"},
        {"#..#\n#..#\n####\n#..#\n#..#\n#..#", "H"},
        {"..##\n...#\n...#\n...#\n#..#\n.##.", "J"},
        {"#..#\n#.#.\n##..\n#.#.\n#.#.\n#..#", "K"},
        {"#..#\n#..#\n#..#\n#..#\n#..#\n.##.", "U"},
        {"####\n...#\n..#.\n.#..\n#...\n####", "Z"}
    };

    public static string InterpretRawText(IEnumerable<string> pointsText)
    {
        var textLines = pointsText.ToArray();
        var letters = new List<string>();
        for (var letterStartIndex = 0; letterStartIndex < textLines.First().Length; letterStartIndex += 5)
        {
            var letterText = string.Join(Environment.NewLine, textLines.Select(x => x.Substring(letterStartIndex, 4)).ToArray());
            letters.Add(KnownLetters.TryGetValue(letterText, out var letter) ? letter : "?");
        }

        return string.Join(string.Empty, letters);
    }

    public record struct Point(int X, int Y);

    public record struct Fold(string Orientation, int LineNumber);

    public record struct InputData(Point[] Points, Fold[] Folds);
}