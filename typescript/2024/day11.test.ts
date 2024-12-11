import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day11 } from "../2024";

describe("Day 11", () => {
  const day = new Day11();

  describe("when solving puzzle", () => {
    [
      {
        input: "0 1 10 99 999",
        blinks: 1,
        expected: 7,
      },
      {
        input: "125 17",
        blinks: 1,
        expected: 3,
      },
      {
        input: "125 17",
        blinks: 2,
        expected: 4,
      },
      {
        input: "125 17",
        blinks: 3,
        expected: 5,
      },
      {
        input: "125 17",
        blinks: 4,
        expected: 9,
      },
      {
        input: "125 17",
        blinks: 5,
        expected: 13,
      },
      {
        input: "125 17",
        blinks: 6,
        expected: 22,
      },
      {
        input: "125 17",
        blinks: 25,
        expected: 55312,
      },
    ].forEach(({ input, blinks, expected }) => {
      it(`should return ${expected} stones when blinking ${blinks !== 1 ? blinks + " times" : "once"} at ${input}`, () => {
        assert.deepStrictEqual(day.blinkSeveralTimes(input, blinks), expected);
      });
    });
  });
});
