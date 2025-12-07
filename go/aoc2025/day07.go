package aoc2025

import (
	"fmt"
	"slices"
	"strings"
)

func Day07Part1(input string) int {
	//value := strings.Count(input, "^") - 1
	split := 0
	allLines := strings.Split(input, "\n")
	beamLines := []int{strings.Index(allLines[0], "S")}
	for rowIndex, row := range allLines {
		var newBeamLines []int
		if rowIndex == 0 || strings.Count(row, ".") == len(row) {
			continue
		}
		for col := 0; col < len(row); col++ {
			if slices.Contains(beamLines, col) {
				if row[col] == '^' {
					split++
					newBeamLines = append(newBeamLines, col-1, col+1)
				} else {
					newBeamLines = append(newBeamLines, col)
				}
			}
		}
		beamLines = newBeamLines
	}
	return split
}

var (
	something map[string]int
)

func Day07Part2(input string) int {
	allLines := strings.Split(input, "\n")
	col := strings.Index(allLines[0], "S")
	something = make(map[string]int)
	count := 1 + getCountOfStuff(&allLines, 2, col)
	return count
}

func getCountOfStuff(allLines *[]string, rowIndex, col int) int {
	if rowIndex >= len(*allLines) {
		return 0
	}
	mapKey := fmt.Sprintf("%d,%d", rowIndex, col)
	fmt.Printf("%*s\n", rowIndex, mapKey)
	if val, ok := something[mapKey]; ok {
		return val
	}
	value := 0
	if (*allLines)[rowIndex][col] == '^' {
		value = 1 + getCountOfStuff(allLines, rowIndex+2, col-1) + getCountOfStuff(allLines, rowIndex+2, col+1)
	} else {
		value = getCountOfStuff(allLines, rowIndex+2, col)
	}
	something[mapKey] = value
	return value
}
