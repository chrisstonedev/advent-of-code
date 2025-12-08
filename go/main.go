package main

import (
	"fmt"

	"github.com/chrisstonedev/advent-of-code/go/aoc2020"
	"github.com/chrisstonedev/advent-of-code/go/aoc2022"
	"github.com/chrisstonedev/advent-of-code/go/utils"
)

func main() {
	fmt.Printf("\t\t== 2020 Answers ==\n")
	printAnswer("2020_01", aoc2020.Part1, aoc2020.Part2)

	fmt.Printf("\t\t== 2022 Answers ==\n")
	printAnswer("2022_01", aoc2022.Part1, aoc2022.Part2)
}

func printAnswer(fileNameDate string, function1 func(input string) int, function2 func(input string) int) {
	fmt.Printf("\t= %s =\n", fileNameDate)
	input := utils.ReadFileIntoStringWithDepth(fileNameDate, "input", 1)
	fmt.Printf("Part 1: %d\n", function1(input))
	fmt.Printf("Part 2: %d\n", function2(input))
}
