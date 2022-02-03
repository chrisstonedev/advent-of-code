import {Day11} from './day11';

describe('Day 11', () => {
  let day = new Day11();

  it('should increase energy level by 1 each step', () => {
    let initial = [[1]];
    let expected = [[2]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should set level to 0 after it flashes', () => {
    let initial = [[9]];
    let expected = [[0]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should increase adjacent energy levels of a flashing octopus', () => {
    let initial = [[1, 1, 1], [1, 9, 1], [1, 1, 1]];
    let expected = [[3, 3, 3], [3, 0, 3], [3, 3, 3]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should increase adjacent energy levels when flashing without touching others', () => {
    let initial = [[1, 1, 1, 1], [1, 9, 1, 1], [1, 1, 1, 1], [1, 1, 1, 1]];
    let expected = [[3, 3, 3, 2], [3, 0, 3, 2], [3, 3, 3, 2], [2, 2, 2, 2]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should handle multiple flashing octopuses', () => {
    let initial = [[1, 1, 1, 1], [1, 9, 9, 1], [1, 1, 1, 1], [1, 1, 1, 1]];
    let expected = [[3, 4, 4, 3], [3, 0, 0, 3], [3, 4, 4, 3], [2, 2, 2, 2]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should handle the first step of the complex example', () => {
    let initial = [[1, 1, 1, 1, 1], [1, 9, 9, 9, 1], [1, 9, 1, 9, 1], [1, 9, 9, 9, 1], [1, 1, 1, 1, 1]];
    let expected = [[3, 4, 5, 4, 3], [4, 0, 0, 0, 4], [5, 0, 0, 0, 5], [4, 0, 0, 0, 4], [3, 4, 5, 4, 3]];
    let actual = day.advanceSteps(initial, 1);

    expect(actual).toEqual(expected);
  });

  it('should handle the second step of the complex example', () => {
    let initial = [[1, 1, 1, 1, 1], [1, 9, 9, 9, 1], [1, 9, 1, 9, 1], [1, 9, 9, 9, 1], [1, 1, 1, 1, 1]];
    let expected = [[4, 5, 6, 5, 4], [5, 1, 1, 1, 5], [6, 1, 1, 1, 6], [5, 1, 1, 1, 5], [4, 5, 6, 5, 4]];
    let actual = day.advanceSteps(initial, 2);

    expect(actual).toEqual(expected);
  });
});