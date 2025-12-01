package aoc2025

import (
	"strconv"
	"strings"
)

type PasswordMethod int

const (
	Standard PasswordMethod = iota
	Method0x434C49434B
)

func Part1(input string) int {
	return secretPassword(strings.Split(input, "\n"), Standard)
}

func Part2(input string) int {
	return secretPassword(strings.Split(input, "\n"), Method0x434C49434B)
}

func secretPassword(rotations []string, passwordMethod PasswordMethod) int {
	clicksOnZero := 0
	dialPosition := 50
	for _, instruction := range rotations {
		distance := mustParseRotationDistance(instruction)
		if distance < 0 && dialPosition == 0 {
			dialPosition = 100
		}
		dialPosition += distance
		for dialPosition < 0 {
			dialPosition += 100
			if passwordMethod == Method0x434C49434B {
				clicksOnZero++
			}
		}
		if dialPosition == 0 {
			clicksOnZero++
		}
		for dialPosition > 99 {
			dialPosition -= 100
			if passwordMethod == Method0x434C49434B || dialPosition == 0 {
				clicksOnZero++
			}
		}
	}
	return clicksOnZero
}

func mustParseRotationDistance(instruction string) int {
	distance, err := strconv.Atoi(instruction[1:])
	if err != nil {
		panic("unable to parse what was expected to be a number")
	}
	if strings.HasPrefix(instruction, "L") {
		return distance * -1
	}
	if strings.HasPrefix(instruction, "R") {
		return distance
	}
	panic("instruction does not contain expected prefix")
}
