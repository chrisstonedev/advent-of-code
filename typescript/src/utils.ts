export class Utils {
    public static readInput(fileName: string): string[] {
        let fs = require('fs');
        return fs.readFileSync(`../data/${fileName}.txt`).toString().split(/\r?\n/);
    }
}
