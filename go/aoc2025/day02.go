package aoc2025

import (
	"fmt"
	"regexp"
	"strconv"
	"strings"
)

func Day02Part1(input string) int {
	return sumAllInvalidIDs(strings.Split(input, ","), 2)
}

func Day02Part2(input string) int {
	return sumAllInvalidIDs(strings.Split(input, ","), 0)
}

func sumAllInvalidIDs(productIDRanges []string, maxRepeats int) int {
	sum := 0
	maxRepeatRegExpFormat := fmt.Sprintf("{%d}", maxRepeats)
	if maxRepeats == 0 {
		maxRepeatRegExpFormat = "+"
	}
	for _, productIDRange := range productIDRanges {
		s2 := strings.Split(productIDRange, "-")
		rangeStart, _ := strconv.Atoi(s2[0])
		rangeEnd, _ := strconv.Atoi(s2[1])
		for productID := rangeStart; productID <= rangeEnd; productID++ {
			text := strconv.Itoa(productID)
			for j := len(text) / 2; j >= 1; j-- {
				segment := text[:j]
				if len(text)%len(segment) != 0 {
					continue
				}
				r := regexp.MustCompile(fmt.Sprintf(`^(%s)%s$`, segment, maxRepeatRegExpFormat))
				if r.MatchString(text) {
					sum += productID
					break
				}
				if j == 2 {
					break
				}
			}
		}
	}
	return sum
}
