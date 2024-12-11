import { Day } from "../program";

export class Day11 implements Day {
  partOneTestAnswer = 55312;
  partTwoTestAnswer = 65601038650482;

  executePartOne(input: string[]): number {
    return this.blinkSeveralTimes(input[0], 25);
  }

  executePartTwo(input: string[]): number {
    return this.blinkSeveralTimes(input[0], 75);
  }

  private followRulesForStones(engraving: string) {
    if (engraving === "0") {
      return "1";
    }
    if (engraving.length % 2 === 0) {
      const leftSide = engraving.slice(0, engraving.length / 2);
      const rightSide = engraving.slice(engraving.length / 2);
      return `${Number(leftSide)} ${Number(rightSide)}`;
    }
    return (Number(engraving) * 2024).toString();
  }

  blinkSeveralTimes(input: string, blinks: number) {
    let stonesToEvaluateInCurrentLoop = new Map(
      input.split(" ").map((x) => [x, 1]),
    );
    for (let iteration = 0; iteration < blinks; iteration++) {
      const stonesToEvaluateInNextLoop = new Map<string, number>();
      for (const [marking, count] of stonesToEvaluateInCurrentLoop) {
        for (const newStone of this.followRulesForStones(marking).split(" ")) {
          stonesToEvaluateInNextLoop.set(
            newStone,
            (stonesToEvaluateInNextLoop.get(newStone) ?? 0) + count,
          );
        }
      }
      stonesToEvaluateInCurrentLoop = new Map([...stonesToEvaluateInNextLoop]);
    }
    return Array.from(stonesToEvaluateInCurrentLoop.values()).reduce(
      (a, b) => a + b,
    );
  }
}
