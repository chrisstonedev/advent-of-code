int Part1(IReadOnlyList<int> input)
{
    return WindowList(input, 2).Count(x => x.First() < x.Last());
}

int Part2(IReadOnlyList<int> input)
{
    return WindowedTwo2(WindowList(input, 3)).Count(x => x.First().Sum() < x.Last().Sum());
}

int[] ReadAllLinesAsInts(string fileName)
{
    return File.ReadAllLines($"{fileName}.txt").Select(int.Parse).ToArray();
}

IEnumerable<int[]> WindowList(IReadOnlyList<int> list, int windowSize)
{
    var newList = new List<int[]>();
    for (var i = windowSize - 1; i < list.Count; i++)
    {
        var listOfValues = new List<int>();
        for (var j = windowSize - 1; j >= 0; j--)
        {
            listOfValues.Add(list[i - j]);
        }

        newList.Add(listOfValues.ToArray());
    }

    return newList;
}

IEnumerable<int[][]> WindowedTwo2(IEnumerable<int[]> list)
{
    var newList = new List<int[][]>();
    var intsEnumerable = list as int[][] ?? list.ToArray();
    for (var i = 1; i < intsEnumerable.Length; i++)
    {
        newList.Add(new[] {intsEnumerable[i - 1], intsEnumerable[i]});
    }

    return newList;
}

var sampleInput = ReadAllLinesAsInts("Day01_sample");
var input = ReadAllLinesAsInts("Day01");

Console.WriteLine(Part1(sampleInput));
Console.WriteLine(Part1(input));

Console.WriteLine(Part2(sampleInput));
Console.WriteLine(Part2(input));