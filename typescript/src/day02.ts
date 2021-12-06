import {Utils} from "./utils";

class Operation {
    direction: string;
    amount: number
}

function getSumOfValues(operations: Operation[], direction: string): number {
    return operations.filter(x => x.direction === direction)
        .map(x => x.amount)
        .reduce((a, b) => a + b, 0);
}

function part1(input: string[]): number {
    let operations = input.map(x => {
        let splitString = x.split(' ');
        let direction: string = splitString[0];
        let amount: number = +splitString[1];
        return {direction, amount} as Operation;
    });
    let horizontalPosition = getSumOfValues(operations, "forward");
    let down = getSumOfValues(operations, "down");
    let up = getSumOfValues(operations, "up");
    let depth = down - up;
    return horizontalPosition * depth;
}

function part2(input: string[]): number {
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

let testInput = Utils.readInput("Day02_test");
let input = Utils.readInput("Day02");

console.assert(part1(testInput) === 150);
console.log(part1(input));

console.assert(part2(testInput) === 900);
console.log(part2(input));
