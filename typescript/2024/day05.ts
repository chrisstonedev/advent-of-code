import { Day } from "../program";

export class Day05 implements Day {
  partOneTestAnswer = 143;
  partTwoTestAnswer = 123;

  executePartOne(input: string[]): number {
    const first = input.slice(0, input.indexOf(""));
    const second = input.slice(input.indexOf("") + 1);
    let sum = 0;
    for (const thing of second) {
      const p0 = thing.split(",");
      const hey = this.doSomething(first, p0);
      // console.log(hey ? "true" : "false");
      if (hey) {
        // console.log(p0[p0.length / 2], p0, p0.length, int(p0.length / 2));
        sum += Number(p0[Math.floor(p0.length / 2)]);
      }
    }
    return sum;
  }

  executePartTwo(input: string[]): number {
    const first = input.slice(0, input.indexOf(""));
    const second = input.slice(input.indexOf("") + 1);
    let sum = 0;
    for (const thing of second) {
      const p0 = thing.split(",");
      const hey = this.doSomething(first, p0);
      // console.log(hey ? "true" : "false");
      if (!hey) {
        const correctOrder = this.getCorrectOrder(first, p0);
        sum += Number(correctOrder[Math.floor(correctOrder.length / 2)]);
        // console.log(sum, correctOrder);
      }
    }
    return sum;
  }

  doSomething(first: string[], p0: string[]) {
    // const newThing = first.map((x) => {
    //   const parts = x.split("|");
    //   return { s1: parts[0], s2: parts[1] };
    // });
    for (let i = 1; i < p0.length; i++) {
      if (!first.includes(`${p0[i - 1]}|${p0[i]}`)) {
        return false;
      }
    }
    return true;
  }

  getCorrectOrder(allDirectionedThings: string[], currentOrder: string[]) {
    /*
    Look for correct order.
    If you ever find a pair that is wrong, flip them, and start from the beginning to try again.
     */

    let success = false;
    let newAttempt = [...currentOrder];
    while (!success) {
      success = true;
      for (let i = 1; i < newAttempt.length; i++) {
        if (
          !allDirectionedThings.includes(
            `${newAttempt[i - 1]}|${newAttempt[i]}`,
          )
        ) {
          newAttempt = [
            ...newAttempt.slice(0, i - 1),
            newAttempt[i],
            newAttempt[i - 1],
            ...newAttempt.slice(i + 1),
          ];
          success = false;
          // console.log("successfalse");
          break;
        }
      }
    }
    return newAttempt;
  }
}
