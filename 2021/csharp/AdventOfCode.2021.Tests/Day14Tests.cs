using System.Collections.Generic;
using AdventOfCode._2021.Console;
using NUnit.Framework;

namespace AdventOfCode._2021.Tests;

[TestFixture]
public class Day14Tests
{
    private readonly Dictionary<string, string> _defaultInsertionRules = new()
    {
        {"CH", "B"},
        {"HH", "N"},
        {"CB", "H"},
        {"NH", "C"},
        {"HB", "C"},
        {"HC", "B"},
        {"HN", "C"},
        {"NN", "C"},
        {"BH", "H"},
        {"NC", "B"},
        {"NB", "B"},
        {"BN", "B"},
        {"BB", "N"},
        {"BC", "B"},
        {"CC", "N"},
        {"CN", "C"}
    };
    private const string InitialPolymerTemplate = "NNCB";

    [Test]
    public void TestInputFormatter()
    {
        var input = new[]
        {
            // ReSharper disable once StringLiteralTypo
            "NNCB",
            "",
            "CH -> B",
            "HH -> N",
            "CB -> H",
            "NH -> C",
            "HB -> C",
            "HC -> B",
            "HN -> C",
            "NN -> C",
            "BH -> H",
            "NC -> B",
            "NB -> B",
            "BN -> B",
            "BB -> N",
            "BC -> B",
            "CC -> N",
            "CN -> C"
        };
        var (polymerTemplate, pairInsertionRules) = Day14.FormatInputData(input);
        Assert.That(polymerTemplate, Is.EqualTo(InitialPolymerTemplate));
        Assert.That(pairInsertionRules, Is.EquivalentTo(_defaultInsertionRules));
    }

    [Test]
    public void TestOnePolymerization()
    {
        // ReSharper disable once IdentifierTypo
        var polymerizer = new Day14.Polymerizer(_defaultInsertionRules);
        var newPolymer = polymerizer.Polymerize(InitialPolymerTemplate);
        // ReSharper disable once StringLiteralTypo
        Assert.That(newPolymer, Is.EqualTo("NCNBCHB"));
    }

    [Test]
    // ReSharper disable once IdentifierTypo
    public void TestTwoPolymerizations()
    {
        // ReSharper disable once IdentifierTypo
        var polymerizer = new Day14.Polymerizer(_defaultInsertionRules);
        var newPolymer = polymerizer.Polymerize(InitialPolymerTemplate);
        newPolymer = polymerizer.Polymerize(newPolymer);
        // ReSharper disable once StringLiteralTypo
        Assert.That(newPolymer, Is.EqualTo("NBCCNBBBCBHCB"));
    }

    [TestCase(5, 97)]
    [TestCase(10, 3073)]
    // ReSharper disable IdentifierTypo
    public void TestMultiplePolymerizations(int polymerizations, int lengthOfPolymer)
    {
        // ReSharper disable once IdentifierTypo
        var polymerizer = new Day14.Polymerizer(_defaultInsertionRules);
        var polymer = InitialPolymerTemplate;
        for (var i = 0; i < polymerizations; i++)
        {
            polymer = polymerizer.Polymerize(polymer);
        }
        Assert.That(polymer.Length, Is.EqualTo(lengthOfPolymer));
    }
}