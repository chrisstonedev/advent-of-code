namespace AdventOfCode._2021.Console;

internal class Day01 : IDay
{
    public int DayNumber => 1;
    public int PartOneTestAnswer => 7;
    public int PartTwoTestAnswer => 5;

    public int ExecutePartOne(string[] input)
    {
        var inputAsIntegers = input.Select(int.Parse).ToArray();
        return WindowList(inputAsIntegers, 2).Count(x => x.First() < x.Last());
    }

    public int ExecutePartTwo(string[] input)
    {
        var inputAsIntegers = input.Select(int.Parse).ToArray();
        return WindowOfWindowList(WindowList(inputAsIntegers, 3)).Count(x => x.First().Sum() < x.Last().Sum());
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