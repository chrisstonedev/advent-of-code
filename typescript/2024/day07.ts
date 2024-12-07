import { Day } from "../program";

export class Day07 implements Day {
  partOneTestAnswer = 3749;
  partTwoTestAnswer = 11387;

  executePartOne(input: string[]): number {
    return input
      .filter((x) => this.canBeValid(x))
      .map((x) => Number(x.split(":")[0]))
      .reduce((a, b) => a + b);
  }

  executePartTwo(input: string[]): number {
    return input
      .filter((x) => this.canBeValidPlus(x))
      .map((x) => Number(x.split(":")[0]))
      .reduce((a, b) => a + b);
  }

  canBeValid(input: string) {
    const [expectedSum, allNumbers] = input.split(": ");
    const numbers = allNumbers.split(" ").map(Number);
    const amountOfTries = Math.pow(2, numbers.length - 1);
    // console.log(amountOfTries, numbers);
    for (let i = 0; i < amountOfTries; i++) {
      let currentTotal = numbers[0];
      for (let j = 1; j < numbers.length; j++) {
        const isAdd = Math.floor(i / Math.pow(2, j - 1)) % 2 === 0;
        // console.log("hmm", i, j, isAdd, currentTotal);
        if (isAdd) {
          currentTotal += numbers[j];
        } else {
          currentTotal *= numbers[j];
        }
      }
      // console.log(i, currentTotal);
      if (currentTotal === Number(expectedSum)) {
        // console.log("yay");
        return true;
      }
    }
    return false;
  }

  canBeValidPlus(input: string) {
    const [expectedSum, allNumbers] = input.split(": ");
    const numbers = allNumbers.split(" ").map(Number);
    const amountOfTries = Math.pow(3, numbers.length - 1);
    // console.log(amountOfTries, numbers);
    for (let i = 0; i < amountOfTries; i++) {
      let currentTotal = numbers[0];
      for (let j = 1; j < numbers.length; j++) {
        const operation = Math.floor(i / Math.pow(3, j - 1)) % 3;
        // console.log("hmm", i, j, isAdd, currentTotal);
        if (operation === 0) {
          currentTotal += numbers[j];
        } else if (operation === 1) {
          currentTotal *= numbers[j];
        } else {
          currentTotal = Number(`${currentTotal}${numbers[j]}`);
        }
      }
      // console.log(i, currentTotal);
      if (currentTotal === Number(expectedSum)) {
        // console.log("yay");
        return true;
      }
    }
    return false;
  }
}
