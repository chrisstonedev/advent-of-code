internal static class Day01
{
    internal static void Execute()
    {
        var testInput = Utils.ReadAllLinesAsInts("Day01_test");
        var input = Utils.ReadAllLinesAsInts("Day01");

        Utils.AssertTestAnswer(Part1(testInput), 7);
        Console.WriteLine("Part 1: " + Part1(input));

        Utils.AssertTestAnswer(Part2(testInput), 5);
        Console.WriteLine("Part 2: " + Part2(input));
    }

    static int Part1(IReadOnlyList<int> input)
    {
        return WindowList(input, 2).Count(x => x.First() < x.Last());
    }

    static int Part2(IReadOnlyList<int> input)
    {
        return WindowOfWindowList(WindowList(input, 3)).Count(x => x.First().Sum() < x.Last().Sum());
    }

    static IEnumerable<int[]> WindowList(IReadOnlyList<int> list, int windowSize)
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

    static IEnumerable<int[][]> WindowOfWindowList(IEnumerable<int[]> list)
    {
        var newList = new List<int[][]>();
        var intsEnumerable = list as int[][] ?? list.ToArray();
        for (var i = 1; i < intsEnumerable.Length; i++)
        {
            newList.Add(new[] { intsEnumerable[i - 1], intsEnumerable[i] });
        }

        return newList;
    }
}