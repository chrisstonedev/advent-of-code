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
        var allPaths = new List<List<string>>();
        var initialPath = new List<string> {"start"};
        allPaths.Add(initialPath);

        FindAllPathsToEnd(initialPath, connections, allPaths);

        return allPaths.Select(x => string.Join(',', x.ToArray())).ToArray();
    }

    private static void FindAllPathsToEnd(List<string> currentPath, Connection[] connections,
        ICollection<List<string>> allPaths)
    {
        while (currentPath.Last() != "end")
        {
            var last = currentPath.Last();
            var nextCaves = connections
                .Where(x => x.HasLocation(last) && !currentPath.Contains(x.GetOtherLocation(last)))
                .Select(x => x.GetOtherLocation(last))
                .ToArray();
            var currentPathArray = currentPath.ToArray();
            currentPath.Add(nextCaves.First());

            if (nextCaves.Length == 1) continue;
            
            var newList = currentPathArray.Concat(new[] {nextCaves.Last()}).ToList();
            allPaths.Add(newList);
            FindAllPathsToEnd(newList, connections, allPaths);
        }
    }

    private readonly record struct Connection(string Location1, string Location2)
    {
        public bool HasLocation(string location) => location == Location1 || location == Location2;
        public string GetOtherLocation(string initialLocation) => initialLocation == Location1 ? Location2 : Location1;
    }
}