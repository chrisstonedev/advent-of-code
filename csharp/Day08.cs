internal class Day08 : IDay
{
    public int DayNumber => 8;
    public int PartOneTestAnswer => 26;
    public int PartTwoTestAnswer => 61229;

    public int ExecutePartOne(string[] input)
    {
        return input.Select(x => x.Split(" | ").Last().Split(' ')).SelectMany(x => x).Count(x => x.Length is 2 or 3 or 4 or 7);
    }

    public int ExecutePartTwo(string[] input)
    {
        int sum = 0;
        foreach (var line in input)
        {
            var split = line.Split(" | ");
            var uniqueSignalPatterns = split.First().Split(' ').Select(x => new string(x.OrderBy(y => y).ToArray()));
            var outputValue = split.Last().Split(' ').Select(x => new string(x.OrderBy(y => y).ToArray()));


            var one = uniqueSignalPatterns.First(x => x.Length == 2);
            var three = uniqueSignalPatterns.First(x => x.Length == 5 && x.Contains(one[0]) && x.Contains(one[1]));
            var four = uniqueSignalPatterns.First(x => x.Length == 4);
            var six = uniqueSignalPatterns.First(x => x.Length == 6 && (!x.Contains(one[0]) || !x.Contains(one[1])));
            var five = uniqueSignalPatterns.First(x => x.Length == 5 && six.Contains(x[0]) && six.Contains(x[1]) && six.Contains(x[2]) && six.Contains(x[3]) && six.Contains(x[4]));
            var two = uniqueSignalPatterns.First(x => x.Length == 5 && x != three && x != five);
            var seven = uniqueSignalPatterns.First(x => x.Length == 3);
            var eight = uniqueSignalPatterns.First(x => x.Length == 7);
            var nine = uniqueSignalPatterns.First(x => x.Length == 6 && x.Contains(four[0]) && x.Contains(four[1]) && x.Contains(four[2]) && x.Contains(four[3]));
            var zero = uniqueSignalPatterns.First(x => x.Length == 6 && x != six && x != nine);

            var dictionary = new Dictionary<string, char>
            {
                [zero] = '0',
                [one] = '1',
                [two] = '2',
                [three] = '3',
                [four] = '4',
                [five] = '5',
                [six] = '6',
                [seven] = '7',
                [eight] = '8',
                [nine] = '9'
            };

            sum += int.Parse(new string(outputValue.Select(x => dictionary[x]).ToArray()));
        }

        return sum;
    }
}