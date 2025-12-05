package aoc2025

import (
	"strings"
)

func Day04Part1(input string) int {
	allStrings := strings.Split(input, "\n")
	value := 0
	for row := range allStrings {
		for col := range allStrings[0] {
			if allStrings[row][col] != '@' {
				continue
			}
			neighbors := calculateNeighbors(allStrings, row, col)
			if neighbors < 4 {
				value++
			}
		}
	}
	return value
}

func calculateNeighbors(allStrings []string, row int, col int) int {
	neighbors := 0
	if row > 0 && col > 0 && allStrings[row-1][col-1] == '@' {
		neighbors++
	}
	if row > 0 && allStrings[row-1][col] == '@' {
		neighbors++
	}
	if row > 0 && col < len(allStrings)-1 && allStrings[row-1][col+1] == '@' {
		neighbors++
	}
	if col < len(allStrings)-1 && allStrings[row][col+1] == '@' {
		neighbors++
	}
	if row < len(allStrings)-1 && col < len(allStrings)-1 && allStrings[row+1][col+1] == '@' {
		neighbors++
	}
	if row < len(allStrings)-1 && allStrings[row+1][col] == '@' {
		neighbors++
	}
	if row < len(allStrings)-1 && col > 0 && allStrings[row+1][col-1] == '@' {
		neighbors++
	}
	if col > 0 && allStrings[row][col-1] == '@' {
		neighbors++
	}
	return neighbors
}

func Day04Part2(input string) int {
	allStrings := strings.Split(input, "\n")
	value := 0
	for {
		var newBoard []string
		changes := 0
		for row := range allStrings {
			var newLetters []rune
			for col := range allStrings[0] {
				if allStrings[row][col] != '@' {
					newLetters = append(newLetters, '.')
					continue
				}
				neighbors := calculateNeighbors(allStrings, row, col)
				if neighbors < 4 {
					newLetters = append(newLetters, '.')
					value++
					changes++
				} else {
					newLetters = append(newLetters, '@')
				}
			}
			newBoard = append(newBoard, string(newLetters))
		}
		if changes == 0 {
			break
		}
		allStrings = newBoard
	}
	return value
}
