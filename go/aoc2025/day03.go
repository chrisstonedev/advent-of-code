package aoc2025

import (
	"fmt"
	"log"
	"strconv"
	"strings"
)

func Day03Part1(input string) int {
	allStrings := strings.Split(input, "\n")
	totalOutputJoltage := 0
	for _, thing := range allStrings {
		startNumber := "0"[0]
		endNumber := "0"[0]
		var startNumberIndex int
		for i := len(thing) - 2; i >= 0; i-- {
			if thing[i] >= startNumber {
				startNumber = thing[i]
				startNumberIndex = i
			}
		}
		for i := startNumberIndex + 1; i < len(thing); i++ {
			if thing[i] > endNumber {
				endNumber = thing[i]
			}
		}
		joltage := fmt.Sprintf("%c%c", startNumber, endNumber)
		joltageValue, err := strconv.Atoi(joltage)
		if err != nil {
			log.Panicf("unable to parse %s as number, %v", joltage, err)
		}
		totalOutputJoltage += joltageValue
	}
	return totalOutputJoltage
}

func Day03Part2(input string) int {
	allStrings := strings.Split(input, "\n")
	value := 0
	for _, thing := range allStrings {
		newThing := thing
		for len(newThing) > 12 {
			newThing = highestPossibleJoltageWhenDroppingADigit(newThing)
		}
		b, err := strconv.Atoi(newThing)
		if err != nil {
			log.Panicf("unable to parse %s as number, %v", newThing, err)
		}
		value += b
	}
	return value
}

func highestPossibleJoltageWhenDroppingADigit(currentJoltage string) string {
	largestResultingJoltage := currentJoltage[1:]
	for i := 1; i < len(currentJoltage); i++ {
		testJoltage := currentJoltage[:i] + currentJoltage[i+1:]
		if testJoltage > largestResultingJoltage {
			largestResultingJoltage = testJoltage
		}
	}
	return largestResultingJoltage
}
