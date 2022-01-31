import {Day} from './program';

export class Day10 implements Day {
  dayNumber = 10;

  partOneTestAnswer = 26397;
  partTwoTestAnswer = 288957;

  executePartOne(input: string[]): number {
    let numberOfBadCloseParentheses = 0;
    let numberOfBadCloseSquareBrackets = 0;
    let numberOfBadCloseBraces = 0;
    let numberOfBadCloseAngleBrackets = 0;

    for (let line of input) {
      let openSymbols = [];

      for (let character of line.split('')) {
        if (character === '(') {
          openSymbols.push(character);
        } else if (character === '[') {
          openSymbols.push(character);
        } else if (character === '{') {
          openSymbols.push(character);
        } else if (character === '<') {
          openSymbols.push(character);
        } else if (character === ')') {
          if (openSymbols[openSymbols.length - 1] !== '(') {
            numberOfBadCloseParentheses++;
            break;
          }
          openSymbols.pop();
        } else if (character === ']') {
          if (openSymbols[openSymbols.length - 1] !== '[') {
            numberOfBadCloseSquareBrackets++;
            break;
          }
          openSymbols.pop();
        } else if (character === '}') {
          if (openSymbols[openSymbols.length - 1] !== '{') {
            numberOfBadCloseBraces++;
            break;
          }
          openSymbols.pop();
        } else if (character === '>') {
          if (openSymbols[openSymbols.length - 1] !== '<') {
            numberOfBadCloseAngleBrackets++;
            break;
          }
          openSymbols.pop();
        }
      }
    }

    return 3 * numberOfBadCloseParentheses
      + 57 * numberOfBadCloseSquareBrackets
      + 1197 * numberOfBadCloseBraces
      + 25137 * numberOfBadCloseAngleBrackets;
  }

  executePartTwo(input: string[]): number {
    let goodLines = [];

    for (let line of input) {
      let openSymbols = [];
      let corruptedLine = false;

      for (let character of line.split('')) {
        if (character === '(') {
          openSymbols.push(character);
        } else if (character === '[') {
          openSymbols.push(character);
        } else if (character === '{') {
          openSymbols.push(character);
        } else if (character === '<') {
          openSymbols.push(character);
        } else if (character === ')') {
          if (openSymbols[openSymbols.length - 1] !== '(') {
            corruptedLine = true;
            break;
          }
          openSymbols.pop();
        } else if (character === ']') {
          if (openSymbols[openSymbols.length - 1] !== '[') {
            corruptedLine = true;
            break;
          }
          openSymbols.pop();
        } else if (character === '}') {
          if (openSymbols[openSymbols.length - 1] !== '{') {
            corruptedLine = true;
            break;
          }
          openSymbols.pop();
        } else if (character === '>') {
          if (openSymbols[openSymbols.length - 1] !== '<') {
            corruptedLine = true;
            break;
          }
          openSymbols.pop();
        }
      }

      if (!corruptedLine) {
        goodLines.push(line);
      }
    }

    let completionStrings = [];

    for (let line of goodLines) {
      let openSymbols = [];

      for (let character of line.split('')) {
        if (character === '(') {
          openSymbols.push(character);
        } else if (character === '[') {
          openSymbols.push(character);
        } else if (character === '{') {
          openSymbols.push(character);
        } else if (character === '<') {
          openSymbols.push(character);
        } else if (character === ')') {
          openSymbols.pop();
        } else if (character === ']') {
          openSymbols.pop();
        } else if (character === '}') {
          openSymbols.pop();
        } else if (character === '>') {
          openSymbols.pop();
        }
      }

      completionStrings.push(openSymbols);
    }

    let scores = completionStrings.map(x => {
      let score = 0;
      while (x.length > 0) {
        let y = x.pop();
        let characterValue = 0;
        if (y === '(') {
          characterValue = 1;
        } else if (y === '[') {
          characterValue = 2;
        } else if (y === '{') {
          characterValue = 3;
        } else if (y === '<') {
          characterValue = 4;
        }
        score = score * 5 + characterValue;
      }
      return score;
    });
    let orderedScores = scores.sort((a, b) => a - b);
    return orderedScores[((orderedScores.length + 1) / 2) - 1];
  }
}