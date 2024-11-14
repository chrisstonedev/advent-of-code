using System.Runtime.CompilerServices;

namespace AdventOfCode.Console;

public class Day14 : ILongDay
{
    public int DayNumber => 14;
    public int PartOneTestAnswer => 1588;
    public long PartTwoTestAnswerLong => 2188189693529;

    public int ExecutePartOne(string[] input)
    {
        return (int) SolveProblem(input, 10);
    }

    public long ExecutePartTwoLong(string[] input)
    {
        return SolveProblem(input);
    }

    private static long SolveProblem(string[] input, int steps)
    {
        var (polymer, pairInsertionRules) = FormatInputData(input);
        var polymerizer = new Polymerizer(pairInsertionRules);
        var allCounts = new Dictionary<char, int>();
        for (var o = 0; o < polymer.Length - 1; o++)
        {
            var currentPolymer = polymer.Substring(o, 2);
            for (var i = 0; i < steps; i++)
            {
                currentPolymer = polymerizer.Polymerize(currentPolymer);
            }

            var ordered = currentPolymer.SkipLast(1).GroupBy(x => x).ToArray();
            foreach (var thing in ordered)
            {
                allCounts[thing.Key] = (allCounts.ContainsKey(thing.Key) ? allCounts[thing.Key] : 0) + thing.Count();
            }
        }

        allCounts[polymer.Last()]++;

        return allCounts.Values.Max() - allCounts.Values.Min();
    }

    private static long SolveProblem(string[] input)
    {
        var (polymer, pairInsertionRules) = FormatInputData(input);
        var polymerizer = new Polymerizer(pairInsertionRules);
        var allCounts = new Dictionary<char, ulong>();

        for (var i = 0; i < 15; i++)
        {
            polymer = polymerizer.Polymerize(polymer);
        }

        var subPolymers = new Dictionary<string, IGrouping<char, char>[]>();
        for (var pairIndex = 0; pairIndex < polymer.Length - 1; pairIndex++)
        {
            var currentPolymer = polymer.Substring(pairIndex, 2);
            var dictionaryKey = currentPolymer;
            if (!subPolymers.TryGetValue(dictionaryKey, out _))
            {
                System.Console.WriteLine($"{pairIndex + 1}/{polymer.Length - 1}");
                for (var i = 0; i < 25; i++)
                {
                    currentPolymer = polymerizer.Polymerize(currentPolymer);
                }

                var ordered = currentPolymer.SkipLast(1).GroupBy(x => x).ToArray();
                subPolymers[dictionaryKey] = ordered;
            }

            foreach (var thing in subPolymers[dictionaryKey])
            {
                allCounts[thing.Key] = (allCounts.ContainsKey(thing.Key) ? allCounts[thing.Key] : 0) +
                                       (ulong) thing.Count();
            }
        }

        allCounts[polymer.Last()]++;

        return (long) (allCounts.Values.Max() - allCounts.Values.Min());
    }

    public static (string polymerTemplate, Dictionary<string, string> pairInsertionRules) FormatInputData(
        string[] input)
    {
        var polymerTemplate = input.First();
        var pairInsertionRules = input.Skip(2).Select(x => x.Split(" -> "))
            .ToDictionary(key => key.First(), value => value.Last());
        return (polymerTemplate, pairInsertionRules);
    }

    public class Polymerizer
    {
        private readonly Dictionary<string, string> _pairInsertionRules;

        public Polymerizer(Dictionary<string, string> pairInsertionRules)
        {
            _pairInsertionRules = pairInsertionRules;
        }

        public string Polymerize(string polymerTemplate)
        {
            IEnumerable<char> SecretPolymerization(string polymer)
            {
                for (var i = 0; i < polymer.Length - 1; i++)
                {
                    var key = polymer.Substring(i, 2);
                    var valueToAdd = _pairInsertionRules[key];
                    yield return polymer[i];
                    yield return Convert.ToChar(valueToAdd);
                }

                yield return polymer.Last();
            }

            return new string(SecretPolymerization(polymerTemplate).ToArray());
        }
    }
}