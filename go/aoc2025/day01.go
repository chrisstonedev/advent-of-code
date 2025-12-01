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
		if strings.HasPrefix(instruction, "L") {
			if value == 0 {
				value = 100
			}
			amount := instruction[1:]
			b, err := strconv.Atoi(amount)
			if err != nil {
				log.Panicf("bad number? %s", instruction)
			}
			value = value - b
			for value < 0 {
				value = 100 + value
				timesItGotToZero++
			}
			if value == 0 {
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
		fmt.Printf("after %s, value is now %d\n", instruction, value)
		for i := previousTimes + 1; i <= timesItGotToZero; i++ {
			fmt.Printf("%d. %s\n", i, instruction)
		}
	}
	return timesItGotToZero
}

func Part2NextGen(input string) int {
	timesItGotToZero := 0
	value := 50
	for _, instruction := range strings.Split(input, "\n") {
		if strings.HasPrefix(instruction, "L") {
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
					fmt.Printf("%d. %s\n", timesItGotToZero, instruction)
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
					fmt.Printf("%d. %s\n", timesItGotToZero, instruction)
					value = 0
				}
			}
		}
	}
	return timesItGotToZero
}
