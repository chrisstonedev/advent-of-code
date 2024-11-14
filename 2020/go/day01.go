package main

import (
	"strconv"
	"strings"
)

func convertInputStringToNumberArray(input string) []int {
	var numbers []int
	for _, numberString := range strings.Split(input, "\n") {
		number, _ := strconv.Atoi(numberString)
		numbers = append(numbers, number)
	}
	return numbers
}

func part1(input string) int {
	numbers := convertInputStringToNumberArray(input)
	for i := 0; i < len(numbers); i++ {
		for j := i + 1; j < len(numbers); j++ {
			if numbers[i]+numbers[j] == 2020 {
				return numbers[i] * numbers[j]
			}
		}
	}
	return 0
}

func part2(input string) int {
	numbers := convertInputStringToNumberArray(input)
	for i := 0; i < len(numbers); i++ {
		for j := i + 1; j < len(numbers); j++ {
			for k := j + 1; k < len(numbers); k++ {
				if numbers[i]+numbers[j]+numbers[k] == 2020 {
					return numbers[i] * numbers[j] * numbers[k]
				}
			}
		}
	}
	return 0
}
