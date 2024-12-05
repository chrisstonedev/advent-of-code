import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day05 } from "./day05";

describe("Day 5", () => {
  const day = new Day05();

  [
    { input: ["75", "47", "61", "53", "29"], expected: true },
    { input: ["97", "61", "53", "29", "13"], expected: true },
    { input: ["75", "29", "13"], expected: true },
    { input: ["75", "97", "47", "61", "53"], expected: false },
    { input: ["61", "13", "29"], expected: false },
    { input: ["97", "13", "75", "29", "47"], expected: false },
  ].forEach(({ input, expected }) => {
    it(`should return ${expected} from test input for ${JSON.stringify(input)}`, () => {
      const first = [
        "47|53",
        "97|13",
        "97|61",
        "97|47",
        "75|29",
        "61|13",
        "75|53",
        "29|13",
        "97|29",
        "53|29",
        "61|53",
        "97|53",
        "61|29",
        "47|13",
        "75|47",
        "97|75",
        "47|61",
        "75|61",
        "47|29",
        "75|13",
        "53|13",
      ];
      assert.deepStrictEqual(day.doSomething(first, input), expected);
    });
  });
});
