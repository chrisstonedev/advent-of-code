import {Day} from './program';

export class Day09 implements Day {
    dayNumber = 9;

    partOneTestAnswer = 15;
    partTwoTestAnswer = 1134;

    executePartOne(input: string[]): number {
        let heightMap = new HeightMap(input);

        let lowPoints = [];
        for (let row = 0; row < heightMap.rows; row++) {
            for (let column = 0; column < heightMap.columns; column++) {
                if ((row === 0 || heightMap.getValue(row, column) < heightMap.getValue(row - 1, column))
                    && (column === 0 || heightMap.getValue(row, column) < heightMap.getValue(row, column - 1))
                    && (row === heightMap.rows - 1 || heightMap.getValue(row, column) < heightMap.getValue(row + 1, column))
                    && (column === heightMap.columns - 1 || heightMap.getValue(row, column) < heightMap.getValue(row, column + 1))) {
                    lowPoints.push(heightMap.getValue(row, column));
                }
            }
        }

        let riskLevels = lowPoints.map(x => x + 1);
        return riskLevels.reduce(((a, b) => a + b));
    }

    executePartTwo(input: string[]): number {
        let heightMap = new HeightMap(input);
        let basins: Basin[] = [];
        for (let row = 0; row < heightMap.rows; row++) {
            for (let column = 0; column < heightMap.columns; column++) {
                if (heightMap.getValue(row, column) !== 9 && !Day09.itemExistsInCollection(basins.map(x => x.items).flat(), row, column)) {
                    let itemsInThisBasin = Day09.lookForAdjacentItems(heightMap, row, column, []);
                    basins.push(new Basin(itemsInThisBasin));
                }
            }
        }

        return basins.map(x => x.items.length).sort((a, b) => b - a).slice(0, 3).reduce((a, b) => a * b);
    }

    private static lookForAdjacentItems(heightMap: HeightMap, row: number, column: number, workingArray: BasinItem[]): BasinItem[] {
        if (Day09.itemExistsInCollection(workingArray, row, column)) {
            return workingArray;
        }
        workingArray.push({row: row, column: column, value: heightMap.getValue(row, column)});

        if (row !== 0 && heightMap.getValue(row - 1, column) !== 9) {
            Day09.lookForAdjacentItems(heightMap, row - 1, column, workingArray);
        }
        if (column !== 0 && heightMap.getValue(row, column - 1) !== 9) {
            Day09.lookForAdjacentItems(heightMap, row, column - 1, workingArray);
        }
        if (row !== heightMap.rows - 1 && heightMap.getValue(row + 1, column) !== 9) {
            Day09.lookForAdjacentItems(heightMap, row + 1, column, workingArray);
        }
        if (column !== heightMap.columns - 1 && heightMap.getValue(row, column + 1) !== 9) {
            Day09.lookForAdjacentItems(heightMap, row, column + 1, workingArray);
        }
        return workingArray;
    }

    private static itemExistsInCollection(basinItemArray: BasinItem[], row: number, column: number) {
        return basinItemArray.find(x => x.row === row && x.column === column) !== undefined;
    }
}

class HeightMap {
    private readonly board: number[][];

    constructor(thing: string[]) {
        this.board = thing.map(x => x.split('').map(y => +y));
    }

    get rows(): number {
        return this.board.length;
    }

    get columns(): number {
        return this.board[0].length;
    }

    getValue(row: number, column: number): number {
        return this.board[row][column];
    }
}

class Basin {
    private readonly itemCollection: BasinItem[] = [];

    constructor(items: BasinItem[]) {
        this.itemCollection = items;
    }

    get items(): BasinItem[] {
        return this.itemCollection;
    }
}

interface BasinItem {
    row: number;
    column: number;
    value: number;
}
