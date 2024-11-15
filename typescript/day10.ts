import {Day} from './program';

export class Day10 implements Day {
  dayNumber = 10;

  partOneTestAnswer = 26397;
  partTwoTestAnswer = 288957;

  allOpenSymbols = ['(', '[', '{', '<'];
  allCloseSymbols = [')', ']', '}', '>'];

  executePartOne(input: string[]): number {
    let numberOfBadCloseParentheses = 0;
    let numberOfBadCloseSquareBrackets = 0;
    let numberOfBadCloseBraces = 0;
    let numberOfBadCloseAngleBrackets = 0;

    for (let line of input) {
      let openSymbols = [];

      for (let character of line.split('')) {
        if (this.allOpenSymbols.includes(character)) {
          openSymbols.push(character);
        } else if (this.allCloseSymbols.includes(character)) {
          if (character === ')' && openSymbols.pop() !== '(') {
            numberOfBadCloseParentheses++;
            break;
          } else if (character === ']' && openSymbols.pop() !== '[') {
            numberOfBadCloseSquareBrackets++;
            break;
          } else if (character === '}' && openSymbols.pop() !== '{') {
            numberOfBadCloseBraces++;
            break;
          } else if (character === '>' && openSymbols.pop() !== '<') {
            numberOfBadCloseAngleBrackets++;
            break;
          }
        }
      }
    }

    return 3 * numberOfBadCloseParentheses
      + 57 * numberOfBadCloseSquareBrackets
      + 1197 * numberOfBadCloseBraces
      + 25137 * numberOfBadCloseAngleBrackets;
  }

  executePartTwo(input: string[]): number {
    let completionStrings = [];

    for (let line of input) {
      let openSymbols = [];
      let corruptedLine = false;

      for (let character of line.split('')) {
        if (this.allOpenSymbols.includes(character)) {
          openSymbols.push(character);
        } else if (this.allCloseSymbols.includes(character)) {
          if (character === ')' && openSymbols.pop() !== '('
            || character === ']' && openSymbols.pop() !== '['
            || character === '}' && openSymbols.pop() !== '{'
            || character === '>' && openSymbols.pop() !== '<') {
            corruptedLine = true;
            break;
          }
        }
      }

      if (!corruptedLine) {
        completionStrings.push(openSymbols);
      }
    }

    let scores = completionStrings.map(charactersToClose => {
      let score = 0;
      while (charactersToClose.length > 0) {
        let nextCharacterToClose = charactersToClose.pop()!;
        let characterValue = nextCharacterToClose === '(' ? 1 :
          nextCharacterToClose === '[' ? 2 :
            nextCharacterToClose === '{' ? 3 :
              nextCharacterToClose === '<' ? 4 : 0;
        score = score * 5 + characterValue;
      }
      return score;
    }).sort((a, b) => a - b);

    return scores[((scores.length + 1) / 2) - 1];
  }
}
