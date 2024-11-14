namespace AdventOfCode.Console;

internal class Day06 : ILongDay
{
    public int DayNumber => 6;
    public int PartOneTestAnswer => 5934;
    public long PartTwoTestAnswerLong => 26984457539;

    public int ExecutePartOne(string[] input) => (int)LanternfishSimulatorCount(input, 80);

    public long ExecutePartTwoLong(string[] input) => LanternfishSimulatorCount(input, 256);

    private static long LanternfishSimulatorCount(string[] input, int numberOfDays)
    {
        var getTotalCountFromLanternfishSpawnedOnThisDay = new Dictionary<int, long>();

        var firstDaysForInitialLanternfish = input.First().Split(',').Select(x => int.Parse(x) - 8);
        int earliestDayALanternfishSpawned = firstDaysForInitialLanternfish.OrderBy(x => x).First();

        for (var initialDay = numberOfDays; initialDay >= earliestDayALanternfishSpawned; initialDay--)
        {
            var totalCountForThisInitialDay = 1L;
            for (var day = initialDay + 9; day <= numberOfDays; day += 7)
            {
                totalCountForThisInitialDay += getTotalCountFromLanternfishSpawnedOnThisDay[day];
            }
            getTotalCountFromLanternfishSpawnedOnThisDay[initialDay] = totalCountForThisInitialDay;
        }
        return firstDaysForInitialLanternfish.Sum(x => getTotalCountFromLanternfishSpawnedOnThisDay[x]);
    }
}