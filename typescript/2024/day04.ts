import { Day } from "../program";

export class Day04 implements Day {
  partOneTestAnswer = 18;
  partTwoTestAnswer = 9;

  executePartOne(input: string[]): number {
    let counter = 0;
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        if (input[row][col] === "X") {
          // let's check
          const right = input[row].slice(col, col + 4);
          if (right === "XMAS") {
            // console.log("R\n");
            counter++;
          }
          const left = input[row]
            .slice(col - 3, col + 1)
            .split("")
            .reverse()
            .join("");
          if (left === "XMAS") {
            // console.log("L\n");
            counter++;
          }
          if (row <= input.length - 4) {
            const down = `${input[row][col]}${input[row + 1][col]}${input[row + 2][col]}${input[row + 3][col]}`;
            if (down === "XMAS") {
              // console.log("D\n");
              counter++;
            }
            const downleft = `${input[row][col]}${input[row + 1][col - 1]}${input[row + 2][col - 2]}${input[row + 3][col - 3]}`;
            if (downleft === "XMAS") {
              // console.log("DL\n");
              counter++;
            }
            const downright = `${input[row][col]}${input[row + 1][col + 1]}${input[row + 2][col + 2]}${input[row + 3][col + 3]}`;
            if (downright === "XMAS") {
              // console.log("DR\n");
              counter++;
            }
          }
          if (row >= 3) {
            const up = `${input[row][col]}${input[row - 1][col]}${input[row - 2][col]}${input[row - 3][col]}`;
            if (up === "XMAS") {
              // console.log("U\n");
              counter++;
            }
            const upleft = `${input[row][col]}${input[row - 1][col - 1]}${input[row - 2][col - 2]}${input[row - 3][col - 3]}`;
            if (upleft === "XMAS") {
              // console.log("UL\n");
              counter++;
            }
            const upright = `${input[row][col]}${input[row - 1][col + 1]}${input[row - 2][col + 2]}${input[row - 3][col + 3]}`;
            if (upright === "XMAS") {
              // console.log("UR\n");
              counter++;
            }
          }
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
          // let's check!
          if (
            input[row - 1][col - 1] === "M" &&
            input[row + 1][col + 1] === "S" &&
            input[row + 1][col - 1] === "M" &&
            input[row - 1][col + 1] === "S"
          ) {
            counter++;
          }
          if (
            input[row - 1][col - 1] === "S" &&
            input[row + 1][col + 1] === "M" &&
            input[row + 1][col - 1] === "M" &&
            input[row - 1][col + 1] === "S"
          ) {
            counter++;
          }
          if (
            input[row - 1][col - 1] === "M" &&
            input[row + 1][col + 1] === "S" &&
            input[row + 1][col - 1] === "S" &&
            input[row - 1][col + 1] === "M"
          ) {
            counter++;
          }
          if (
            input[row - 1][col - 1] === "S" &&
            input[row + 1][col + 1] === "M" &&
            input[row + 1][col - 1] === "S" &&
            input[row - 1][col + 1] === "M"
          ) {
            counter++;
          }
        }
      }
    }
    return counter;
  }
}
