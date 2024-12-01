import { Day } from "../program";

export class Day202401 implements Day {
  dayNumber = 202401;

  partOneTestAnswer = 11;
  partTwoTestAnswer = 31;

  executePartOne(input: string[]): number {
    const leftSide: number[] = [];
    const rightSide: number[] = [];
    input.forEach((x) => {
      const parts = x.split("   ");
      leftSide.push(Number(parts[0]));
      rightSide.push(Number(parts[1]));
    });
    leftSide.sort((a, b) => a - b);
    rightSide.sort((a, b) => a - b);
    let answer = 0;
    for (let i = 0; i < leftSide.length; i++) {
      answer += Math.abs(leftSide[i] - rightSide[i]);
    }
    return answer;
  }

  executePartTwo(input: string[]): number {
    const leftSide: number[] = [];
    const rightSide: number[] = [];
    input.forEach((x) => {
      const parts = x.split("   ");
      leftSide.push(Number(parts[0]));
      rightSide.push(Number(parts[1]));
    });
    let answer = 0;
    leftSide.forEach((x) => {
      answer += x * rightSide.filter((y) => y === x).length;
    });
    return answer;
  }
}
