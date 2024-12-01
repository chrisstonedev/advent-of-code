import {Day} from '../program';

export class Day02 implements Day {
    dayNumber = 2;

    partOneTestAnswer = 150;
    partTwoTestAnswer = 900;

    executePartOne(input: string[]): number {
        let operations = input.map(x => {
            let splitString = x.split(' ');
            let direction: string = splitString[0];
            let amount: number = +splitString[1];
            return {direction, amount} as Operation;
        });
        let horizontalPosition = Day02.getSumOfValues(operations, "forward");
        let down = Day02.getSumOfValues(operations, "down");
        let up = Day02.getSumOfValues(operations, "up");
        let depth = down - up;
        return horizontalPosition * depth;
    }

    executePartTwo(input: string[]): number {
        let operations = input.map(x => {
            let splitString = x.split(' ');
            let direction: string = splitString[0];
            let amount: number = +splitString[1];
            return {direction, amount} as Operation;
        });
        let horizontalPosition = 0
        let depth = 0
        let aim = 0
        for (let operation of operations) {
            switch (operation.direction) {
                case "forward":
                    horizontalPosition += operation.amount;
                    depth += aim * operation.amount;
                    break;
                case "down":
                    aim += operation.amount;
                    break;
                case "up":
                    aim -= operation.amount;
                    break;
            }
        }
        return horizontalPosition * depth;
    }

    private static getSumOfValues(operations: Operation[], direction: string): number {
        return operations.filter(x => x.direction === direction)
            .map(x => x.amount)
            .reduce((a, b) => a + b, 0);
    }
}

interface Operation {
    direction: string;
    amount: number
}
