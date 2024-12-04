import { Utils } from "./utils";
import { Day01 as Day2021_01 } from "./2021/day01";
import { Day02 as Day2021_02 } from "./2021/day02";
import { Day04 as Day2021_04 } from "./2021/day04";
import { Day09 as Day2021_09 } from "./2021/day09";
import { Day10 as Day2021_10 } from "./2021/day10";
import { Day11 as Day2021_11 } from "./2021/day11";
import { Day01 as Day2024_01 } from "./2024/day01";
import { Day02 as Day2024_02 } from "./2024/day02";
import { Day03 as Day2024_03 } from "./2024/day03";
import { Day04 as Day2024_04 } from "./2024/day04";
import { select } from "@inquirer/prompts";

const dayMap = new Map<number, Map<number, Day>>([
  [
    2021,
    new Map<number, Day>([
      [1, new Day2021_01()],
      [2, new Day2021_02()],
      [4, new Day2021_04()],
      [9, new Day2021_09()],
      [10, new Day2021_10()],
      [11, new Day2021_11()],
    ]),
  ],
  [
    2024,
    new Map<number, Day>([
      [1, new Day2024_01()],
      [2, new Day2024_02()],
      [3, new Day2024_03()],
      [4, new Day2024_04()],
    ]),
  ],
]);

const years = Array.from(dayMap.keys());
const minYear = Math.min(...years);
const maxYear = Math.max(...years);
const yearChoices: {
  name: string;
  value: number;
  description: string | undefined;
  disabled: string | undefined;
}[] = [];
for (let i = minYear; i <= maxYear; i++) {
  const daysSolved = Array.from(dayMap.get(i)?.keys() ?? []).length;
  yearChoices.push({
    name: `${i}`,
    value: i,
    description:
      daysSolved > 0
        ? `${daysSolved} ${daysSolved != 1 ? "days" : "day"} solved (${daysSolved * 4}%)`
        : undefined,
    disabled: daysSolved > 0 ? undefined : "(none)",
  });
}

function getDayChoices(year: number) {
  const days = Array.from(dayMap.get(year)?.keys() ?? []);
  const maxDay = Math.max(...days);
  const dayChoices: {
    name: string;
    value: number;
    disabled: string | undefined;
  }[] = [];
  for (let i = 1; i <= maxDay; i++) {
    const solved = days.includes(i);
    dayChoices.push({
      name: `Day ${i}`,
      value: i,
      disabled: solved ? undefined : "(not yet solved)",
    });
  }
  return { dayChoices, maxDay };
}

async function runProgram() {
  const year = await select({
    message: "Select a year:",
    choices: yearChoices,
    default: maxYear,
  });
  const { dayChoices, maxDay } = getDayChoices(year);
  const dayNumber = await select({
    message: "Select a day:",
    choices: dayChoices,
    default: maxDay,
  });

  const day = dayMap.get(year)?.get(dayNumber);
  if (day === undefined) {
    console.error("Could not find day with that day number.");
    return;
  }

  const yearAndDayFileFormat = `${year}_${dayNumber.toString().padStart(2, "0")}`;
  const testInput = Utils.readInput(`${yearAndDayFileFormat}_test`);
  const input = Utils.readInput(`${yearAndDayFileFormat}_input`);
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
  runProgram().then();
} catch (err) {
  console.error(err);
}

export interface Day {
  partOneTestAnswer: number;
  partTwoTestAnswer: number;
  executePartOne: (input: string[]) => number;
  executePartTwo: (input: string[]) => number;
}
