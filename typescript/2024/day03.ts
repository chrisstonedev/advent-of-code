import { Day } from "../program";

export class Day03 implements Day {
  partOneTestAnswer = 161;
  partTwoTestAnswer = 48;

  executePartOne(input: string[]): number {
    const fullInput = input.join("");
    const instructions = this.getAllMulInstructions(fullInput);
    let sum = 0;
    instructions.forEach(
      (instruction) => (sum += this.executeMul(instruction)),
    );
    return sum;
  }

  executePartTwo(input: string[]): number {
    const fullInput = input.join("");
    const instructions = this.getAllValidInstructions(fullInput);
    let sum = 0;
    let instructionsEnabled = true;
    instructions.forEach((match) => {
      if (instructionsEnabled && match.startsWith("mul")) {
        sum += this.executeMul(match);
      } else {
        instructionsEnabled = match === "do()";
      }
    });
    return sum;
  }

  executeMul(instruction: string) {
    const numbers = this.extractNumbers(instruction);
    return numbers[0] * numbers[1];
  }

  getAllMulInstructions(fullInput: string) {
    const regex = /mul\([0-9]+,[0-9]+\)/g;
    return fullInput.match(regex) ?? [];
  }

  extractNumbers(instruction: string) {
    return (instruction.match(/([0-9]+)/g) ?? []).map(Number);
  }

  getAllValidInstructions(value: string) {
    const regex = /(mul\([0-9]+,[0-9]+\)|do(n't)?\(\))/g;
    return value.match(regex) ?? [];
  }
}
