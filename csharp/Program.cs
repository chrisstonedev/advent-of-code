try
{
    IDay day = GetDay(7);

    var testInput = Utils.ReadAllLines($"Day{day.DayNumber:00}_test");
    var input = Utils.ReadAllLines($"Day{day.DayNumber:00}");

    Utils.AssertTestAnswer(day.ExecutePartOne(testInput), day.PartOneTestAnswer);
    Console.WriteLine("Part 1: " + day.ExecutePartOne(input));

    Utils.AssertTestAnswer(day.ExecutePartTwo(testInput), day.PartTwoTestAnswer);
    Console.WriteLine("Part 2: " + day.ExecutePartTwo(input));
}
catch (Exception ex)
{
    Console.WriteLine(ex.Message);
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
        _ => throw new ArgumentOutOfRangeException(nameof(day)),
    };
}