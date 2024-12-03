import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day03 } from "./day03";

describe("Day 3", () => {
  const day = new Day03();

  it("should get all mul instructions from a string", () => {
    const initial = "testmul(1,2)mul(3,4)xa";
    const expected = ["mul(1,2)", "mul(3,4)"];
    const actual = day.getAllMuls(initial);

    assert.deepEqual(actual, expected);
  });

  it("should extract number arguments from a mul call", () => {
    const initial = "mul(1,2)";
    const expected = [1, 2];
    const actual = day.extractNumbers(initial);

    assert.deepEqual(actual, expected);
  });

  it("should get all valid instructions from a string input", () => {
    const initial = "testmul(1,2)don't()mul(3,4)xado()tse";
    const expected = ["mul(1,2)", "don't()", "mul(3,4)", "do()"];
    const actual = day.getAllInstructions(initial);

    assert.deepEqual(actual, expected);
  });
});
