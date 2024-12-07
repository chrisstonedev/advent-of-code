import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day07 } from "./day07";

describe("Day 7", () => {
  const day = new Day07();

  [
    { input: "190: 10 19", expected: true },
    { input: "3267: 81 40 27", expected: true },
    { input: "83: 17 5", expected: false },
    { input: "156: 15 6", expected: false },
    { input: "7290: 6 8 6 15", expected: false },
    { input: "161011: 16 10 13", expected: false },
    { input: "192: 17 8 14", expected: false },
    { input: "21037: 9 7 18 13", expected: false },
    { input: "292: 11 6 16 20", expected: true },
  ].forEach(({ input, expected }) => {
    it(`should return ${expected} from test input for ${JSON.stringify(input)}`, () => {
      assert.deepStrictEqual(day.canBeValid(input), expected);
    });
  });

  [
    { input: "190: 10 19", expected: true },
    { input: "3267: 81 40 27", expected: true },
    { input: "83: 17 5", expected: false },
    { input: "156: 15 6", expected: true },
    { input: "7290: 6 8 6 15", expected: true },
    { input: "161011: 16 10 13", expected: false },
    { input: "192: 17 8 14", expected: true },
    { input: "21037: 9 7 18 13", expected: false },
    { input: "292: 11 6 16 20", expected: true },
  ].forEach(({ input, expected }) => {
    it(`should return ${expected} from test plus input for ${JSON.stringify(input)}`, () => {
      assert.deepStrictEqual(day.canBeValidPlus(input), expected);
    });
  });
});
