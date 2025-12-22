import * as assert from 'node:assert';
import { describe, it } from 'node:test';
import { Day02 } from './day02';

describe('Day 2', () => {
  const day = new Day02();

  [
    { input: [7, 6, 4, 2, 1], expected: true, description: 'descending set' },
    {
      input: [1, 2, 7, 8, 9],
      expected: false,
      description: 'ascending set that jumps too high',
    },
    {
      input: [9, 7, 6, 2, 1],
      expected: false,
      description: 'descending set that jumps too low',
    },
    {
      input: [1, 3, 2, 4, 5],
      expected: false,
      description: 'set that ascends then descends',
    },
    {
      input: [8, 6, 4, 4, 1],
      expected: false,
      description: 'set with repeating number',
    },
    { input: [1, 3, 6, 7, 9], expected: true, description: 'ascending set' },
    {
      input: [3, 1, 2, 4, 5],
      expected: false,
      description: 'set that descends then ascends',
    },
  ].forEach(({ input, expected, description }) => {
    it(`should return ${expected} for ${description}`, () => {
      assert.strictEqual(day.checkIsSafe(input), expected);
    });
  });
});
