using AdventOfCode._2021.Console;
using NUnit.Framework;

namespace AdventOfCode._2021.Tests;

[TestFixture]
public class Day13Tests
{
    [Test]
    public void NoIntermediateCaves()
    {
        var input = new[]
        {
            "6,10",
            "0,14",
            "",
            "fold along y=7",
            "fold along x=5"
        };
        var expectedPoints = new[]
        {
            new Day13.Point(6, 10),
            new Day13.Point(0, 14)
        };
        var expectedFolds = new[]
        {
            new Day13.Fold("y", 7),
            new Day13.Fold("x", 5)
        };
        var actual = Day13.FormatInputData(input);
        Assert.That(actual.Points, Is.EqualTo(expectedPoints));
        Assert.That(actual.Folds, Is.EquivalentTo(expectedFolds));
    }
}