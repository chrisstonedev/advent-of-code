import { Day } from '../program';

export class Day02 implements Day {
  partOneTestAnswer = 150;
  partTwoTestAnswer = 900;

  executePartOne(input: string[]): number {
    const operations = input.map((x) => {
      const splitString = x.split(' ');
      const direction: string = splitString[0];
      const amount: number = +splitString[1];
      return { direction, amount } as Operation;
    });
    const horizontalPosition = Day02.getSumOfValues(operations, 'forward');
    const down = Day02.getSumOfValues(operations, 'down');
    const up = Day02.getSumOfValues(operations, 'up');
    const depth = down - up;
    return horizontalPosition * depth;
  }

  executePartTwo(input: string[]): number {
    const operations = input.map((x) => {
      const splitString = x.split(' ');
      const direction: string = splitString[0];
      const amount: number = +splitString[1];
      return { direction, amount } as Operation;
    });
    let horizontalPosition = 0;
    let depth = 0;
    let aim = 0;
    for (const operation of operations) {
      switch (operation.direction) {
        case 'forward':
          horizontalPosition += operation.amount;
          depth += aim * operation.amount;
          break;
        case 'down':
          aim += operation.amount;
          break;
        case 'up':
          aim -= operation.amount;
          break;
      }
    }
    return horizontalPosition * depth;
  }

  private static getSumOfValues(
    operations: Operation[],
    direction: string,
  ): number {
    return operations
      .filter((x) => x.direction === direction)
      .map((x) => x.amount)
      .reduce((a, b) => a + b, 0);
  }
}

interface Operation {
  direction: string;
  amount: number;
}
