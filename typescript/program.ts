import { Utils } from "./utils";
import { Day01 } from "./2021/day01";
import { Day02 } from "./2021/day02";
import { Day04 } from "./2021/day04";
import { Day09 } from "./2021/day09";
import { Day10 } from "./2021/day10";
import { Day11 } from "./2021/day11";
import { Day202401 } from "./2024/day202401";

let days: Day[] = [
  new Day01(),
  new Day02(),
  new Day04(),
  new Day09(),
  new Day10(),
  new Day11(),
  new Day202401(),
];

function goDoThis() {
  if (process.argv.length < 3) {
    console.error(
      "Please pass the day number as an argument (e.g. `ts-node program.ts 1`).",
    );
    return;
  }

  let day = days.find((day) => day.dayNumber === Number(process.argv[2]));
  if (day === undefined) {
    console.error("Could not find day with that day number.");
    return;
  }

  let testInput = Utils.readInput(`2024_01_test`);
  let input = Utils.readInput(`2024_01_input`);
  if (
    !Utils.assertTestAnswer(
      day.executePartOne(testInput),
      day.partOneTestAnswer,
    )
  ) {
    return;
  }
  console.log("Part 1: " + day.executePartOne(input));
  if (
    !Utils.assertTestAnswer(
      day.executePartTwo(testInput),
      day.partTwoTestAnswer,
    )
  ) {
    return;
  }
  console.log("Part 2: " + day.executePartTwo(input));
}

try {
  goDoThis();
} catch (err) {
  console.error(err);
}

export interface Day {
  dayNumber: number;
  partOneTestAnswer: number;
  partTwoTestAnswer: number;
  executePartOne: (input: string[]) => number;
  executePartTwo: (input: string[]) => number;
}
