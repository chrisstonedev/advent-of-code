package aoc2025

import (
	"fmt"
	"regexp"
	"strconv"
	"strings"
)

func Day02Part1(input string) int {
	return funcName(strings.Split(input, ","), 2)
}

func Day02Part2(input string) int {
	return funcName(strings.Split(input, ","), 0)
}

func funcName(splits []string, maxRepeats int) int {
	invalid := 0
	maxRepeatRegExpFormat := fmt.Sprintf("{%d}", maxRepeats)
	if maxRepeats == 0 {
		maxRepeatRegExpFormat = "+"
	}
	for _, split := range splits {
		s2 := strings.Split(split, "-")
		num1, _ := strconv.Atoi(s2[0])
		num2, _ := strconv.Atoi(s2[1])
		for i := num1; i <= num2; i++ {
			text := strconv.Itoa(i)
			for j := len(text) / 2; j >= 1; j-- {
				segment := text[:j]
				r := regexp.MustCompile(fmt.Sprintf(`^(%s)%s$`, segment, maxRepeatRegExpFormat))
				if r.MatchString(text) {
					invalid += i
					break
				}
			}
		}
	}
	return invalid
}
