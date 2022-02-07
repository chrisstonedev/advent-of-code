using AdventOfCode._2021.Console;

try
{
    var day = GetDay(13);

    var testInput = Utils.ReadAllLines($"Day{day.DayNumber:00}_test");
    var input = Utils.ReadAllLines($"Day{day.DayNumber:00}");

    Utils.AssertTestAnswer(day.ExecutePartOne(testInput), day.PartOneTestAnswer);
    Console.WriteLine("Part 1: " + day.ExecutePartOne(input));
    switch (day)
    {
        case ILongDay longDay:
            Utils.AssertTestAnswer(longDay.ExecutePartTwoLong(testInput), longDay.PartTwoTestAnswerLong);
            Console.WriteLine("Part 2: " + longDay.ExecutePartTwoLong(input));
            break;
        case IStringDay stringDay:
            Utils.AssertTestAnswer(stringDay.ExecutePartTwoString(testInput), stringDay.PartTwoTestAnswerString);
            Console.WriteLine("Part 2: " + stringDay.ExecutePartTwoString(input));
            break;
        default:
            Utils.AssertTestAnswer(day.ExecutePartTwo(testInput), day.PartTwoTestAnswer);
            Console.WriteLine("Part 2: " + day.ExecutePartTwo(input));
            break;
    }
}
catch (Exception ex)
{
    Console.WriteLine(ex.Message + Environment.NewLine + ex.StackTrace);
}

static IDay GetDay(int day)
{
    return day switch
    {
        1 => new Day01(),
        2 => new Day02(),
        3 => new Day03(),
        5 => new Day05(),
        6 => new Day06(),
        7 => new Day07(),
        8 => new Day08(),
        12 => new Day12(),
        13 => new Day13(),
        _ => throw new ArgumentOutOfRangeException(nameof(day)),
    };
}