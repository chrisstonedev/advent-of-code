import { Day } from "../program";

export class Day05 implements Day {
  partOneTestAnswer = 143;
  partTwoTestAnswer = 123;

  executePartOne(input: string[]): number {
    const pageOrderingRules = input.slice(0, input.indexOf(""));
    const pagesToProduceInEachUpdate = input.slice(input.indexOf("") + 1);
    return pagesToProduceInEachUpdate
      .map((pages) => pages.split(","))
      .filter((pages) => this.isInCorrectOrder(pageOrderingRules, pages))
      .map((pages) => Number(pages[Math.floor(pages.length / 2)]))
      .reduce((a, b) => a + b);
  }

  executePartTwo(input: string[]): number {
    const pageOrderingRules = input.slice(0, input.indexOf(""));
    const pagesToProduceInEachUpdate = input.slice(input.indexOf("") + 1);
    return pagesToProduceInEachUpdate
      .map((pages) => pages.split(","))
      .filter((pages) => !this.isInCorrectOrder(pageOrderingRules, pages))
      .map((pages) => this.getCorrectOrder(pageOrderingRules, pages))
      .map((pages) => Number(pages[Math.floor(pages.length / 2)]))
      .reduce((a, b) => a + b);
  }

  isInCorrectOrder(pageOrderingRules: string[], pages: string[]) {
    for (let i = 1; i < pages.length; i++) {
      if (!pageOrderingRules.includes(`${pages[i - 1]}|${pages[i]}`)) {
        return false;
      }
    }
    return true;
  }

  getCorrectOrder(pageOrderingRules: string[], pages: string[]) {
    let currentAttempt = [...pages];
    let thisAttemptIsStillInCorrectOrder = false;
    while (!thisAttemptIsStillInCorrectOrder) {
      thisAttemptIsStillInCorrectOrder = true;
      for (let i = 1; i < currentAttempt.length; i++) {
        if (
          !pageOrderingRules.includes(
            `${currentAttempt[i - 1]}|${currentAttempt[i]}`,
          )
        ) {
          currentAttempt = [
            ...currentAttempt.slice(0, i - 1),
            currentAttempt[i],
            currentAttempt[i - 1],
            ...currentAttempt.slice(i + 1),
          ];
          thisAttemptIsStillInCorrectOrder = false;
          break;
        }
      }
    }
    return currentAttempt;
  }
}
