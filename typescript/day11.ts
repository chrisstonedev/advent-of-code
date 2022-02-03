import {Day} from './program';

export class Day11 implements Day {
  dayNumber = 11;

  partOneTestAnswer = 1656;
  partTwoTestAnswer = -1;

  executePartOne(input: string[]): number {
    let energyLevelGrid = input.map(x => x.split('').map(y => +y));
    energyLevelGrid = this.advanceSteps(energyLevelGrid, 1);
    return energyLevelGrid.length;
  }

  executePartTwo(input: string[]): number {
    return input.length;
  }

  public advanceSteps(energyLevelGrid: number[][], steps: number) {
    function advanceOneStep(initialGrid: number[][]) {
      let newGrid = initialGrid.map(x => x.map(y => y + 1));
      for (let row = 0; row < newGrid.length; row++) {
        for (let col = 0; col < newGrid.length; col++) {
          if (newGrid[row][col] > 9) {
            row > 0 && col > 0 && newGrid[row - 1][col - 1]++;
            row > 0 && newGrid[row - 1][col]++;
            row > 0 && col < newGrid.length - 1 && newGrid[row - 1][col + 1]++;
            col > 0 && newGrid[row][col - 1]++;
            col < newGrid.length - 1 && newGrid[row][col + 1]++;
            row < newGrid.length - 1 && col > 0 && newGrid[row + 1][col - 1]++;
            row < newGrid.length - 1 && newGrid[row + 1][col]++;
            row < newGrid.length - 1 && col < newGrid.length - 1 && newGrid[row + 1][col + 1]++;
          }
        }
      }
      newGrid = newGrid.map(x => x.map(y => y > 9 ? 0 : y));
      return newGrid;
    }

    for (let step = 0; step < steps; step++) {
      energyLevelGrid = advanceOneStep(energyLevelGrid);
    }
    return energyLevelGrid;
  }
}
