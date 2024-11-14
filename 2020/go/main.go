package main

import (
	"fmt"
	"os"
)

func main() {
	data, _ := os.ReadFile("../data/input01.txt")
	input := string(data)
	part1 := part1(input)
	fmt.Printf("Part 1: %d\n", part1)
	part2 := part2(input)
	fmt.Printf("Part 2: %d\n", part2)
}
