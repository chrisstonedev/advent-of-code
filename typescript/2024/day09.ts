import { Day } from "../program";

export class Day09 implements Day {
  partOneTestAnswer = 1928;
  partTwoTestAnswer = 2858;

  executePartOne(input: string[]): number {
    return input
      .map(this.expandInput)
      .map(this.moveBlocks)
      .map(this.calculateChecksum)[0];
  }

  executePartTwo(input: string[]): number {
    return input
      .map(this.expandInput)
      .map(this.moveContiguousBlocks)
      .map(this.calculateChecksum)[0];
  }

  expandInput(input: string) {
    let currentId = 0;
    let display = true;
    const output: (number | null)[] = [];
    for (const thing of input.split("").map(Number)) {
      if (display) {
        for (let i = 0; i < thing; i++) {
          output.push(currentId);
        }
        currentId++;
      } else {
        for (let i = 0; i < thing; i++) {
          output.push(null);
        }
      }
      display = !display;
    }
    return output;
  }

  moveBlocks(input: (number | null)[]): number[] {
    while (input.includes(null)) {
      input[input.indexOf(null)] = input[input.length - 1];
      input = input.slice(0, input.lastIndexOf(null, 1));
    }
    return input as number[];
  }

  moveContiguousBlocks(input: (number | null)[]) {
    let lastValue: number = input[input.length - 1] as number;
    while (
      lastValue > 0 ||
      !input.slice(0, input.indexOf(lastValue)).includes(null)
    ) {
      const countOfBlocks = input.filter((x) => x === lastValue).length;
      let counter = 0;
      for (let i = input.indexOf(null); i < input.indexOf(lastValue); i++) {
        if (input[i] === null) {
          counter++;
        } else {
          counter = 0;
        }
        if (counter === countOfBlocks) {
          const newStuff = input.map((x) => (x === lastValue ? null : x));
          input = [
            ...newStuff.slice(0, i - countOfBlocks + 1),
            ...Array(countOfBlocks).fill(lastValue),
            ...newStuff.slice(i + 1),
          ];
        }
      }
      lastValue--;
    }
    while (input[input.length - 1] === null) {
      input = input.slice(0, input.length - 1);
    }
    return input;
  }

  calculateChecksum(input: (number | null)[]) {
    let answer = 0;
    for (let i = 0; i < input.length; i++) {
      if (input[i] !== null) {
        answer += i * input[i]!;
      }
    }
    return answer;
  }
}
