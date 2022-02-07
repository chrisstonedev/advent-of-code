using NUnit.Framework;

namespace advent_of_code_2021;

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
        var answer = Day12.GetAllDistinctPaths(input);
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
        var answer = Day12.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(1));
        Assert.That(answer, Is.EqualTo(expected));
    }

    [Test]
    [Ignore("Not yet ready to implement")]
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
        var answer = Day12.GetAllDistinctPaths(input);
        // Assert.That(answer.Length, Is.EqualTo(10));
        Assert.That(answer, Is.EqualTo(expected));
    }

    [Test]
    [Ignore("Not yet ready to implement")]
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
        var answer = Day12.GetAllDistinctPaths(input);
        Assert.That(answer.Length, Is.EqualTo(19));
        Assert.That(answer, Is.EqualTo(expected));
    }
}