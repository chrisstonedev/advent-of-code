import { Utils } from "./utils";
import { Day01 } from "./2021/day01";
import { Day02 } from "./2021/day02";
import { Day04 } from "./2021/day04";
import { Day09 } from "./2021/day09";
import { Day10 } from "./2021/day10";
import { Day11 } from "./2021/day11";
import { Day202401 } from "./2024/day202401";
import { select } from "@inquirer/prompts";

const dayMap = new Map<number, Map<number, Day>>([
  [
    2021,
    new Map<number, Day>([
      [1, new Day01()],
      [2, new Day02()],
      [4, new Day04()],
      [9, new Day09()],
      [10, new Day10()],
      [11, new Day11()],
    ]),
  ],
  [2024, new Map<number, Day>([[1, new Day202401()]])],
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
        ? `${daysSolved} days solved (${daysSolved * 4}%)`
        : undefined,
    disabled: daysSolved > 0 ? undefined : "(none)",
  });
}

function getDayChoices(year: number) {
  const days = Array.from(dayMap.get(year)?.keys() ?? []);
  const minDay = Math.min(...days);
  const maxDay = Math.max(...days);
  const dayChoices: {
    name: string;
    value: number;
    disabled: string | undefined;
  }[] = [];
  for (let i = minDay; i <= maxDay; i++) {
    const solved = days.includes(i);
    dayChoices.push({
      name: `Day ${i}`,
      value: i,
      disabled: solved ? undefined : "(not yet solved)",
    });
  }
  return { dayChoices, maxDay };
}

async function goDoThis() {
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

  const testInput = Utils.readInput(
    `${year}_${dayNumber.toString().padStart(2, "0")}_test`,
  );
  const input = Utils.readInput(
    `${year}_${dayNumber.toString().padStart(2, "0")}_input`,
  );
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
  goDoThis().then();
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
