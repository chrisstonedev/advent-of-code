import { Day } from "../program";

export class Day01 implements Day {
  partOneTestAnswer = 7;
  partTwoTestAnswer = 5;

  executePartOne(input: string[]): number {
    const numbers = input.map((x) => +x);

    return Day01.getCountOfIncreasesInArray(numbers);
  }

  executePartTwo(input: string[]): number {
    const numbers = input.map((x) => +x);
    const slidingWindow = [];
    for (let i = 2; i < numbers.length; i++) {
      slidingWindow.push(numbers[i - 2] + numbers[i - 1] + numbers[i]);
    }

    return Day01.getCountOfIncreasesInArray(slidingWindow);
  }

  private static getCountOfIncreasesInArray(numbers: number[]) {
    let increaseCount = 0;
    for (let i = 1; i < numbers.length; i++) {
      if (numbers[i] > numbers[i - 1]) {
        increaseCount++;
      }
    }

    return increaseCount;
  }
}
