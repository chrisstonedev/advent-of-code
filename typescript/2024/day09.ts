import { Day } from "../program";

export class Day09 implements Day {
  partOneTestAnswer = 1928;
  partTwoTestAnswer = 11387;
  inProgress = true;

  executePartOne(input: string[]): number {
    console.log("hi1");
    console.log(input[0]);
    // return input
    //   .map(this.expandInput)
    //   .map(this.moveBlocks)
    //   .map(this.calculateChecksum)[0];
    const a = input.map(this.expandInput);
    console.log("hi2");
    console.log(a[0]);
    const b = a.map(this.moveBlocks);
    console.log("hi3");
    console.log(b[0]);
    const c = b.map(this.calculateChecksum);
    return c[0];
  }

  executePartTwo(input: string[]): number {
    return input.length;
  }

  expandInput(input: string) {
    let currentId = 0;
    let display = true;
    let output = "";
    for (const thing of input.split("").map(Number)) {
      if (display) {
        output += currentId.toString().repeat(thing);
        currentId++;
      } else {
        output += ".".toString().repeat(thing);
      }
      display = !display;
    }
    return output;
  }

  moveBlocks(input: string) {
    let newString = input.replaceAll(".", " ");
    while (newString.includes(" ")) {
      newString = newString
        .replace(" ", newString.charAt(newString.length - 1))
        .slice(0, newString.length - 1)
        .trim();
    }
    return newString;
  }

  calculateChecksum(input: string) {
    const numbers = input.split("").map(Number);
    let answer = 0;
    for (let i = 0; i < numbers.length; i++) {
      answer += i * numbers[i];
    }
    return answer;
  }
}
