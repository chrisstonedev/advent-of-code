import * as fs from "node:fs";

export class Utils {
  static readInput(fileName: string): string[] {
    return fs
      .readFileSync(`../../aoc-data/${fileName}.txt`)
      .toString()
      .split(/\r?\n/);
  }

  static assertTestAnswer(actual: number, expected: number): boolean {
    console.assert(
      actual === expected,
      `expected ${expected} but received ${actual}`,
    );
    return actual === expected;
  }
}
