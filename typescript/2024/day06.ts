import { Day } from "../program";

type State = "empty" | "visited" | "block";

const rowColShifts = [
  [-1, 0],
  [0, 1],
  [1, 0],
  [0, -1],
];

export class Day06 implements Day {
  partOneTestAnswer = 41;
  partTwoTestAnswer = 6;

  executePartOne(input: string[]): number {
    const originalGameBoard = this.generateInitialGameBoard(input);
    this.findAllPositionsToExitOnOriginalBoard(
      originalGameBoard,
      input.length,
      input[0].length,
    );
    return originalGameBoard.filter((x) => x.state === "visited").length;
  }

  executePartTwo(input: string[]): number {
    const originalGameBoard = this.generateInitialGameBoard(input);
    const startingPosition: { row: number; col: number } =
      originalGameBoard.find((x) => x.state === "visited")!;
    this.findAllPositionsToExitOnOriginalBoard(
      originalGameBoard,
      input.length,
      input[0].length,
    );

    const allPossibleObstructionSpots = originalGameBoard
      .filter(
        (x) =>
          x.state === "visited" &&
          `${x.row}${x.col}` !==
            `${startingPosition.row}${startingPosition.col}`,
      )
      .map((x) => ({ row: x.row, col: x.col }));
    // console.log(allPossibleObstructionSpots);
    let counter = 0;
    allPossibleObstructionSpots.forEach((potentialPosition) => {
      // console.log(debugCounter, counter);
      const tempGameBoard = this.generateInitialGameBoardPlus(input);
      tempGameBoard.find(
        (x) =>
          x.row === potentialPosition.row && x.col === potentialPosition.col,
      )!.state = "block";
      let currentShift = 0;
      let currentPosition = startingPosition;
      let loopDetected = false;
      while (
        currentPosition.row !== 0 &&
        currentPosition.row !== input.length - 1 &&
        currentPosition.col !== 0 &&
        currentPosition.col !== input[0].length - 1 &&
        !loopDetected
      ) {
        const [rowShift, colShift] = rowColShifts[currentShift];
        const potentialPosition = {
          row: currentPosition.row + rowShift,
          col: currentPosition.col + colShift,
        };
        const currentStateOfProspectiveSpot = tempGameBoard.find(
          (x) =>
            x.row === potentialPosition.row && x.col === potentialPosition.col,
        )!;
        switch (currentStateOfProspectiveSpot.state) {
          case "empty": {
            currentPosition = { ...potentialPosition };
            const newPiece = tempGameBoard.find(
              (x) =>
                x.row === currentPosition.row && x.col === currentPosition.col,
            )!;
            newPiece.state = "visited";
            newPiece.direction = currentShift;
            break;
          }
          case "visited":
            if (currentStateOfProspectiveSpot.direction === currentShift) {
              loopDetected = true;
              break;
            } else {
              currentPosition = { ...potentialPosition };
              const newPiece = tempGameBoard.find(
                (x) =>
                  x.row === currentPosition.row &&
                  x.col === currentPosition.col,
              )!;
              newPiece.state = "visited";
              newPiece.direction = currentShift;
            }
            break;
          case "block":
            currentShift++;
            currentShift %= 4;
            break;
        }
      }
      if (loopDetected) {
        counter++;
      }
    });
    return counter;
  }

  private findAllPositionsToExitOnOriginalBoard(
    originalGameBoard: { row: number; col: number; state: State }[],
    rows: number,
    cols: number,
  ) {
    const startingPosition = originalGameBoard.find(
      (x) => x.state === "visited",
    )!;
    let currentPosition = {
      row: startingPosition.row,
      col: startingPosition.col,
    };
    let currentShift = 0;
    while (
      currentPosition.row !== 0 &&
      currentPosition.row !== rows - 1 &&
      currentPosition.col !== 0 &&
      currentPosition.col !== cols - 1
    ) {
      const [rowShift, colShift] = rowColShifts[currentShift];
      const potentialPosition = {
        row: currentPosition.row + rowShift,
        col: currentPosition.col + colShift,
      };
      const currentStateOfProspectiveSpot = originalGameBoard.find(
        (x) =>
          x.row === potentialPosition.row && x.col === potentialPosition.col,
      )!.state;
      switch (currentStateOfProspectiveSpot) {
        case "empty":
        case "visited":
          currentPosition = { ...potentialPosition };
          originalGameBoard.find(
            (x) =>
              x.row === currentPosition.row && x.col === currentPosition.col,
          )!.state = "visited";
          break;
        case "block":
          currentShift++;
          currentShift %= 4;
          break;
      }
    }
    return originalGameBoard;
  }

  private generateInitialGameBoard(input: string[]) {
    const gameBoard: { row: number; col: number; state: State }[] = [];
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        const currentValue = input[row][col];
        gameBoard.push({
          row: row,
          col: col,
          state:
            currentValue === "."
              ? "empty"
              : currentValue === "^"
                ? "visited"
                : "block",
        });
      }
    }
    return gameBoard;
  }

  private generateInitialGameBoardPlus(input: string[]) {
    const gameBoard: {
      row: number;
      col: number;
      state: State;
      direction?: number;
    }[] = [];
    for (let row = 0; row < input.length; row++) {
      for (let col = 0; col < input[row].length; col++) {
        const currentValue = input[row][col];
        gameBoard.push({
          row: row,
          col: col,
          state:
            currentValue === "."
              ? "empty"
              : currentValue === "^"
                ? "visited"
                : "block",
          direction: currentValue === "visited" ? 0 : undefined,
        });
      }
    }
    return gameBoard;
  }
}
