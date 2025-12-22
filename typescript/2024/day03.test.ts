import * as assert from 'node:assert';
import { describe, it } from 'node:test';
import { Day03 } from './day03';

describe('Day 3', () => {
  const day = new Day03();

  [
    {
      input: 'testmul(1,2)mul(3,4)xa',
      expected: ['mul(1,2)', 'mul(3,4)'],
      description: 'a small string',
    },
    {
      input:
        'xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))',
      expected: ['mul(2,4)', 'mul(5,5)', 'mul(11,8)', 'mul(8,5)'],
      description: 'the provided sample string',
    },
  ].forEach(({ input, expected, description }) => {
    it(`should get all mul instructions from ${description}`, () => {
      assert.deepStrictEqual(day.getAllMulInstructions(input), expected);
    });
  });

  [
    {
      input: 'mul(1,2)',
      expected: [1, 2],
      description: 'two single-digit numbers',
    },
    {
      input: 'mul(12,45)',
      expected: [12, 45],
      description: 'two double-digit numbers',
    },
  ].forEach(({ input, expected, description }) => {
    it(`should extract number arguments from a mul call with ${description}`, () => {
      assert.deepStrictEqual(day.extractNumbers(input), expected);
    });
  });

  [
    {
      input: "testmul(1,2)don't()mul(3,4)xado()tse",
      expected: ['mul(1,2)', "don't()", 'mul(3,4)', 'do()'],
      description: 'a small string',
    },
    {
      input:
        "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))\n",
      expected: [
        'mul(2,4)',
        "don't()",
        'mul(5,5)',
        'mul(11,8)',
        'do()',
        'mul(8,5)',
      ],
      description: 'the provided sample string',
    },
  ].forEach(({ input, expected, description }) => {
    it(`should get all valid instructions from ${description}`, () => {
      assert.deepStrictEqual(day.getAllValidInstructions(input), expected);
    });
  });

  [
    { input: 'mul(1,2)', expected: 2 },
    { input: 'mul(3,4)', expected: 12 },
  ].forEach(({ input, expected }) => {
    it(`should evaluate ${input} as ${expected}`, () => {
      assert.deepStrictEqual(day.executeMul(input), expected);
    });
  });
});
