import { Day } from "../program";

export class Day02 implements Day {
  partOneTestAnswer = 2;
  partTwoTestAnswer = 4;

  executePartOne(input: string[]): number {
    let counter = 0;
    for (const line of input) {
      const numbers = line.split(" ").map(Number);
      const isSafe = this.checkIsSafe(numbers);
      if (isSafe) counter++;
    }
    return counter;
  }

  executePartTwo(input: string[]): number {
    let counter = 0;
    for (const line of input) {
      const numbers = line.split(" ").map(Number);
      const isSafe = this.checkIsSafe(numbers);
      if (isSafe) {
        counter++;
      } else {
        for (let i = 0; i < numbers.length; i++) {
          const newNumbers = [
            ...numbers.slice(0, i),
            ...numbers.slice(i + 1, numbers.length),
          ];
          const newIsSafe = this.checkIsSafe(newNumbers);
          if (newIsSafe) {
            counter++;
            break;
          }
        }
      }
    }
    return counter;
  }

  checkIsSafe(numbers: number[]) {
    let direction = 0;
    let currentNumber = -1;
    for (const number of numbers) {
      if (currentNumber === -1) {
        currentNumber = number;
        continue;
      }
      if (
        Math.abs(currentNumber - number) < 1 ||
        Math.abs(currentNumber - number) > 3
      ) {
        return false;
      }
      const stepDirection = number - currentNumber;
      if (direction === 0) {
        direction = stepDirection;
      } else if (
        (direction > 0 && stepDirection < 0) ||
        (direction < 0 && stepDirection > 0)
      ) {
        return false;
      }
      currentNumber = number;
    }
    return true;
  }
}
