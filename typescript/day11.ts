import {Day} from './program';

export class Day11 implements Day {
  dayNumber = 11;

  partOneTestAnswer = 1656;
  partTwoTestAnswer = 195;

  executePartOne(input: string[]): number {
    let energyLevelGrid = input.map(x => x.split('').map(y => +y));
    let result = this.advanceSteps(energyLevelGrid, 100);
    return result.totalFlashes;
  }

  executePartTwo(input: string[]): number {
    let energyLevelGrid = input.map(x => x.split('').map(y => +y));
    return Day11.advanceStepsUntilSynchronization(energyLevelGrid);
  }

  private static advanceOneStep(initialGrid: number[][]) {
    let newGrid = initialGrid.map(x => x.map(y => y + 1));
    let flashes = 0;

    while (newGrid.flat().filter(x => x > 9).length > 0) {
      for (let row = 0; row < newGrid.length; row++) {
        for (let col = 0; col < newGrid.length; col++) {
          if (newGrid[row][col] > 9) {
            flashes++;
            newGrid[row][col] = -9999;
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
    }
    newGrid = newGrid.map(x => x.map(y => y < 0 ? 0 : y));
    return {flashes, energyLevelGrid: newGrid};
  }

  public advanceSteps(energyLevelGrid: number[][], steps: number) {
    let totalFlashes = 0;
    for (let step = 0; step < steps; step++) {
      let result = Day11.advanceOneStep(energyLevelGrid);
      totalFlashes += result.flashes;
      energyLevelGrid = result.energyLevelGrid;
    }
    return {totalFlashes, energyLevelGrid};
  }

  private static advanceStepsUntilSynchronization(energyLevelGrid: number[][]) {
    let totalSteps = 0;
    while (energyLevelGrid.flat().filter(x => x !== 0).length > 0) {
      energyLevelGrid = Day11.advanceOneStep(energyLevelGrid).energyLevelGrid;
      totalSteps++;
    }
    return totalSteps;
  }
}
