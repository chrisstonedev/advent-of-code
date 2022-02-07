using AdventOfCode._2021.Console;
using NUnit.Framework;

namespace AdventOfCode._2021.Tests;

[TestFixture]
public class Day13Tests
{
    [Test]
    public void FormatInitialInputFromFile()
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
    
    [Test]
    public void FoldMutatesPointData()
    {
        var initialPoints = new[]
        {
            new Day13.Point(0, 14),
            new Day13.Point(1, 8),
            new Day13.Point(3, 0)
        };
        var expected = new[]
        {
            new Day13.Point(0, 0),
            new Day13.Point(1, 6),
            new Day13.Point(3, 0)
        };
        var fold = new Day13.Fold("y", 7);
        var actual = Day13.FoldPaper(initialPoints, fold);
        Assert.That(actual, Is.EqualTo(expected));
    }
    
    [Test]
    public void FoldConsolidatesDuplicatePoints()
    {
        var initialPoints = new[]
        {
            new Day13.Point(2, 14),
            new Day13.Point(2, 0),
            new Day13.Point(3, 3)
        };
        var expected = new[]
        {
            new Day13.Point(2, 0),
            new Day13.Point(3, 3)
        };
        var fold = new Day13.Fold("y", 7);
        var actual = Day13.FoldPaper(initialPoints, fold);
        Assert.That(actual, Is.EqualTo(expected));
    }
}