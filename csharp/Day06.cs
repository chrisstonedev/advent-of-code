internal class Day06 : ILongDay
{
    public int DayNumber => 6;
    public int PartOneTestAnswer => 5934;
    [Obsolete($"Use {nameof(PartTwoTestAnswerLong)} instead.")] public int PartTwoTestAnswer => throw new NotImplementedException();
    public long PartTwoTestAnswerLong => 26984457539;

    public int ExecutePartOne(string[] input) => (int)LanternfishSimulatorCount(input, 80);

    [Obsolete($"Use {nameof(ExecutePartTwoLong)} instead.")] public int ExecutePartTwo(string[] _) => throw new NotImplementedException();

    public long ExecutePartTwoLong(string[] input) => LanternfishSimulatorCount(input, 256);

    private static long LanternfishSimulatorCount(string[] input, int numberOfDays)
    {
        var getTotalCountFromLanternfishSpawnedOnThisDay = new Dictionary<int, long>();
        for (var initialDay = numberOfDays; initialDay >= -8; initialDay--)
        {
            var totalCountForThisInitialDay = 1L;
            for (var day = initialDay + 9; day <= numberOfDays; day += 7)
            {
                totalCountForThisInitialDay += getTotalCountFromLanternfishSpawnedOnThisDay[day];
            }
            getTotalCountFromLanternfishSpawnedOnThisDay[initialDay] = totalCountForThisInitialDay;
        }
        return input.First().Split(',').Select(x => getTotalCountFromLanternfishSpawnedOnThisDay[int.Parse(x) - 8]).Sum();
    }
}