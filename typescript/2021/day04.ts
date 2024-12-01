import { Day } from "../program";

export class Day04 implements Day {
  partOneTestAnswer = 4512;
  partTwoTestAnswer = 1924;

  executePartOne(input: string[]): number {
    const { gameBoards, numbersToDraw } = Day04.setUpGameEnvironment(input);

    for (let i = 5; i < numbersToDraw.length; i++) {
      const numbersDrawn = numbersToDraw.slice(0, i);

      for (const gameBoard of gameBoards) {
        if (Day04.didGameBoardWin(gameBoard, numbersDrawn)) {
          const uncalledNumbersSum = Day04.getUncalledNumbersSum(
            gameBoard,
            numbersDrawn,
          );
          const numberThatWasJustCalled = numbersToDraw[i - 1];
          return uncalledNumbersSum * numberThatWasJustCalled;
        }
      }
    }

    return 0;
  }

  executePartTwo(input: string[]): number {
    const { gameBoards, numbersToDraw } = Day04.setUpGameEnvironment(input);

    for (let i = numbersToDraw.length; i >= 5; i--) {
      const numbersDrawn = numbersToDraw.slice(0, i);

      for (const gameBoard of gameBoards) {
        if (!Day04.didGameBoardWin(gameBoard, numbersDrawn)) {
          const numbersNeededToBeDrawnForThisBoardToWin = numbersToDraw.slice(
            0,
            i + 1,
          );
          const uncalledNumbersSum = Day04.getUncalledNumbersSum(
            gameBoard,
            numbersNeededToBeDrawnForThisBoardToWin,
          );
          const numberToBeCalledThatWillResultInAWin = numbersToDraw[i];
          return uncalledNumbersSum * numberToBeCalledThatWillResultInAWin;
        }
      }
    }

    return 0;
  }

  private static setUpGameEnvironment(input: string[]) {
    const workingInput = Array.from(input);
    const numbersToDraw = workingInput
      .shift()!
      .split(",")
      .map((x) => +x);

    const gameBoards = [];
    for (let i = 0; i < Math.floor(workingInput.length / 6); i++) {
      gameBoards.push(
        Day04.createGameBoard(workingInput.slice(i * 6 + 1, (i + 1) * 6)),
      );
    }
    return { gameBoards, numbersToDraw };
  }

  private static createGameBoard(gameBoardLineStrings: string[]): number[][] {
    const numberArrays = [];
    for (let i = 0; i < 5; i++) {
      const numbersInRowAsStrings = gameBoardLineStrings[i].trim().split(/ +/);
      const numbersInRow = numbersInRowAsStrings.map((x) => +x.trim());
      numberArrays.push(numbersInRow);
    }
    return numberArrays;
  }

  private static didGameBoardWin(
    gameBoard: number[][],
    numbersDrawn: number[],
  ): boolean {
    for (let row = 0; row < 5; row++) {
      let rowHasBingo = true;
      for (let col = 0; col < 5; col++) {
        if (!numbersDrawn.includes(gameBoard[row][col])) {
          rowHasBingo = false;
          break;
        }
      }
      if (rowHasBingo) {
        return true;
      }
    }
    for (let col = 0; col < 5; col++) {
      let columnHasBingo = true;
      for (let row = 0; row < 5; row++) {
        if (!numbersDrawn.includes(gameBoard[row][col])) {
          columnHasBingo = false;
          break;
        }
      }
      if (columnHasBingo) {
        return true;
      }
    }
    return false;
  }

  private static getUncalledNumbersSum(
    gameBoard: number[][],
    numbersDrawn: number[],
  ): number {
    const uncalledNumbers = [];
    for (let row = 0; row < 5; row++) {
      for (let col = 0; col < 5; col++) {
        if (!numbersDrawn.includes(gameBoard[row][col])) {
          uncalledNumbers.push(gameBoard[row][col]);
        }
      }
    }
    return uncalledNumbers.reduce((a, b) => a + b, 0);
  }
}
