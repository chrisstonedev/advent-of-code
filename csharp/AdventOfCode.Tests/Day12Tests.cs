using AdventOfCode.Console;
using NUnit.Framework;

namespace AdventOfCode.Tests;

[TestFixture]
public class Day12Tests
{
    [Test]
    public void NoIntermediateCaves()
    {
        var input = new[]
        {
            "start-end"
        };
        var expected = new[]
        {
            "start,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(1));
        Assert.That(answer, Is.EqualTo(expected));
    }

    [Test]
    public void OneIntermediateCave()
    {
        var input = new[]
        {
            "start-A",
            "A-end"
        };
        var expected = new[]
        {
            "start,A,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(1));
        Assert.That(answer, Is.EqualTo(expected));
    }

    [Test]
    public void TwoIntermediateSmallCaves()
    {
        var input = new[]
        {
            "start-b",
            "start-c",
            "b-c",
            "b-end",
            "c-end"
        };
        var expected = new[]
        {
            "start,b,end",
            "start,c,end",
            "start,b,c,end",
            "start,c,b,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(4));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void IgnoreSmallDeadEndCave()
    {
        var input = new[]
        {
            "start-b",
            "start-c",
            "b-c",
            "c-d",
            "b-end",
            "c-end"
        };
        var expected = new[]
        {
            "start,b,end",
            "start,c,end",
            "start,b,c,end",
            "start,c,b,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(4));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void RevisitLargeCaves()
    {
        var input = new[]
        {
            "start-E",
            "E-f",
            "E-end"
        };
        var expected = new[]
        {
            "start,E,end",
            "start,E,f,E,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(2));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void VisitThreeBranchedPath()
    {
        var input = new[]
        {
            "start-g",
            "start-h",
            "start-i",
            "g-end",
            "h-end",
            "i-end"
        };
        var expected = new[]
        {
            "start,g,end",
            "start,h,end",
            "start,i,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(3));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void SimpleExample()
    {
        var input = new[]
        {
            "start-A",
            "start-b",
            "A-c",
            "A-b",
            "b-d",
            "A-end",
            "b-end"
        };
        var expected = new[]
        {
            "start,A,b,A,c,A,end",
            "start,A,b,A,end",
            "start,A,b,end",
            "start,A,c,A,b,A,end",
            "start,A,c,A,b,end",
            "start,A,c,A,end",
            "start,A,end",
            "start,b,A,c,A,end",
            "start,b,A,end",
            "start,b,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(10));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void SlightlyLargerExample()
    {
        var input = new[]
        {
            "dc-end",
            "HN-start",
            "start-kj",
            "dc-start",
            "dc-HN",
            "LN-dc",
            "HN-end",
            "kj-sa",
            "kj-HN",
            "kj-dc"
        };
        var expected = new[]
        {
            "start,HN,dc,HN,end",
            "start,HN,dc,HN,kj,HN,end",
            "start,HN,dc,end",
            "start,HN,dc,kj,HN,end",
            "start,HN,end",
            "start,HN,kj,HN,dc,HN,end",
            "start,HN,kj,HN,dc,end",
            "start,HN,kj,HN,end",
            "start,HN,kj,dc,HN,end",
            "start,HN,kj,dc,end",
            "start,dc,HN,end",
            "start,dc,HN,kj,HN,end",
            "start,dc,end",
            "start,dc,kj,HN,end",
            "start,kj,HN,dc,HN,end",
            "start,kj,HN,dc,end",
            "start,kj,HN,end",
            "start,kj,dc,HN,end",
            "start,kj,dc,end"
        };
        var solver = new Day12.Solver(false);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(19));
        Assert.That(answer, Is.EquivalentTo(expected));
    }


    [Test]
    public void SimpleExampleWhereSmallCavesCanBeRevisited()
    {
        var input = new[]
        {
            "start-A",
            "start-b",
            "A-c",
            "A-b",
            "b-d",
            "A-end",
            "b-end"
        };
        var expected = new[]
        {
            "start,A,b,A,b,A,c,A,end",
            "start,A,b,A,b,A,end",
            "start,A,b,A,b,end",
            "start,A,b,A,c,A,b,A,end",
            "start,A,b,A,c,A,b,end",
            "start,A,b,A,c,A,c,A,end",
            "start,A,b,A,c,A,end",
            "start,A,b,A,end",
            "start,A,b,d,b,A,c,A,end",
            "start,A,b,d,b,A,end",
            "start,A,b,d,b,end",
            "start,A,b,end",
            "start,A,c,A,b,A,b,A,end",
            "start,A,c,A,b,A,b,end",
            "start,A,c,A,b,A,c,A,end",
            "start,A,c,A,b,A,end",
            "start,A,c,A,b,d,b,A,end",
            "start,A,c,A,b,d,b,end",
            "start,A,c,A,b,end",
            "start,A,c,A,c,A,b,A,end",
            "start,A,c,A,c,A,b,end",
            "start,A,c,A,c,A,end",
            "start,A,c,A,end",
            "start,A,end",
            "start,b,A,b,A,c,A,end",
            "start,b,A,b,A,end",
            "start,b,A,b,end",
            "start,b,A,c,A,b,A,end",
            "start,b,A,c,A,b,end",
            "start,b,A,c,A,c,A,end",
            "start,b,A,c,A,end",
            "start,b,A,end",
            "start,b,d,b,A,c,A,end",
            "start,b,d,b,A,end",
            "start,b,d,b,end",
            "start,b,end"
        };
        var solver = new Day12.Solver(true);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(36));
        Assert.That(answer, Is.EquivalentTo(expected));
    }

    [Test]
    public void SlightlyLargerExampleWhereSmallCavesCanBeRevisited()
    {
        var input = new[]
        {
            "dc-end",
            "HN-start",
            "start-kj",
            "dc-start",
            "dc-HN",
            "LN-dc",
            "HN-end",
            "kj-sa",
            "kj-HN",
            "kj-dc"
        };
        var solver = new Day12.Solver(true);
        var answer = solver.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(103));
    }
}