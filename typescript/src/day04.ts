import {Utils} from './utils';

function setUpGameEnvironment(input: string[]) {
    let workingInput = Array.from(input);
    let numbersToDraw = workingInput.shift().split(',').map(x => +x);

    let gameBoards = [];
    for (let i = 0; i < Math.floor(workingInput.length / 6); i++) {
        gameBoards.push(createGameBoard(workingInput.slice(i * 6 + 1, (i + 1) * 6)));
    }
    return {gameBoards, numbersToDraw};
}

function createGameBoard(gameBoardLineStrings: string[]): number[] {
    let numberArrays = [];
    for (let i = 0; i < 5; i++) {
        let numbersInRowAsStrings = gameBoardLineStrings[i].trim().split(/[ ]+/);
        let numbersInRow = numbersInRowAsStrings.map(x => +(x.trim()));
        numberArrays.push(numbersInRow);
    }
    return numberArrays;
}

function didGameBoardWin(gameBoard: number[], numbersDrawn: number[]): boolean {
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

function getUncalledNumbersSum(gameBoard: number[], numbersDrawn: number[]): number {
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

function part1(input: string[]): number {
    let {gameBoards, numbersToDraw} = setUpGameEnvironment(input);

    for (let i = 5; i < numbersToDraw.length; i++) {
        let numbersDrawn = numbersToDraw.slice(0, i);

        for (let gameBoard of gameBoards) {
            if (didGameBoardWin(gameBoard, numbersDrawn)) {
                let uncalledNumbersSum = getUncalledNumbersSum(gameBoard, numbersDrawn);
                let numberThatWasJustCalled = numbersToDraw[i - 1];
                return uncalledNumbersSum * numberThatWasJustCalled;
            }
        }
    }

    return 0;
}

function part2(input: string[]): number {
    let {gameBoards, numbersToDraw} = setUpGameEnvironment(input);

    for (let i = numbersToDraw.length; i >= 5; i--) {
        let numbersDrawn = numbersToDraw.slice(0, i);

        for (let gameBoard of gameBoards) {
            if (!didGameBoardWin(gameBoard, numbersDrawn)) {
                let numbersNeededToBeDrawnForThisBoardToWin = numbersToDraw.slice(0, i + 1);
                let uncalledNumbersSum = getUncalledNumbersSum(gameBoard, numbersNeededToBeDrawnForThisBoardToWin);
                let numberToBeCalledThatWillResultInAWin = numbersToDraw[i];
                return uncalledNumbersSum * numberToBeCalledThatWillResultInAWin;
            }
        }
    }

    return 0;
}

let testInput = Utils.readInput('Day04_test');
let input = Utils.readInput('Day04');

console.assert(part1(testInput) === 4512);
console.log(part1(input));

console.assert(part2(testInput) === 1924);
console.log(part2(input));
