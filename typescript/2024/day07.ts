import { Day } from "../program";

export class Day07 implements Day {
  partOneTestAnswer = 3749;
  partTwoTestAnswer = 11387;

  executePartOne(input: string[]): number {
    return input
      .filter((calibrationEquation) =>
        this.canBeValid(calibrationEquation, false),
      )
      .map((calibrationEquation) => Number(calibrationEquation.split(":")[0]))
      .reduce((a, b) => a + b);
  }

  executePartTwo(input: string[]): number {
    return input
      .filter((calibrationEquation) =>
        this.canBeValid(calibrationEquation, true),
      )
      .map((calibrationEquation) => Number(calibrationEquation.split(":")[0]))
      .reduce((a, b) => a + b);
  }

  canBeValid(input: string, concatOperatorAllowed: boolean) {
    const numberOfOperators = concatOperatorAllowed ? 3 : 2;
    const [expectedSum, allNumbers] = input.split(": ");
    const numbers = allNumbers.split(" ").map(Number);
    const amountOfTries = Math.pow(numberOfOperators, numbers.length - 1);
    for (let i = 0; i < amountOfTries; i++) {
      let currentTotal = numbers[0];
      for (let j = 1; j < numbers.length; j++) {
        switch (
          Math.floor(i / Math.pow(numberOfOperators, j - 1)) % numberOfOperators
        ) {
          case 0:
            currentTotal = currentTotal + numbers[j];
            break;
          case 1:
            currentTotal = currentTotal * numbers[j];
            break;
          case 2:
            currentTotal = Number(`${currentTotal}${numbers[j]}`);
            break;
        }
      }
      if (currentTotal === Number(expectedSum)) {
        return true;
      }
    }
    return false;
  }
}
