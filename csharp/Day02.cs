namespace advent_of_code_2021;

internal class Day02 : IDay
{
    public int DayNumber => 2;
    public int PartOneTestAnswer => 150;
    public int PartTwoTestAnswer => 900;

    public int ExecutePartOne(string[] input)
    {
        var instructions = input.Select(InputLineToInstruction).ToArray();
        var horizontalPosition = instructions.Where(x => x.Direction == Direction.Forward).Sum(x => x.Steps);
        var downSteps = instructions.Where(x => x.Direction == Direction.Down).Sum(x => x.Steps);
        var upSteps = instructions.Where(x => x.Direction == Direction.Up).Sum(x => x.Steps);
        return horizontalPosition * (downSteps - upSteps);
    }

    public int ExecutePartTwo(string[] input)
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

    private static Instruction InputLineToInstruction(string inputLine)
    {
        var parts = inputLine.Split(' ');
        return new Instruction((Direction)Enum.Parse(typeof(Direction), parts[0], true), int.Parse(parts[1]));
    }

    enum Direction
    {
        Forward,
        Down,
        Up,
    }

    readonly record struct Instruction(Direction Direction, int Steps);
}