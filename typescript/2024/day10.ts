import { Day } from '../program';

const directions = [
  [0, 1],
  [1, 0],
  [0, -1],
  [-1, 0],
];

export class Day10 implements Day {
  partOneTestAnswer = 36;
  partTwoTestAnswer = 81;

  executePartOne(input: string[]): number {
    let counter = 0;
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        if (input[row][col] === '0') {
          counter += this.keepLookingForHighestUniquePointsFromPath(
            input,
            row,
            col,
            1,
          ).size;
        }
      }
    }
    return counter;
  }

  executePartTwo(input: string[]): number {
    let counter = 0;
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        if (input[row][col] === '0') {
          counter += this.keepLookingForUniquePathsToHighestPointFromPath(
            input,
            row,
            col,
            1,
          );
        }
      }
    }
    return counter;
  }

  private keepLookingForHighestUniquePointsFromPath(
    input: string[],
    row: number,
    col: number,
    nextStep: number,
  ) {
    let matchingNines = new Set();
    directions.forEach(([rowShift, colShift]) => {
      const newRow = row + rowShift;
      const newCol = col + colShift;
      if (
        newRow >= 0 &&
        newRow < input.length &&
        newCol >= 0 &&
        newCol < input[0].length &&
        input[newRow][newCol] === nextStep.toString()
      ) {
        if (nextStep === 9) {
          matchingNines.add(`${newRow},${newCol}`);
        } else {
          matchingNines = new Set([
            ...matchingNines,
            ...this.keepLookingForHighestUniquePointsFromPath(
              input,
              newRow,
              newCol,
              nextStep + 1,
            ),
          ]);
        }
      }
    });
    return matchingNines;
  }

  private keepLookingForUniquePathsToHighestPointFromPath(
    input: string[],
    row: number,
    col: number,
    nextStep: number,
  ) {
    let matchingNines = 0;
    directions.forEach(([rowShift, colShift]) => {
      const newRow = row + rowShift;
      const newCol = col + colShift;
      if (
        newRow >= 0 &&
        newRow < input.length &&
        newCol >= 0 &&
        newCol < input[0].length &&
        input[newRow][newCol] === nextStep.toString()
      ) {
        if (nextStep === 9) {
          matchingNines++;
        } else {
          matchingNines += this.keepLookingForUniquePathsToHighestPointFromPath(
            input,
            newRow,
            newCol,
            nextStep + 1,
          );
        }
      }
    });
    return matchingNines;
  }
}
