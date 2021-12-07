try
{
    IDay day;
    //day = new Day01();
    //day = new Day02();
    //day = new Day03();
    day = new Day05();

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