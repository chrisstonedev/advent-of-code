import { Day } from "../program";

export class Day02 implements Day {
  partOneTestAnswer = 2;
  partTwoTestAnswer = 4;

  executePartOne(input: string[]): number {
    let counter = 0;
    for (const line of input) {
      const numbers = line.split(" ").map(Number);
      if (this.checkIsSafe(numbers)) counter++;
    }
    return counter;
  }

  executePartTwo(input: string[]): number {
    let counter = 0;
    for (const line of input) {
      const numbers = line.split(" ").map(Number);
      if (this.checkIsSafe(numbers)) {
        counter++;
        continue;
      }
      for (let i = 0; i < numbers.length; i++) {
        const newNumbers = [
          ...numbers.slice(0, i),
          ...numbers.slice(i + 1, numbers.length),
        ];
        if (this.checkIsSafe(newNumbers)) {
          counter++;
          break;
        }
      }
    }
    return counter;
  }

  checkIsSafe(numbers: number[]) {
    const isAscending = numbers[1] > numbers[0];
    for (let i = 1; i < numbers.length; i++) {
      const levelChange = Math.abs(numbers[i] - numbers[i - 1]);
      if (levelChange < 1 || levelChange > 3) {
        return false;
      }
      const levelAscending = numbers[i] > numbers[i - 1];
      if (isAscending !== levelAscending) {
        return false;
      }
    }
    return true;
  }
}
