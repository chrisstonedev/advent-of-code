namespace advent_of_code_2021;

internal class Day12 : IDay
{
    public int DayNumber => 12;
    public int PartOneTestAnswer => 226;
    public int PartTwoTestAnswer => 3509;

    public int ExecutePartOne(string[] input)
    {
        var paths = GetAllDistinctPaths(input, false);
        return paths.Length;
    }

    public int ExecutePartTwo(string[] input)
    {
        var paths = GetAllDistinctPaths(input, true);
        return paths.Length;
    }

    public static string[] GetAllDistinctPaths(IEnumerable<string> input, bool smallCavesCanBeEnteredTwice)
    {
        var connections = input.Select(x =>
        {
            var pathPieces = x.Split('-');
            return new Connection(pathPieces[0], pathPieces[1]);
        }).ToArray();
        var allPaths = new List<List<string>>();
        var initialPath = new List<string> {"start"};
        allPaths.Add(initialPath);

        FindAllPathsToEnd(initialPath, connections, allPaths, smallCavesCanBeEnteredTwice);

        return allPaths.Select(x => string.Join(',', x.ToArray())).ToArray();
    }

    private static void FindAllPathsToEnd(List<string> currentPath, Connection[] connections,
        ICollection<List<string>> allPaths, bool smallCavesCanBeEnteredTwice)
    {
        while (currentPath.Last() != "end")
        {
            var last = currentPath.Last();
            var nextCaves = connections
                .Where(connection =>
                {
                    if (!connection.HasLocation(last))
                    {
                        return false;
                    }

                    var otherLocation = connection.GetOtherLocation(last);
                    if (otherLocation.All(char.IsUpper))
                    {
                        return true;
                    }

                    if (otherLocation == "start")
                    {
                        return false;
                    }

                    if (!smallCavesCanBeEnteredTwice)
                    {
                        return !currentPath.Contains(otherLocation);
                    }

                    var alreadyDuplicated = currentPath.Where(x => char.IsLower(x.First())).GroupBy(x => x).Any(x => x.Count() > 1);
                    if (alreadyDuplicated)
                    {
                        return !currentPath.Contains(otherLocation);
                    }

                    return currentPath.Count(previousLocation => previousLocation == otherLocation) <= 1;
                })
                .Select(x => x.GetOtherLocation(last))
                .ToArray();
            var currentPathArray = currentPath.ToArray();
            if (nextCaves.Length == 0)
            {
                allPaths.Remove(currentPath);
                return;
            }

            currentPath.Add(nextCaves.First());
            if (nextCaves.Length == 1)
            {
                continue;
            }

            foreach (var cave in nextCaves.Skip(1))
            {
                var newList = currentPathArray.Concat(new[] {cave}).ToList();
                allPaths.Add(newList);
                FindAllPathsToEnd(newList, connections, allPaths, smallCavesCanBeEnteredTwice);
            }
        }
    }

    private readonly record struct Connection(string Location1, string Location2)
    {
        public bool HasLocation(string location) => location == Location1 || location == Location2;
        public string GetOtherLocation(string initialLocation) => initialLocation == Location1 ? Location2 : Location1;
    }
}