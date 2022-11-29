import {Day} from './program';

export class Day04 implements Day {
    dayNumber = 4;

    partOneTestAnswer = 4512;
    partTwoTestAnswer = 1924;

    executePartOne(input: string[]): number {
        let {gameBoards, numbersToDraw} = Day04.setUpGameEnvironment(input);

        for (let i = 5; i < numbersToDraw.length; i++) {
            let numbersDrawn = numbersToDraw.slice(0, i);

            for (let gameBoard of gameBoards) {
                if (Day04.didGameBoardWin(gameBoard, numbersDrawn)) {
                    let uncalledNumbersSum = Day04.getUncalledNumbersSum(gameBoard, numbersDrawn);
                    let numberThatWasJustCalled = numbersToDraw[i - 1];
                    return uncalledNumbersSum * numberThatWasJustCalled;
                }
            }
        }

        return 0;
    }

    executePartTwo(input: string[]): number {
        let {gameBoards, numbersToDraw} = Day04.setUpGameEnvironment(input);

        for (let i = numbersToDraw.length; i >= 5; i--) {
            let numbersDrawn = numbersToDraw.slice(0, i);

            for (let gameBoard of gameBoards) {
                if (!Day04.didGameBoardWin(gameBoard, numbersDrawn)) {
                    let numbersNeededToBeDrawnForThisBoardToWin = numbersToDraw.slice(0, i + 1);
                    let uncalledNumbersSum = Day04.getUncalledNumbersSum(gameBoard, numbersNeededToBeDrawnForThisBoardToWin);
                    let numberToBeCalledThatWillResultInAWin = numbersToDraw[i];
                    return uncalledNumbersSum * numberToBeCalledThatWillResultInAWin;
                }
            }
        }

        return 0;
    }

    private static setUpGameEnvironment(input: string[]) {
        let workingInput = Array.from(input);
        let numbersToDraw = workingInput.shift()!.split(',').map(x => +x);

        let gameBoards = [];
        for (let i = 0; i < Math.floor(workingInput.length / 6); i++) {
            gameBoards.push(Day04.createGameBoard(workingInput.slice(i * 6 + 1, (i + 1) * 6)));
        }
        return {gameBoards, numbersToDraw};
    }

    private static createGameBoard(gameBoardLineStrings: string[]): number[][] {
        let numberArrays = [];
        for (let i = 0; i < 5; i++) {
            let numbersInRowAsStrings = gameBoardLineStrings[i].trim().split(/[ ]+/);
            let numbersInRow = numbersInRowAsStrings.map(x => +(x.trim()));
            numberArrays.push(numbersInRow);
        }
        return numberArrays;
    }

    private static didGameBoardWin(gameBoard: number[][], numbersDrawn: number[]): boolean {
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

    private static getUncalledNumbersSum(gameBoard: number[][], numbersDrawn: number[]): number {
        let uncalledNumbers = [];
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
