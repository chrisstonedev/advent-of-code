import { Day } from '../program';

export class Day01 implements Day {
  partOneTestAnswer = 3;
  partTwoTestAnswer = 2;

  executePartOne(input: string[]): number {
    let result = 0;
    input.forEach((line) => {
      if (line.at(0) === '+') {
        result += Number(line.substring(1));
      } else if (line.at(0) === '-') {
        result -= Number(line.substring(1));
        return result;
      }
    });
    return result;
  }

  executePartTwo(input: string[]): number {
    let result = 0;
    const results = [0];
    while (true) {
      for (const line of input) {
        if (line.at(0) === '+') {
          result += Number(line.substring(1));
        } else if (line.at(0) === '-') {
          result -= Number(line.substring(1));
        }
        if (results.includes(result)) {
          return result;
        }
        results.push(result);
      }
    }
  }
}
