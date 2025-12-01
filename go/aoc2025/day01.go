package aoc2025

import (
	"strconv"
	"strings"
)

func Part1(input string) int {
	timesItGotToZero := 0
	value := 50
	for _, instruction := range strings.Split(input, "\n") {
		amount := mustParseInstructionAmount(instruction)
		value = value + amount
		for value < 0 {
			value = 100 + value
		}
		for value > 99 {
			value = value - 100
		}
		if value == 0 {
			timesItGotToZero++
		}
	}
	return timesItGotToZero
}

func Part2(input string) int {
	timesItGotToZero := 0
	value := 50
	for _, instruction := range strings.Split(input, "\n") {
		amount := mustParseInstructionAmount(instruction)
		if amount < 0 && value == 0 {
			value = 100
		}
		value = value + amount
		for value < 0 {
			value = 100 + value
			timesItGotToZero++
		}
		if value == 0 {
			timesItGotToZero++
		}
		for value > 99 {
			value = value - 100
			timesItGotToZero++
		}
	}
	return timesItGotToZero
}

func mustParseInstructionAmount(instruction string) int {
	amount, err := strconv.Atoi(instruction[1:])
	if err != nil {
		panic("unable to parse what was expected to be a number")
	}
	if strings.HasPrefix(instruction, "L") {
		return amount * -1
	}
	if strings.HasPrefix(instruction, "R") {
		return amount
	}
	panic("instruction does not contain expected prefix")
}
