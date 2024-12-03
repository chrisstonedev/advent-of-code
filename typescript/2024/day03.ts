import { Day } from "../program";

export class Day03 implements Day {
  partOneTestAnswer = 161;
  partTwoTestAnswer = 48;

  executePartOne(input: string[]): number {
    const fullString = input.join("");
    const matches = this.getAllMuls(fullString);
    let sum = 0;
    matches.forEach((match) => {
      const numbers = this.extractNumbers(match);
      sum += numbers[0] * numbers[1];
    });
    return sum;
  }

  executePartTwo(input: string[]): number {
    const fullString = input.join("");
    const matches = this.getAllInstructions(fullString);
    let sum = 0;
    let yesDo = true;
    matches.forEach((match) => {
      if (match.startsWith("mul") && yesDo) {
        const numbers = this.extractNumbers(match);
        sum += numbers[0] * numbers[1];
      } else if (match.startsWith("don't")) {
        yesDo = false;
      } else if (match.startsWith("do")) {
        yesDo = true;
      }
    });
    return sum;
  }

  getAllMuls(value: string) {
    const regex = /mul\([0-9]+,[0-9]+\)/g;
    return Array.from(value.match(regex) ?? []);
  }

  extractNumbers(match: string) {
    return match.replace("mul(", "").replace(")", "").split(",").map(Number);
  }

  getAllInstructions(value: string) {
    const regex = /(mul\([0-9]+,[0-9]+\)|do(n't)?\(\))/g;
    return Array.from(value.match(regex) ?? []);
  }
}
