import { Day } from "../program";

export class Day05 implements Day {
  partOneTestAnswer = 143;
  partTwoTestAnswer = 123;

  executePartOne(input: string[]): number {
    const pageOrderingRules = input.slice(0, input.indexOf(""));
    const pagesToProduceInEachUpdate = input.slice(input.indexOf("") + 1);
    let sumOfMiddlePageFromUpdates = 0;
    for (const pagesToProduceInUpdate of pagesToProduceInEachUpdate) {
      const pages = pagesToProduceInUpdate.split(",");
      if (this.isInCorrectOrder(pageOrderingRules, pages)) {
        sumOfMiddlePageFromUpdates += Number(
          pages[Math.floor(pages.length / 2)],
        );
      }
    }
    return sumOfMiddlePageFromUpdates;
  }

  executePartTwo(input: string[]): number {
    const pageOrderingRules = input.slice(0, input.indexOf(""));
    const pagesToProduceInEachUpdate = input.slice(input.indexOf("") + 1);
    let sumOfMiddlePagesFromUpdates = 0;
    for (const pagesToProduceInUpdate of pagesToProduceInEachUpdate) {
      const pages = pagesToProduceInUpdate.split(",");
      if (!this.isInCorrectOrder(pageOrderingRules, pages)) {
        const correctOrder = this.getCorrectOrder(pageOrderingRules, pages);
        sumOfMiddlePagesFromUpdates += Number(
          correctOrder[Math.floor(correctOrder.length / 2)],
        );
      }
    }
    return sumOfMiddlePagesFromUpdates;
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
