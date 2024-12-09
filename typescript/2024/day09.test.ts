import * as assert from "node:assert";
import { describe, it } from "node:test";
import { Day09 } from "../2024";

describe("Day 9", () => {
  const day = new Day09();

  describe("when expanding input", () => {
    [
      {
        input: "12345",
        expected: "0..111....22222",
      },
      {
        input: "2333133121414131402",
        expected: "00...111...2...333.44.5555.6666.777.888899",
      },
      {
        input: "123456789",
        expected: "0..111....22222......3333333........444444444",
      },
      {
        input: "90909",
        expected: "000000000111111111222222222",
      },
      {
        input: "101010101010101010101",
        expected: "01234567890",
      },
    ].forEach(({ input, expected }) => {
      it(`should correctly expand ${input}`, () => {
        assert.deepStrictEqual(day.expandInput(input), expected);
      });
    });
  });

  describe("when moving blocks", () => {
    [
      {
        input: "0..111....22222",
        expected: "022111222",
      },
      {
        input: "00...111...2...333.44.5555.6666.777.888899",
        expected: "0099811188827773336446555566",
      },
      {
        input: "0..111....22222......3333333........444444444",
        expected: "0441114444222224443333333",
      },
    ].forEach(({ input, expected }) => {
      it(`should correctly move blocks for ${input}`, () => {
        assert.deepStrictEqual(day.moveBlocks(input), expected);
      });
    });
  });

  describe("when calculating checksum", () => {
    [
      { input: "022111222", expected: 60 },
      { input: "0099811188827773336446555566", expected: 1928 },
      { input: "0441114444222224443333333", expected: 897 },
    ].forEach(({ input, expected }) => {
      it(`should return ${expected} for ${input}`, () => {
        assert.deepStrictEqual(day.calculateChecksum(input), expected);
      });
    });
  });
});
