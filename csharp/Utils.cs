internal static class Utils
{
    internal static string[] ReadAllLines(string fileName)
    {
        return File.ReadAllLines($"{fileName}.txt");
    }

    internal static int[] ReadAllLinesAsInts(string fileName)
    {
        return ReadAllLines(fileName).Select(int.Parse).ToArray();
    }

    internal static void AssertTestAnswer(int actual, int expected)
    {
        if (actual != expected)
            throw new Exception($"Assertion failed; expected {expected} but received {actual}");
    }
}