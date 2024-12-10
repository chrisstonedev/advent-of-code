import { Day } from "../program";

export class Day08 implements Day {
  partOneTestAnswer = 14;
  partTwoTestAnswer = 34;

  executePartOne(input: string[]): number {
    const data = this.evaluateInput(input);
    const set = this.findAntinodes(data, input.length);
    return set.size;
  }

  executePartTwo(input: string[]): number {
    const data = this.evaluateInput(input);
    const set = this.findResonantAntinodes(data, input.length);
    return set.size;
  }

  evaluateInput(input: string[]) {
    const map = new Map<string, number[][]>();
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        if (input[row][col] !== ".") {
          if (map.has(input[row][col])) {
            map.get(input[row][col])!.push([row, col]);
          } else {
            map.set(input[row][col], [[row, col]]);
          }
        }
      }
    }
    return map;
  }

  findAntinodes(input: Map<string, number[][]>, dataLength: number) {
    const set = new Set<string>();
    const antennaTypes = Array.from(input.keys()).filter(
      (x) => input.get(x)!.length > 1,
    );
    for (const type of antennaTypes) {
      const antennas = input.get(type)!;
      for (let i = 0; i < antennas.length - 1; i++) {
        for (let j = i + 1; j < antennas.length; j++) {
          const [x1, y1] = antennas[i];
          const [x2, y2] = antennas[j];
          const xDelta = x2 - x1;
          const yDelta = y2 - y1;
          const antinode1 = [x1 - xDelta, y1 - yDelta];
          const antinode2 = [x2 + xDelta, y2 + yDelta];
          if (this.isValidAntinode(antinode1, dataLength)) {
            set.add(`${antinode1[0]},${antinode1[1]}`);
          }
          if (this.isValidAntinode(antinode2, dataLength)) {
            set.add(`${antinode2[0]},${antinode2[1]}`);
          }
        }
      }
    }
    return set;
  }

  findResonantAntinodes(input: Map<string, number[][]>, dataLength: number) {
    const set = new Set<string>();
    const antennaTypes = Array.from(input.keys()).filter(
      (x) => input.get(x)!.length > 1,
    );
    for (const type of antennaTypes) {
      const antennas = input.get(type)!;
      antennas
        .map(([x, y]) => `${x},${y}`)
        .forEach((antenna) => set.add(antenna));
      for (let i = 0; i < antennas.length - 1; i++) {
        for (let j = i + 1; j < antennas.length; j++) {
          const [x1, y1] = antennas[i];
          const [x2, y2] = antennas[j];
          const xDelta = x2 - x1;
          const yDelta = y2 - y1;
          for (let mult = 1; ; mult++) {
            const antinode1 = [x1 - xDelta * mult, y1 - yDelta * mult];
            if (this.isValidAntinode(antinode1, dataLength)) {
              set.add(`${antinode1[0]},${antinode1[1]}`);
            } else {
              break;
            }
          }
          for (let mult = 1; ; mult++) {
            const antinode2 = [x2 + xDelta * mult, y2 + yDelta * mult];
            if (this.isValidAntinode(antinode2, dataLength)) {
              set.add(`${antinode2[0]},${antinode2[1]}`);
            } else {
              break;
            }
          }
        }
      }
    }
    return set;
  }

  private isValidAntinode(antinode: number[], dataLength: number) {
    const [x, y] = antinode;
    return x >= 0 && y >= 0 && x < dataLength && y < dataLength;
  }
}
