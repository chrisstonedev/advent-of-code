import * as assert from 'node:assert';
import { describe, it } from 'node:test';
import { Day01 } from './day01';
import { Utils } from '../utils';

describe('Day 1', () => {
  const day = new Day01();

  describe('Part 1', () => {
    [
      {
        input: ['+1', '+1', '+1'],
        expected: 3,
        description: 'descending set',
      },
      {
        input: ['+1', '+1', '-2'],
        expected: 0,
        description: 'ascending set that jumps too high',
      },
      {
        input: ['-1', '-2', '-3'],
        expected: -6,
        description: 'descending set that jumps too low',
      },
    ].forEach(({ input, expected, description }) => {
      it(`should return ${expected} for ${description}`, () => {
        assert.strictEqual(day.executePartOne(input), expected);
      });
    });

    it('input test', () => {
      const testInput = Utils.readInput(`2018_01_input`);
      assert.strictEqual(day.executePartOne(testInput), 508);
    });
  });
  describe('Part 2', () => {
    [
      {
        input: ['+1', '-1'],
        expected: 0,
        description: 'descending set',
      },
      {
        input: ['+3', '+3', '+4', '-2', '-4'],
        expected: 10,
        description: 'ascending set that jumps too high',
      },
      {
        input: ['-6', '+3', '+8', '+5', '-6'],
        expected: 5,
        description: 'descending set that jumps too low',
      },
      {
        input: ['+7', '+7', '-2', '-7', '-4'],
        expected: 14,
        description: 'descending set that jumps too low',
      },
    ].forEach(({ input, expected, description }) => {
      it(`should return ${expected} for ${description}`, () => {
        assert.strictEqual(day.executePartTwo(input), expected);
      });
    });

    it('input test', () => {
      const testInput = Utils.readInput(`2018_01_input`);
      assert.strictEqual(day.executePartTwo(testInput), 549);
    });
  });
});
