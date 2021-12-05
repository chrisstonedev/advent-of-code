internal static class Day02
{
    internal static void Execute()
    {
        var testInput = Utils.ReadAllLines("Day02_test");
        var input = Utils.ReadAllLines("Day02");

        Utils.AssertTestAnswer(Part1(testInput), 150);
        Console.WriteLine("Part 1: " + Part1(input));

        Utils.AssertTestAnswer(Part2(testInput), 900);
        Console.WriteLine("Part 2: " + Part2(input));
    }

    static int Part1(string[] input)
    {
        var instructions = input.Select(InputLineToInstruction).ToArray();
        var horizontalPosition = instructions.Where(x => x.Direction == Direction.Forward).Sum(x => x.Steps);
        var downSteps = instructions.Where(x => x.Direction == Direction.Down).Sum(x => x.Steps);
        var upSteps = instructions.Where(x => x.Direction == Direction.Up).Sum(x => x.Steps);
        return horizontalPosition * (downSteps - upSteps);
    }

    private static Instruction InputLineToInstruction(string inputLine)
    {
        var parts = inputLine.Split(' ');
        return new Instruction((Direction)Enum.Parse(typeof(Direction), parts[0], true), int.Parse(parts[1]));
    }

    static int Part2(string[] input)
    {
        var instructions = input.Select(InputLineToInstruction).ToArray();
        var horizontalPosition = instructions.Where(x => x.Direction == Direction.Forward).Sum(x => x.Steps);
        int depth = 0;
        int aim = 0;
        foreach (var instruction in instructions)
        {
            if (instruction.Direction == Direction.Forward)
            {
                depth += instruction.Steps * aim;
            }
            else
            {
                aim += instruction.Steps * (instruction.Direction == Direction.Down ? 1 : -1);
            }
        }
        return horizontalPosition * depth;
    }

    enum Direction
    {
        Forward,
        Down,
        Up,
    }

    readonly record struct Instruction(Direction Direction, int Steps);
}