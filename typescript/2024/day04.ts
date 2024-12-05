import { Day } from "../program";

export class Day04 implements Day {
  partOneTestAnswer = 18;
  partTwoTestAnswer = 9;

  executePartOne(input: string[]): number {
    let counter = 0;
    const allDirections = [
      [0, 1],
      [1, 1],
      [1, 0],
      [1, -1],
      [0, -1],
      [-1, -1],
      [-1, 0],
      [-1, 1],
    ];
    const directionsExceptMovingUp = allDirections.filter(
      ([rowShift]) => rowShift >= 0,
    );
    const directionsExceptMovingDown = allDirections.filter(
      ([rowShift]) => rowShift <= 0,
    );
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        if (input[row][col] === "X") {
          const directions =
            row >= 3 && row < input.length - 3
              ? allDirections
              : row < 3
                ? directionsExceptMovingUp
                : directionsExceptMovingDown;
          directions.forEach(([rowShift, colShift]) => {
            if (
              input[row + rowShift][col + colShift] === "M" &&
              input[row + rowShift * 2][col + colShift * 2] === "A" &&
              input[row + rowShift * 3][col + colShift * 3] === "S"
            ) {
              counter++;
            }
          });
        }
      }
    }
    return counter;
  }

  executePartTwo(input: string[]): number {
    let counter = 0;
    for (let row = 1; row < input.length - 1; row++) {
      for (let col = 1; col < input[row].length - 1; col++) {
        if (input[row][col] === "A") {
          const bottomLeftToTopRight =
            input[row + 1][col - 1] + input[row - 1][col + 1];
          const upperLeftToBottomRight =
            input[row - 1][col - 1] + input[row + 1][col + 1];
          if (
            (bottomLeftToTopRight === "MS" || bottomLeftToTopRight === "SM") &&
            (upperLeftToBottomRight === "MS" || upperLeftToBottomRight === "SM")
          ) {
            counter++;
          }
        }
      }
    }
    return counter;
  }
}
