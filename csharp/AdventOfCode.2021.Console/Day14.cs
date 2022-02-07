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
            IEnumerable<char> SecretPolymerization(string polymer)
            {
                for (var i = 0; i < polymer.Length - 1; i++)
                {
                    var lookupValue = polymer.Substring(i, 2);
                    var valueToAdd = _pairInsertionRules[lookupValue];
                    yield return polymer[i];
                    yield return Convert.ToChar(valueToAdd);
                }

                yield return polymer.Last();
            }
            
            return new string(SecretPolymerization(polymerTemplate).ToArray());
        }
    }
}