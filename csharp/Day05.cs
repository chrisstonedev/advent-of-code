internal class Day05 : IDay
{
    public int DayNumber => 5;
    public int PartOneTestAnswer => 5;
    public int PartTwoTestAnswer => 12;

    public int ExecutePartOne(string[] input)
    {
        var lines = input.Select(ToLine);
        var noDiagonalLines = lines.Where(x => x.HorizontalDirection == Direction.NoChange || x.VerticalDirection == Direction.NoChange);
        var flattenedList = (from line in noDiagonalLines from points in line.Path select points).ToList();
        return flattenedList.GroupBy(x => x).Count(x => x.Count() >= 2);
    }

    public int ExecutePartTwo(string[] input)
    {
        var lines = input.Select(ToLine);
        var flattenedList = (from line in lines from points in line.Path select points).ToList();
        return flattenedList.GroupBy(x => x).Count(x => x.Count() >= 2);
    }

    private Line ToLine(string inputLine)
    {
        var points = inputLine.Split(" -> ");
        var startPoints = points.First().Split(",").Select(int.Parse);
        var start = new Point(startPoints.First(), startPoints.Last());
        var endPoints = points.Last().Split(",").Select(int.Parse);
        var end = new Point(endPoints.First(), endPoints.Last());
        var path = new List<Point>();

        if (start.X == end.X && start.Y == end.Y)
        {
            path.Add(new Point(start.X, start.Y));
            return new Line(start, end, path.ToArray(), Direction.NoChange, Direction.NoChange);
        }

        if (start.X == end.X)
        {
            if (start.Y < end.Y)
            {
                for (var y = start.Y; y <= end.Y; y++)
                {
                    path.Add(new Point(start.X, y));
                }
                return new Line(start, end, path.ToArray(), Direction.NoChange, Direction.Forward);
            }

            for (var y = start.Y; y >= end.Y; y--)
            {
                path.Add(new Point(start.X, y));
            }
            return new Line(start, end, path.ToArray(), Direction.NoChange, Direction.Backward);
        }

        if (start.Y == end.Y)
        {
            if (start.X < end.X)
            {
                for (var x = start.X; x <= end.X; x++)
                {
                    path.Add(new Point(x, start.Y));
                }
                return new Line(start, end, path.ToArray(), Direction.Forward, Direction.NoChange);
            }

            for (var x = start.X; x >= end.X; x--)
            {
                path.Add(new Point(x, start.Y));
            }
            return new Line(start, end, path.ToArray(), Direction.Backward, Direction.NoChange);
        }

        if (start.X < end.X && start.Y < end.Y && end.X - start.X == end.Y - start.Y)
        {
            var distance = end.X - start.X;
            for (var i = 0; i <= distance; i++)
            {
                path.Add(new Point(start.X + i, start.Y + i));
            }
            ThrowExceptionIfPointsDoNotMatch(path.Last(), end);
            return new Line(start, end, path.ToArray(), Direction.Forward, Direction.Forward);
        }

        if (start.X > end.X && start.Y > end.Y && start.X - end.X == start.Y - end.Y)
        {
            var distance = start.X - end.X;
            for (var i = 0; i <= distance; i++)
            {
                path.Add(new Point(start.X - i, start.Y - i));
            }
            ThrowExceptionIfPointsDoNotMatch(path.Last(), end);
            return new Line(start, end, path.ToArray(), Direction.Backward, Direction.Backward);
        }

        if (start.X < end.X && start.Y > end.Y && end.X - start.X == start.Y - end.Y)
        {
            var distance = end.X - start.X;
            for (var i = 0; i <= distance; i++)
            {
                path.Add(new Point(start.X + i, start.Y - i));
            }
            ThrowExceptionIfPointsDoNotMatch(path.Last(), end);
            return new Line(start, end, path.ToArray(), Direction.Forward, Direction.Backward);
        }

        if (start.X > end.X && start.Y < end.Y && start.X - end.X == end.Y - start.Y)
        {
            var distance = start.X - end.X;
            for (var i = 0; i <= distance; i++)
            {
                path.Add(new Point(start.X - i, start.Y + i));
            }
            ThrowExceptionIfPointsDoNotMatch(path.Last(), end);
            return new Line(start, end, path.ToArray(), Direction.Backward, Direction.Forward);
        }

        throw new Exception("Data would result in a line that is not straight");
    }

    private static void ThrowExceptionIfPointsDoNotMatch(Point path, Point end)
    {
        if (path.X != end.X || path.Y != end.Y)
        {
            throw new Exception("Diagonal math failed");
        }
    }

    enum Direction { Backward, NoChange, Forward }
    readonly record struct Point(int X, int Y);
    readonly record struct Line(Point Start, Point End, Point[] Path, Direction HorizontalDirection, Direction VerticalDirection);
}