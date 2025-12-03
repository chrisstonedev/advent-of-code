package aoc2025

import (
	"fmt"
	"strconv"
	"strings"
)

func Day03Part1(input string) int {
	allStrings := strings.Split(input, "\n")
	value := 0
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
		b, _ := strconv.Atoi(fmt.Sprintf("%c%c", startNumber, endNumber))
		value += b
	}
	return value
}

func Day03Part2(input string) int {
	allStrings := strings.Split(input, "\n")
	value := 0
	for _, thing := range allStrings {
		newThing := thing
		for len(newThing) > 12 {
			newThing = chopOffALetter(newThing)
		}
		b, _ := strconv.Atoi(newThing)
		value += b
	}
	return value
}

func chopOffALetter(thing string) string {
	highestTempThing := thing[1:]
	for i := 1; i < len(thing); i++ {
		testThing := thing[:i] + thing[i+1:]
		if testThing > highestTempThing {
			highestTempThing = testThing
		}
	}
	return highestTempThing
}
