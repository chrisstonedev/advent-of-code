internal class Day03 : IDay
{
    public int DayNumber => 3;
    public int PartOneTestAnswer => 198;
    public int PartTwoTestAnswer => 230;

    public int ExecutePartOne(string[] input)
    {
        var gammaRateString = GetGammaRateString(input);
        var epsilonRateString = GetEpsilonRateString(gammaRateString);

        var gammaRate = Convert.ToInt32(gammaRateString, 2);
        var epsilonRate = Convert.ToInt32(epsilonRateString, 2);

        var powerConsumption = gammaRate * epsilonRate;
        return powerConsumption;
    }

    public int ExecutePartTwo(string[] input)
    {
        var oxygenGeneratorRatingString = GetOxygenGeneratorRatingString(input);
        var carbonDioxideScrubberRatingString = GetCarbonDioxideScrubberRatingString(input);

        var oxygenGeneratorRating = Convert.ToInt32(oxygenGeneratorRatingString, 2);
        var carbonDioxideScrubberRating = Convert.ToInt32(carbonDioxideScrubberRatingString, 2);

        var lifeSupportRating = oxygenGeneratorRating * carbonDioxideScrubberRating;
        return lifeSupportRating;
    }

    private static string GetGammaRateString(string[] input)
    {
        var recordLength = input.First().Length;
        var gammaRateChars = new char[recordLength];
        for (var i = 0; i < recordLength; i++)
        {
            gammaRateChars[i] = input.Select(x => x[i]).GroupBy(x => x).OrderByDescending(x => x.Count()).First().Key;
        }
        return new string(gammaRateChars);
    }

    private static string GetEpsilonRateString(string gammaRateString)
    {
        var recordLength = gammaRateString.Length;
        var epsilonRateChars = new char[recordLength];
        for (var i = 0; i < recordLength; i++)
        {
            epsilonRateChars[i] = gammaRateString[i] == '1' ? '0' : '1';
        }
        return new string(epsilonRateChars);
    }

    private static string GetOxygenGeneratorRatingString(string[] input)
    {
        var recordLength = input.Length;
        var remainingMatchingLines = input.ToArray();
        for (var i = 0; i < recordLength; i++)
        {
            var mostPopularCharacter = remainingMatchingLines.Select(x => x[i]).GroupBy(x => x).OrderByDescending(x => x.Count()).ThenByDescending(x => x.Key).First().Key;
            remainingMatchingLines = remainingMatchingLines.Where(x => x[i] == mostPopularCharacter).ToArray();
            if (remainingMatchingLines.Length == 1)
                break;
        }
        return remainingMatchingLines.First();
    }

    private static string GetCarbonDioxideScrubberRatingString(string[] input)
    {
        var recordLength = input.Length;
        var remainingMatchingLines = input.ToArray();
        for (var i = 0; i < recordLength; i++)
        {
            var mostPopularCharacter = remainingMatchingLines.Select(x => x[i]).GroupBy(x => x).OrderByDescending(x => x.Count()).ThenByDescending(x => x.Key).First().Key;
            var leastPopularCharacter = mostPopularCharacter == '1' ? '0' : '1';
            remainingMatchingLines = remainingMatchingLines.Where(x => x[i] == leastPopularCharacter).ToArray();
            if (remainingMatchingLines.Length == 1)
                break;
        }
        return remainingMatchingLines.First();
    }
}