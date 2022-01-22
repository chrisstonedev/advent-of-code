import {Utils} from './utils';
import {Day01} from './day01';
import {Day02} from './day02';
import {Day04} from './day04';

let days: Day[] = [new Day01(), new Day02(), new Day04()];

try {
    let day = days.find(day => day.dayNumber === 1);

    let testInput = Utils.readInput(`Day0${day.dayNumber}_test`);
    let input = Utils.readInput(`Day0${day.dayNumber}`);

    Utils.assertTestAnswer(day.executePartOne(testInput), day.partOneTestAnswer);
    console.log('Part 1: ' + day.executePartOne(input));
    Utils.assertTestAnswer(day.executePartTwo(testInput), day.partTwoTestAnswer);
    console.log('Part 2: ' + day.executePartTwo(input));
} catch (err) {
    console.error(err)
}

export interface Day {
    dayNumber: number;
    partOneTestAnswer: number;
    partTwoTestAnswer: number;
    executePartOne: (input: string[]) => number;
    executePartTwo: (input: string[]) => number;
}
