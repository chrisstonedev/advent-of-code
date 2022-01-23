import {Day} from './program';

export class Day09 implements Day {
    dayNumber = 9;

    partOneTestAnswer = 15;
    partTwoTestAnswer = 1134;

    executePartOne(input: string[]): number {
        let heightMap = new HeightMap(input);
        let lowPoints = [];
        for (let row = 0; row < heightMap.rowCount; row++) {
            for (let column = 0; column < heightMap.columnCount; column++) {
                if ((row === 0 || heightMap.getValue(row, column) < heightMap.getValue(row - 1, column))
                    && (column === 0 || heightMap.getValue(row, column) < heightMap.getValue(row, column - 1))
                    && (row === heightMap.rowCount - 1 || heightMap.getValue(row, column) < heightMap.getValue(row + 1, column))
                    && (column === heightMap.columnCount - 1 || heightMap.getValue(row, column) < heightMap.getValue(row, column + 1))) {
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
        for (let row = 0; row < heightMap.rowCount; row++) {
            for (let column = 0; column < heightMap.columnCount; column++) {
                if (heightMap.getValue(row, column) !== 9 && basins.find(x => x.containsItem(row, column)) === undefined) {
                    let itemsInThisBasin = Day09.addLocationAndAdjacentLocationsToArray(heightMap, row, column, []);
                    basins.push(new Basin(itemsInThisBasin));
                }
            }
        }

        return basins.map(x => x.size).sort((a, b) => b - a).slice(0, 3).reduce((a, b) => a * b);
    }

    private static addLocationAndAdjacentLocationsToArray(
        heightMap: HeightMap,
        row: number,
        column: number,
        workingArray: Location[]
    ): Location[] {

        workingArray.push({row: row, column: column});

        function checkLocationAndAddIfAppropriate(row: number, column: number,) {
            heightMap.getValue(row, column) !== 9
            && !locationExistsInArray(workingArray, row, column)
            && Day09.addLocationAndAdjacentLocationsToArray(heightMap, row, column, workingArray);
        }

        row > 0 && checkLocationAndAddIfAppropriate(row - 1, column);
        column > 0 && checkLocationAndAddIfAppropriate(row, column - 1);
        row < heightMap.rowCount - 1 && checkLocationAndAddIfAppropriate(row + 1, column);
        column < heightMap.columnCount - 1 && checkLocationAndAddIfAppropriate(row, column + 1);

        return workingArray;
    }
}

function locationExistsInArray(basinItemArray: Location[], row: number, column: number) {
    return basinItemArray.find(x => x.row === row && x.column === column) !== undefined;
}

class HeightMap {
    private readonly values: number[][];

    constructor(fileContents: string[]) {
        this.values = fileContents.map(x => x.split('').map(y => +y));
    }

    get rowCount(): number {
        return this.values.length;
    }

    get columnCount(): number {
        return this.values[0].length;
    }

    getValue(row: number, column: number): number {
        return this.values[row][column];
    }
}

class Basin {
    private readonly locations: Location[] = [];

    constructor(items: Location[]) {
        this.locations = items;
    }

    get size(): number {
        return this.locations.length;
    }

    containsItem(row: number, column: number): boolean {
        return locationExistsInArray(this.locations, row, column);
    }
}

interface Location {
    row: number;
    column: number;
}
