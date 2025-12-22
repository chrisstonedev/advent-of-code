import * as assert from 'node:assert';
import { describe, it } from 'node:test';
import { Day08 } from './day08';

function mapToObj(map: Map<string, number[][]>) {
  const obj = Object.create(null);
  for (const [k, v] of map) {
    obj[k] = v;
  }
  return obj;
}

describe('Day 8', () => {
  const day = new Day08();

  describe('when creating the map for the input', () => {
    [
      {
        input: [
          '..........',
          '..........',
          '..........',
          '....a.....',
          '..........',
          '.....a....',
          '..........',
          '..........',
          '..........',
          '..........',
        ],
        expected: new Map<string, number[][]>([
          [
            'a',
            [
              [3, 4],
              [5, 5],
            ],
          ],
        ]),
        description: '2 antennas in 1 type',
      },
      {
        input: [
          '..........',
          '..........',
          '..........',
          '....a.....',
          '........a.',
          '.....a....',
          '..........',
          '......A...',
          '..........',
          '..........',
        ],
        expected: new Map<string, number[][]>([
          [
            'a',
            [
              [3, 4],
              [4, 8],
              [5, 5],
            ],
          ],
          ['A', [[7, 6]]],
        ]),
        description: '3 antennas for 1 type and 1 antenna for another',
      },
      {
        input: [
          '............',
          '........0...',
          '.....0......',
          '.......0....',
          '....0.......',
          '......A.....',
          '............',
          '............',
          '........A...',
          '.........A..',
          '............',
          '............',
        ],
        expected: new Map<string, number[][]>([
          [
            '0',
            [
              [1, 8],
              [2, 5],
              [3, 7],
              [4, 4],
            ],
          ],
          [
            'A',
            [
              [5, 6],
              [8, 8],
              [9, 9],
            ],
          ],
        ]),
        description: 'all antennas from the test input',
      },
    ].forEach(({ input, expected, description }) => {
      it(`should return ${description}`, () => {
        const actual = day.evaluateInput(input);
        const actualObject = mapToObj(actual);
        const expectedObject = mapToObj(expected);
        assert.deepEqual(actualObject, expectedObject);
      });
    });
  });

  describe('when finding antinodes from a map', () => {
    [
      {
        input: new Map<string, number[][]>([
          [
            'a',
            [
              [3, 4],
              [5, 5],
            ],
          ],
        ]),
        dataLength: 10,
        expected: new Set(['1,3', '7,6']),
        description: '2 antinodes for 2 antennas',
      },
      {
        input: new Map<string, number[][]>([
          [
            'a',
            [
              [3, 4],
              [4, 8],
              [5, 5],
            ],
          ],
          ['A', [[7, 6]]],
        ]),
        dataLength: 10,
        expected: new Set(['1,3', '2,0', '6,2', '7,6']),
        description: '3 antinodes for 3 antennas',
      },
      {
        input: new Map<string, number[][]>([
          [
            '0',
            [
              [1, 8],
              [2, 5],
              [3, 7],
              [4, 4],
            ],
          ],
          [
            'A',
            [
              [5, 6],
              [8, 8],
              [9, 9],
            ],
          ],
        ]),
        dataLength: 12,
        expected: new Set([
          '0,6',
          '0,11',
          '1,3',
          '2,4',
          '2,10',
          '3,2',
          '4,9',
          '5,1',
          '5,6',
          '6,3',
          '7,0',
          '7,7',
          '10,10',
          '11,10',
        ]),
        description: '14 antinodes for the test input',
      },
    ].forEach(({ input, dataLength, expected, description }) => {
      it(`should return ${description}`, () => {
        assert.deepStrictEqual(day.findAntinodes(input, dataLength), expected);
      });
    });
  });

  describe('when finding resonant antinodes from a map', () => {
    [
      {
        input: new Map<string, number[][]>([
          [
            'T',
            [
              [0, 0],
              [1, 3],
              [2, 1],
            ],
          ],
        ]),
        dataLength: 10,
        expected: new Set([
          '0,0',
          '0,5',
          '1,3',
          '2,1',
          '2,6',
          '3,9',
          '4,2',
          '6,3',
          '8,4',
        ]),
        description: '9 antinodes for 3 antennas',
      },
      {
        input: new Map<string, number[][]>([
          [
            '0',
            [
              [1, 8],
              [2, 5],
              [3, 7],
              [4, 4],
            ],
          ],
          [
            'A',
            [
              [5, 6],
              [8, 8],
              [9, 9],
            ],
          ],
        ]),
        dataLength: 12,
        expected: new Set([
          '0,0',
          '0,1',
          '0,11',
          '0,6',
          '1,1',
          '1,3',
          '1,8',
          '2,10',
          '2,2',
          '2,4',
          '2,5',
          '3,2',
          '3,3',
          '3,7',
          '4,4',
          '4,9',
          '5,1',
          '5,11',
          '5,5',
          '5,6',
          '6,3',
          '6,6',
          '7,0',
          '7,5',
          '7,7',
          '8,2',
          '8,8',
          '9,4',
          '9,9',
          '10,1',
          '10,10',
          '11,10',
          '11,11',
          '11,3',
        ]),
        description: '34 antinodes from the test input',
      },
    ].forEach(({ input, dataLength, expected, description }) => {
      it(`should return ${description}`, () => {
        assert.deepStrictEqual(
          day.findResonantAntinodes(input, dataLength),
          expected,
        );
      });
    });
  });
});
