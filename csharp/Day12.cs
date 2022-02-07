namespace advent_of_code_2021;

internal class Day12 : IDay
{
    public int DayNumber => 12;
    public int PartOneTestAnswer => 226;
    public int PartTwoTestAnswer => -1;

    public int ExecutePartOne(string[] input)
    {
        var paths = GetAllDistinctPaths(input);
        return paths.Length;
    }

    public int ExecutePartTwo(string[] input)
    {
        return 0;
    }

    public static string[] GetAllDistinctPaths(string[] input)
    {
        var connections = input.Select(x =>
        {
            var pathPieces = x.Split('-');
            return new Connection(pathPieces[0], pathPieces[1]);
        }).ToArray();
        var oneGoodPath = new List<string> {"start"};
        while (oneGoodPath.Last() != "end")
        {
            var last = oneGoodPath.Last();
            var nextCave = connections
                .First(x => x.HasLocation(last) && !oneGoodPath.Contains(x.GetOtherLocation(last)))
                .GetOtherLocation(last);
            oneGoodPath.Add(nextCave);
        }

        var goodArray = oneGoodPath.ToArray();
        var goodPathString = string.Join(',', goodArray);
        return new[] {goodPathString};
    }

    private readonly record struct Connection(string Location1, string Location2)
    {
        public bool HasLocation(string location) => location == Location1 || location == Location2;
        public string GetOtherLocation(string initialLocation) => initialLocation == Location1 ? Location2 : Location1;
    }
}