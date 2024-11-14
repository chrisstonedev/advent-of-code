namespace AdventOfCode.Console;

internal static class Utils
{
    internal static string[] ReadAllLines(string fileName)
    {
        var file = Path.Join(AppDomain.CurrentDomain.BaseDirectory, $"../../../../../data/{fileName}.txt");
        return File.ReadAllLines(file);
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

    internal static void AssertTestAnswer(long actual, long expected)
    {
        if (actual != expected)
            throw new Exception($"Assertion failed; expected {expected} but received {actual}");
    }

    internal static void AssertTestAnswer(string actual, string expected)
    {
        if (actual != expected)
            throw new Exception($"Assertion failed; expected {expected} but received {actual}");
    }
}