namespace AdventOfCode.Console;

public class Day12 : IIntDay
{
    public int DayNumber => 12;
    public int PartOneTestAnswer => 226;
    public int PartTwoTestAnswer => 3509;

    public int ExecutePartOne(string[] input)
    {
        var solver = new Solver(false);
        var paths = solver.GetAllDistinctPaths(input);
        return paths.Length;
    }

    public int ExecutePartTwo(string[] input)
    {
        var solver = new Solver(true);
        var paths = solver.GetAllDistinctPaths(input);
        return paths.Length;
    }

    public class Solver
    {
        private readonly bool _oneSmallCaveCanBeEnteredTwice;

        public Solver(bool oneSmallCaveCanBeEnteredTwice)
        {
            _oneSmallCaveCanBeEnteredTwice = oneSmallCaveCanBeEnteredTwice;
        }

        public string[] GetAllDistinctPaths(IEnumerable<string> input)
        {
            var connections = input.Select(x => new Connection(x.Split('-'))).ToArray();
            var allPaths = new List<List<string>>();
            var initialPath = new List<string> {"start"};
            allPaths.Add(initialPath);

            FindAllPathsToEnd(initialPath, connections, allPaths);

            return allPaths.Select(x => string.Join(',', x.ToArray())).ToArray();
        }

        private void FindAllPathsToEnd(List<string> currentPath, Connection[] connections,
            ICollection<List<string>> allPaths)
        {
            while (currentPath.Last() != "end")
            {
                var nextCaves = connections
                    .Where(connection => IsValidConnectionForPath(connection, currentPath))
                    .Select(connection => connection.GetOtherLocation(currentPath.Last())!)
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
                    FindAllPathsToEnd(newList, connections, allPaths);
                }
            }
        }

        private bool IsValidConnectionForPath(Connection connection, ICollection<string> currentPath)
        {
            var otherLocation = connection.GetOtherLocation(currentPath.Last());
            if (otherLocation is null)
            {
                return false;
            }

            if (otherLocation.All(char.IsUpper))
            {
                return true;
            }

            if (otherLocation == "start")
            {
                return false;
            }

            if (!_oneSmallCaveCanBeEnteredTwice || currentPath
                    .Where(x => char.IsLower(x.First()))
                    .GroupBy(x => x)
                    .Any(x => x.Count() > 1))
            {
                return !currentPath.Contains(otherLocation);
            }

            return currentPath.Count(previousLocation => previousLocation == otherLocation) <= 1;
        }
    }

    private readonly record struct Connection(string[] Locations)
    {
        public string? GetOtherLocation(string initialLocation) =>
            initialLocation == Locations[0] ? Locations[1] : initialLocation == Locations[1] ? Locations[0] : null;
    }
}