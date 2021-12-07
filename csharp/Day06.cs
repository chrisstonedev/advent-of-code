internal class Day06 : IDay
{
    public int DayNumber => 6;
    public int PartOneTestAnswer => 5934;
    public int PartTwoTestAnswer => 0; //26984457539;

    public int ExecutePartOne(string[] input)
    {
        return LanternfishSimulatorCount(input, 80);
    }

    public int ExecutePartTwo(string[] input)
    {
        return LanternfishSimulatorCount(input, 256);
    }

    private static int LanternfishSimulatorCount(string[] input, int numberOfDays)
    {
        var numbers = input.First().Split(',').Select(int.Parse).ToList();
        for (var day = 1; day <= numberOfDays; day++)
        {
            var currentCount = numbers.Count;
            for (var i = 0; i < currentCount; i++)
            {
                if (numbers[i] == 0)
                {
                    numbers[i] = 6;
                    numbers.Add(8);
                }
                else
                {
                    numbers[i]--;
                }
            }
        }
        return numbers.Count;
    }
}