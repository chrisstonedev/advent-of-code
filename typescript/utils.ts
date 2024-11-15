export class Utils {
    static readInput(fileName: string): string[] {
        let fs = require('fs');
        return fs.readFileSync(`../data/${fileName}.txt`).toString().split(/\r?\n/);
    }

    static assertTestAnswer(actual: number, expected: number): boolean {
        console.assert(actual === expected, `expected ${expected} but received ${actual}`);
        return actual === expected;
    }
}
