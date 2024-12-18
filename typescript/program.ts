import { Utils } from "./utils";
import {
  Day01 as Day2021_01,
  Day02 as Day2021_02,
  Day04 as Day2021_04,
  Day09 as Day2021_09,
  Day10 as Day2021_10,
  Day11 as Day2021_11,
} from "./2021";
import {
  Day01 as Day2024_01,
  Day02 as Day2024_02,
  Day03 as Day2024_03,
  Day04 as Day2024_04,
  Day05 as Day2024_05,
  Day06 as Day2024_06,
  Day07 as Day2024_07,
  Day08 as Day2024_08,
  Day09 as Day2024_09,
  Day10 as Day2024_10,
  Day11 as Day2024_11,
} from "./2024";
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
      [5, new Day2024_05()],
      [6, new Day2024_06()],
      [7, new Day2024_07()],
      [8, new Day2024_08()],
      [9, new Day2024_09()],
      [10, new Day2024_10()],
      [11, new Day2024_11()],
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
  const daysInYear = Array.from(dayMap.get(i)?.values() ?? []);
  const inProgress = daysInYear.filter((x) => x.inProgress).length;
  const daysSolved = daysInYear.length - inProgress;
  let description =
    daysSolved > 0
      ? `${daysSolved} ${daysSolved != 1 ? "days" : "day"} solved (${daysSolved * 4}%)`
      : undefined;
  if (inProgress > 0) {
    description += `, ${inProgress} ${inProgress != 1 ? "days" : "day"} in progress`;
  }
  yearChoices.push({
    name: `${i}`,
    value: i,
    description: description,
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
  const startTest1 = new Date().getTime();
  if (
    !Utils.assertTestAnswer(
      day.executePartOne(testInput),
      day.partOneTestAnswer,
    )
  ) {
    return;
  }
  const startInput1 = new Date().getTime();
  console.log(`Test 1 passed (${startInput1 - startTest1}ms)`);
  const input1 = day.executePartOne(input);
  const startTest2 = new Date().getTime();
  console.log(`Part 1: ${input1} (${startTest2 - startInput1}ms)`);
  if (
    !Utils.assertTestAnswer(
      day.executePartTwo(testInput),
      day.partTwoTestAnswer,
    )
  ) {
    return;
  }
  const startInput2 = new Date().getTime();
  console.log(`Test 2 passed (${startInput2 - startTest2}ms)`);
  const input2 = day.executePartTwo(input);
  console.log(`Part 2: ${input2} (${new Date().getTime() - startInput2}ms)`);
}

try {
  runProgram().then();
} catch (err) {
  console.error(err);
}

export interface Day {
  partOneTestAnswer: number;
  partTwoTestAnswer: number;
  inProgress?: boolean;
  executePartOne: (input: string[]) => number;
  executePartTwo: (input: string[]) => number;
}
