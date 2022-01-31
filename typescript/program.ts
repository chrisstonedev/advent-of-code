import {Utils} from './utils';
import {Day01} from './day01';
import {Day02} from './day02';
import {Day04} from './day04';
import {Day09} from './day09';
import {Day10} from './day10';

let days: Day[] = [new Day01(), new Day02(), new Day04(), new Day09(), new Day10()];

try {
  let day = days.find(day => day.dayNumber === 10)!;

  let testInput = Utils.readInput(`Day${day.dayNumber.toString().padStart(2, '0')}_test`);
  let input = Utils.readInput(`Day${day.dayNumber.toString().padStart(2, '0')}`);

  if (Utils.assertTestAnswer(day.executePartOne(testInput), day.partOneTestAnswer)) {
    console.log('Part 1: ' + day.executePartOne(input));
    if (Utils.assertTestAnswer(day.executePartTwo(testInput), day.partTwoTestAnswer)) {
      console.log('Part 2: ' + day.executePartTwo(input));
    }
  }
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
