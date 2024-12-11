import { Day } from "../program";

export class Day11 implements Day {
  partOneTestAnswer = 55312;
  partTwoTestAnswer = 65601038650482;

  executePartOne(input: string[]): number {
    return this.getAnswer(input[0], 25);
  }

  executePartTwo(input: string[]): number {
    return this.getAnswerNew(input[0], 75);
  }

  solvePartOne(input: string, blinks: number) {
    for (let i = 0; i < blinks; i++) {
      input = this.doThings(input);
    }
    return input;
  }

  doThings(input: string) {
    return input
      .split(" ")
      .map((x) => {
        if (x === "0") {
          return "1";
        }
        if (x.length % 2 === 0) {
          const leftSide = x.slice(0, x.length / 2);
          const rightSide = x.slice(x.length / 2);
          return `${Number(leftSide)} ${Number(rightSide)}`;
        }
        return Number(x) * 2024;
      })
      .join(" ");
  }

  getAnswer(input: string, blinks: number) {
    const thing = this.solvePartOne(input, blinks);
    return thing.split(" ").length;
  }

  getAnswerNew(input: string, blinks: number) {
    let parts = new Map(input.split(" ").map((x) => [x, 1]));
    for (let iteration = 0; iteration < blinks / 5; iteration++) {
      const nextTime = new Map<string, number>();
      for (const [marking, count] of parts) {
        const blueberry = this.solvePartOne(marking, 5);
        const apple = blueberry.split(" ");
        for (const stem of apple) {
          nextTime.set(stem, (nextTime.get(stem) ?? 0) + count);
        }
      }
      parts = new Map([...nextTime]);
    }
    return Array.from(parts.values()).reduce((a, b) => a + b);
  }
}
