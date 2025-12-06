package aoc2025

import (
	"fmt"
	"strconv"
	"strings"
)

type Instruction struct {
	Operator   string
	StartIndex int
	EndIndex   int
}

func Day06Part1(input string) int {
	allLines := strings.Split(input, "\n")
	numbers := allLines[:len(allLines)-1]
	operators := allLines[len(allLines)-1]
	instructions := getInstructions(operators)
	value := 0
	for _, instruction := range instructions {
		tempValue := 0
		if instruction.Operator == "*" {
			tempValue = 1
		}
		for _, numberRow := range numbers {
			var numberAsText string
			if instruction.EndIndex > 0 {
				numberAsText = numberRow[instruction.StartIndex:instruction.EndIndex]
			} else {
				numberAsText = numberRow[instruction.StartIndex:]
			}
			number, err := strconv.Atoi(strings.TrimSpace(numberAsText))
			if err != nil {
				panic(err)
			}
			if instruction.Operator == "+" {
				tempValue += number
			} else if instruction.Operator == "*" {
				tempValue *= number
			}
		}
		value += tempValue
	}
	return value
}

func getInstructions(operators string) []Instruction {
	var instructions []Instruction
	var operator string
	var startIndex int
	for i := 0; i < len(operators); i++ {
		if operators[i] != '+' && operators[i] != '*' {
			continue
		}
		if operator != "" {
			instructions = append(instructions, Instruction{Operator: operator, StartIndex: startIndex, EndIndex: i})
		}
		if operators[i] == '+' {
			operator = "+"
			startIndex = i
		} else if operators[i] == '*' {
			operator = "*"
			startIndex = i
		}
		if i == len(operators)-1 {
			instructions = append(instructions, Instruction{Operator: operator, StartIndex: startIndex, EndIndex: -1})
		}
	}
	return instructions
}

func Day06Part2(input string) int {
	allLines := strings.Split(input, "\n")
	numbers := allLines[:len(allLines)-1]
	fmt.Println(numbers)
	operators := allLines[len(allLines)-1]
	instructions := getInstructions(operators)
	value := 0
	numbers = addSpacesToNumberRows(numbers)
	for _, instruction := range instructions {
		tempValue := 0
		if instruction.Operator == "*" {
			tempValue = 1
		}
		lastIndex := instruction.EndIndex
		if instruction.EndIndex == -1 {
			lastIndex = len(numbers[0])
		}
		for i := instruction.StartIndex; i < lastIndex; i++ {
			var numberAsText string
			for _, numberRow := range numbers {
				numberAsText += string(numberRow[i])
			}
			numberAsText = strings.TrimSpace(numberAsText)
			if numberAsText == "" {
				continue
			}
			number, err := strconv.Atoi(numberAsText)
			if err != nil {
				panic(err)
			}
			if instruction.Operator == "+" {
				tempValue += number
			} else if instruction.Operator == "*" {
				tempValue *= number
			}
		}
		value += tempValue
	}
	return value
}

func addSpacesToNumberRows(numbers []string) []string {
	var maxLength int
	for _, numberRow := range numbers {
		if len(numberRow) > maxLength {
			maxLength = len(numberRow)
		}
	}
	for i := range numbers {
		numbers[i] = fmt.Sprintf("%-*s", maxLength, numbers[i])
	}
	return numbers
}
