package aoc2025

import (
	"fmt"
	"log"
	"strconv"
	"strings"
)

func Part1(input string) int {
	timesItGotToZero := 0
	value := 50
	for _, instruction := range strings.Split(input, "\n") {
		if strings.HasPrefix(instruction, "L") {
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			value = value - b
			for value < 0 {
				value = 100 + value
			}
		} else if strings.HasPrefix(instruction, "R") {
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			value = value + b
			for value > 99 {
				value = value - 100
			}
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
		previousTimes := timesItGotToZero
		direction := " up "
		if strings.HasPrefix(instruction, "L") {
			direction = "down"
			if value == 0 {
				value = 100
			}
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			value = value - b
			if value == 0 {
				timesItGotToZero++
			}
			for value < 0 {
				value = 100 + value
				timesItGotToZero++
			}
		} else if strings.HasPrefix(instruction, "R") {
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			value = value + b
			for value > 99 {
				value = value - 100
				timesItGotToZero++
			}
		}
		increaseExplanation := "did not hit 0 this time"
		if previousTimes != timesItGotToZero {
			increaseExplanation = fmt.Sprintf("hit zero %d time(s), for a new total of %d", timesItGotToZero-previousTimes, timesItGotToZero)
		}
		fmt.Printf("%s: went %s to %d and %s\n", instruction, direction, value, increaseExplanation)
	}
	return timesItGotToZero
}

func Part2NextGen(input string) int {
	timesItGotToZero := 0
	value := 50
	for _, instruction := range strings.Split(input, "\n") {
		previousTimes := timesItGotToZero
		direction := " up "
		if strings.HasPrefix(instruction, "L") {
			direction = "down"
			if value == 0 {
				value = 100
			}
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			for i := 0; i < b; i++ {
				value--
				if value == 0 {
					timesItGotToZero++
				}
				if value == -1 {
					value = 99
				}
			}
		} else if strings.HasPrefix(instruction, "R") {
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			for i := 0; i < b; i++ {
				value++
				if value == 100 {
					timesItGotToZero++
					value = 0
				}
			}
		}
		increaseExplanation := "did not hit 0 this time"
		if previousTimes != timesItGotToZero {
			increaseExplanation = fmt.Sprintf("hit zero %d time(s), for a new total of %d", timesItGotToZero-previousTimes, timesItGotToZero)
		}
		fmt.Printf("%s: went %s to %d and %s\n", instruction, direction, value, increaseExplanation)
	}
	return timesItGotToZero
}
