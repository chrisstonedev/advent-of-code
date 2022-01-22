import {Utils} from './utils';
import {Day02} from './day02';
import {Day04} from './day04';

function getDay(day: number): Day {
    switch (day) {
        case 2:
            return new Day02();
        case 4:
            return new Day04();
        default:
            throw new Error('Requested day is not available');
    }
}

try {
    let day = getDay(4);

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
