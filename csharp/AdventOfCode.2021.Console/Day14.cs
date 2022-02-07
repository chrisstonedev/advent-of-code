namespace AdventOfCode._2021.Console;

public class Day14 : IDay
{
    public int DayNumber => 14;
    public int PartOneTestAnswer => 1588;
    public int PartTwoTestAnswer => -1;

    public int ExecutePartOne(string[] input)
    {
        var (polymer, pairInsertionRules) = FormatInputData(input);
        // ReSharper disable once IdentifierTypo
        var polymerizer = new Polymerizer(pairInsertionRules);
        for (var i = 0; i < 10; i++)
        {
            polymer = polymerizer.Polymerize(polymer);
        }

        var ordered = polymer.GroupBy(x => x).Select(x => x.Count()).ToArray();
        return ordered.Max() - ordered.Min();
    }

    public static (string polymerTemplate, Dictionary<string, string> pairInsertionRules) FormatInputData(
        string[] input)
    {
        var polymerTemplate = input.First();
        var pairInsertionRules = input.Skip(2).Select(x => x.Split(" -> "))
            .ToDictionary(key => key.First(), value => value.Last());
        return (polymerTemplate, pairInsertionRules);
    }

    public int ExecutePartTwo(string[] input)
    {
        return 0;
    }

    // ReSharper disable once IdentifierTypo
    public class Polymerizer
    {
        private readonly Dictionary<string, string> _pairInsertionRules;

        // ReSharper disable once IdentifierTypo
        public Polymerizer(Dictionary<string, string> pairInsertionRules)
        {
            _pairInsertionRules = pairInsertionRules;
        }

        public string Polymerize(string polymerTemplate)
        {
            var iterations = polymerTemplate.Length - 1;
            for (var i = 0; i < iterations; i++)
            {
                var insertionIndex = i * 2 + 1;
                var lookupValue = polymerTemplate.Substring(i * 2, 2);
                var valueToAdd = _pairInsertionRules[lookupValue];
                polymerTemplate = polymerTemplate.Insert(insertionIndex, valueToAdd);
            }

            return polymerTemplate;
        }
    }
}