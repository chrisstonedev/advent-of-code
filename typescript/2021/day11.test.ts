import { Day11 } from './day11';
import * as assert from 'node:assert';
import { describe, it } from 'node:test';

describe('Day 11', () => {
  const day = new Day11();

  it('should increase energy level by 1 each step', () => {
    const initial = [[1]];
    const expected = [[2]];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  it('should set level to 0 after it flashes', () => {
    const initial = [[9]];
    const expected = [[0]];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  it('should increase adjacent energy levels of a flashing octopus', () => {
    const initial = [
      [1, 1, 1],
      [1, 9, 1],
      [1, 1, 1],
    ];
    const expected = [
      [3, 3, 3],
      [3, 0, 3],
      [3, 3, 3],
    ];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  it('should increase adjacent energy levels when flashing without touching others', () => {
    const initial = [
      [1, 1, 1, 1],
      [1, 9, 1, 1],
      [1, 1, 1, 1],
      [1, 1, 1, 1],
    ];
    const expected = [
      [3, 3, 3, 2],
      [3, 0, 3, 2],
      [3, 3, 3, 2],
      [2, 2, 2, 2],
    ];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  it('should handle multiple flashing octopuses', () => {
    const initial = [
      [1, 1, 1, 1],
      [1, 9, 9, 1],
      [1, 1, 1, 1],
      [1, 1, 1, 1],
    ];
    const expected = [
      [3, 4, 4, 3],
      [3, 0, 0, 3],
      [3, 4, 4, 3],
      [2, 2, 2, 2],
    ];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  it('should handle the first step of the complex example', () => {
    const initial = [
      [1, 1, 1, 1, 1],
      [1, 9, 9, 9, 1],
      [1, 9, 1, 9, 1],
      [1, 9, 9, 9, 1],
      [1, 1, 1, 1, 1],
    ];
    const expected = [
      [3, 4, 5, 4, 3],
      [4, 0, 0, 0, 4],
      [5, 0, 0, 0, 5],
      [4, 0, 0, 0, 4],
      [3, 4, 5, 4, 3],
    ];
    const actual = day.advanceSteps(initial, 1).energyLevelGrid;

    assert.deepStrictEqual(actual, expected);
  });

  describe('Using the test input file', () => {
    const initial = [
      [5, 4, 8, 3, 1, 4, 3, 2, 2, 3],
      [2, 7, 4, 5, 8, 5, 4, 7, 1, 1],
      [5, 2, 6, 4, 5, 5, 6, 1, 7, 3],
      [6, 1, 4, 1, 3, 3, 6, 1, 4, 6],
      [6, 3, 5, 7, 3, 8, 5, 4, 7, 8],
      [4, 1, 6, 7, 5, 2, 4, 6, 4, 5],
      [2, 1, 7, 6, 8, 4, 1, 7, 2, 1],
      [6, 8, 8, 2, 8, 8, 1, 1, 3, 4],
      [4, 8, 4, 6, 8, 4, 8, 5, 5, 4],
      [5, 2, 8, 3, 7, 5, 1, 5, 2, 6],
    ];

    it('should give the right output for the test input after 2 steps', () => {
      const expectedGrid = [
        [8, 8, 0, 7, 4, 7, 6, 5, 5, 5],
        [5, 0, 8, 9, 0, 8, 7, 0, 5, 4],
        [8, 5, 9, 7, 8, 8, 9, 6, 0, 8],
        [8, 4, 8, 5, 7, 6, 9, 6, 0, 0],
        [8, 7, 0, 0, 9, 0, 8, 8, 0, 0],
        [6, 6, 0, 0, 0, 8, 8, 9, 8, 9],
        [6, 8, 0, 0, 0, 0, 5, 9, 4, 3],
        [0, 0, 0, 0, 0, 0, 7, 4, 5, 6],
        [9, 0, 0, 0, 0, 0, 0, 8, 7, 6],
        [8, 7, 0, 0, 0, 0, 6, 8, 4, 8],
      ];
      const actual = day.advanceSteps(initial, 2);

      assert.deepStrictEqual(actual.energyLevelGrid, expectedGrid);
      assert.strictEqual(actual.totalFlashes, 35);
    });

    it('should give the right output for the test input after 3 steps', () => {
      const expectedGrid = [
        [0, 0, 5, 0, 9, 0, 0, 8, 6, 6],
        [8, 5, 0, 0, 8, 0, 0, 5, 7, 5],
        [9, 9, 0, 0, 0, 0, 0, 0, 3, 9],
        [9, 7, 0, 0, 0, 0, 0, 0, 4, 1],
        [9, 9, 3, 5, 0, 8, 0, 0, 6, 3],
        [7, 7, 1, 2, 3, 0, 0, 0, 0, 0],
        [7, 9, 1, 1, 2, 5, 0, 0, 0, 9],
        [2, 2, 1, 1, 1, 3, 0, 0, 0, 0],
        [0, 4, 2, 1, 1, 2, 5, 0, 0, 0],
        [0, 0, 2, 1, 1, 1, 9, 0, 0, 0],
      ];
      const actual = day.advanceSteps(initial, 3);

      assert.deepStrictEqual(actual.energyLevelGrid, expectedGrid);
      assert.strictEqual(actual.totalFlashes, 80);
    });

    it('should give the right output for the test input after 10 steps', () => {
      const actual = day.advanceSteps(initial, 10);
      assert.strictEqual(actual.totalFlashes, 204);
    });
  });
});
