import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day11 } from "../2024";

describe("Day 11", () => {
  const day = new Day11();

  describe("when executing part 1", () => {
    [
      {
        input: "0 1 10 99 999",
        blinks: 1,
        expected: "1 2024 1 0 9 9 2021976",
      },
      {
        input: "125 17",
        blinks: 1,
        expected: "253000 1 7",
      },
      {
        input: "125 17",
        blinks: 2,
        expected: "253 0 2024 14168",
      },
      {
        input: "125 17",
        blinks: 3,
        expected: "512072 1 20 24 28676032",
      },
      {
        input: "125 17",
        blinks: 4,
        expected: "512 72 2024 2 0 2 4 2867 6032",
      },
      {
        input: "125 17",
        blinks: 5,
        expected: "1036288 7 2 20 24 4048 1 4048 8096 28 67 60 32",
      },
      {
        input: "125 17",
        blinks: 6,
        expected:
          "2097446912 14168 4048 2 0 2 4 40 48 2024 40 48 80 96 2 8 6 7 6 0 3 2",
      },
    ].forEach(({ input, blinks, expected }) => {
      it(`should correctly expect ${expected}`, () => {
        assert.deepStrictEqual(day.solvePartOne(input, blinks), expected);
      });
    });
  });

  describe("when executing part 1 final answer", () => {
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
      it(`should correctly expect ${expected}`, () => {
        assert.deepStrictEqual(day.getAnswer(input, blinks), expected);
      });
    });
  });
});
