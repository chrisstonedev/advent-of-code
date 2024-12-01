import { Day } from "../program";

export class Day11 implements Day {
  dayNumber = 11;

  partOneTestAnswer = 1656;
  partTwoTestAnswer = 195;

  executePartOne(input: string[]): number {
    const energyLevelGrid = input.map((x) => x.split("").map((y) => +y));
    const result = this.advanceSteps(energyLevelGrid, 100);
    return result.totalFlashes;
  }

  executePartTwo(input: string[]): number {
    const energyLevelGrid = input.map((x) => x.split("").map((y) => +y));
    return Day11.advanceStepsUntilSynchronization(energyLevelGrid);
  }

  private static advanceOneStep(initialGrid: number[][]) {
    const newGrid = initialGrid.map((x) => x.map((y) => y + 1));

    while (newGrid.flat().filter((x) => x > 9).length > 0) {
      const row = newGrid.findIndex((x) => x.filter((x) => x > 9).length > 0);
      const col = newGrid[row].findIndex((x) => x > 9);
      newGrid[row][col] = -9999;
      if (row > 0 && col > 0) newGrid[row - 1][col - 1]++;
      if (row > 0) newGrid[row - 1][col]++;
      if (row > 0 && col < newGrid.length - 1) newGrid[row - 1][col + 1]++;
      if (col > 0) newGrid[row][col - 1]++;
      if (col < newGrid.length - 1) newGrid[row][col + 1]++;
      if (row < newGrid.length - 1 && col > 0) newGrid[row + 1][col - 1]++;
      if (row < newGrid.length - 1) newGrid[row + 1][col]++;
      if (row < newGrid.length - 1 && col < newGrid.length - 1)
        newGrid[row + 1][col + 1]++;
    }
    return newGrid.map((x) => x.map((y) => (y < 0 ? 0 : y)));
  }

  public advanceSteps(energyLevelGrid: number[][], steps: number) {
    let totalFlashes = 0;
    for (let step = 0; step < steps; step++) {
      energyLevelGrid = Day11.advanceOneStep(energyLevelGrid);
      totalFlashes += energyLevelGrid.flat().filter((x) => x === 0).length;
    }
    return { totalFlashes, energyLevelGrid };
  }

  private static advanceStepsUntilSynchronization(energyLevelGrid: number[][]) {
    let totalSteps = 0;
    while (energyLevelGrid.flat().filter((x) => x !== 0).length > 0) {
      energyLevelGrid = Day11.advanceOneStep(energyLevelGrid);
      totalSteps++;
    }
    return totalSteps;
  }
}
