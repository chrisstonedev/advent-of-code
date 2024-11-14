package aoc2022

import (
	"sort"
	"strconv"
	"strings"
)

func Part1(input string) int {
	elves := getElves(input)
	return elves[0]
}

func Part2(input string) int {
	elves := getElves(input)
	return elves[0] + elves[1] + elves[2]
}

func getElves(input string) []int {
	var elves []int

	for _, elf := range strings.Split(input, "\n\n") {
		calories := strings.Split(elf, "\n")
		total := 0
		for _, amount := range calories {
			num, _ := strconv.Atoi(strings.TrimSpace(amount))
			total += num
		}
		elves = append(elves, total)
	}

	sort.Sort(sort.Reverse(sort.IntSlice(elves)))
	return elves
}
