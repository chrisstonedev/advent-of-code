internal class Day07 : IDay
{
    public int DayNumber => 7;
    public int PartOneTestAnswer => 37;
    public int PartTwoTestAnswer => 168;

    public int ExecutePartOne(string[] input)
    {
        return CalculateFuelSpend(input, true);
    }

    public int ExecutePartTwo(string[] input)
    {
        return CalculateFuelSpend(input, false);
    }

    private static int CalculateFuelSpend(string[] input, bool isConstantRate)
    {
        var numbers = input.First().Split(',').Select(int.Parse).ToList();
        var bestNumberSum = int.MaxValue;
        for (var number = numbers.Min(); number < numbers.Max(); number++)
        {
            var numberSum = numbers.Sum(x =>
            {
                var horizontalDistance = Math.Abs(x - number);
                if (isConstantRate)
                {
                    return horizontalDistance;
                }
                return Enumerable.Range(1, horizontalDistance).Sum();
            });
            if (numberSum < bestNumberSum)
            {
                bestNumberSum = numberSum;
            }
        }
        return bestNumberSum;
    }
}