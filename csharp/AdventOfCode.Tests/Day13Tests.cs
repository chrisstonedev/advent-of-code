using System;
using AdventOfCode.Console;
using NUnit.Framework;

namespace AdventOfCode.Tests;

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

    [Test]
    public void DrawPointsAsTextWithoutFolding()
    {
        var points = new[]
        {
            new Day13.Point(6, 10),
            new Day13.Point(0, 14),
            new Day13.Point(9, 10),
            new Day13.Point(0, 3),
            new Day13.Point(10, 4),
            new Day13.Point(4, 11),
            new Day13.Point(6, 0),
            new Day13.Point(6, 12),
            new Day13.Point(4, 1),
            new Day13.Point(0, 13),
            new Day13.Point(10, 12),
            new Day13.Point(3, 4),
            new Day13.Point(3, 0),
            new Day13.Point(8, 4),
            new Day13.Point(1, 10),
            new Day13.Point(2, 14),
            new Day13.Point(8, 10),
            new Day13.Point(9, 0)
        };
        const string expected = @"...#..#..#.
....#......
...........
#..........
...#....#.#
...........
...........
...........
...........
...........
.#....#.##.
....#......
......#...#
#..........
#.#........";
        var actual = Day13.GetRawText(points);
        Assert.That(string.Join(Environment.NewLine, actual), Is.EqualTo(expected));
    }

    [Test]
    public void DrawPointsAsTextWithOneFold()
    {
        var points = new[]
        {
            new Day13.Point(6, 10),
            new Day13.Point(0, 14),
            new Day13.Point(9, 10),
            new Day13.Point(0, 3),
            new Day13.Point(10, 4),
            new Day13.Point(4, 11),
            new Day13.Point(6, 0),
            new Day13.Point(6, 12),
            new Day13.Point(4, 1),
            new Day13.Point(0, 13),
            new Day13.Point(10, 12),
            new Day13.Point(3, 4),
            new Day13.Point(3, 0),
            new Day13.Point(8, 4),
            new Day13.Point(1, 10),
            new Day13.Point(2, 14),
            new Day13.Point(8, 10),
            new Day13.Point(9, 0)
        };
        const string expected = @"#.##..#..#.
#...#......
......#...#
#...#......
.#.#..#.###";
        points = Day13.FoldPaper(points, new Day13.Fold("y", 7));
        var actual = Day13.GetRawText(points);
        Assert.That(string.Join(Environment.NewLine, actual), Is.EqualTo(expected));
    }

    [Test]
    public void DrawPointsAsTextWithTwoFolds()
    {
        var points = new[]
        {
            new Day13.Point(6, 10),
            new Day13.Point(0, 14),
            new Day13.Point(9, 10),
            new Day13.Point(0, 3),
            new Day13.Point(10, 4),
            new Day13.Point(4, 11),
            new Day13.Point(6, 0),
            new Day13.Point(6, 12),
            new Day13.Point(4, 1),
            new Day13.Point(0, 13),
            new Day13.Point(10, 12),
            new Day13.Point(3, 4),
            new Day13.Point(3, 0),
            new Day13.Point(8, 4),
            new Day13.Point(1, 10),
            new Day13.Point(2, 14),
            new Day13.Point(8, 10),
            new Day13.Point(9, 0)
        };
        const string expected = @"#####
#...#
#...#
#...#
#####";
        points = Day13.FoldPaper(points, new Day13.Fold("y", 7));
        points = Day13.FoldPaper(points, new Day13.Fold("x", 5));
        var actual = Day13.GetRawText(points);
        Assert.That(string.Join(Environment.NewLine, actual), Is.EqualTo(expected));
    }

    [Test]
    public void CanInterpretTestBoxCharacter()
    {
        var input = new[]
        {
            "#####",
            "#...#",
            "#...#",
            "#...#",
            "#####"
        };
        var actual = Day13.InterpretRawText(input);
        Assert.That(actual, Is.EqualTo("."));
    }

    [Test]
    public void CanInterpretFullLetters()
    {
        var input = new[]
        {
            ".##....##.#..#..##..####.#..#.#..#.#..#",
            "#..#....#.#..#.#..#....#.#..#.#.#..#..#",
            "#.......#.####.#..#...#..####.##...#..#",
            "#.......#.#..#.####..#...#..#.#.#..#..#",
            "#..#.#..#.#..#.#..#.#....#..#.#.#..#..#",
            ".##...##..#..#.#..#.####.#..#.#..#..##."
        };
        var actual = Day13.InterpretRawText(input);
        // ReSharper disable once StringLiteralTypo
        Assert.That(actual, Is.EqualTo("CJHAZHKU"));
    }
}