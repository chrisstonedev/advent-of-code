package aoc2025

import (
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
	for _, productIDRange := range productIDRanges {
		s2 := strings.Split(productIDRange, "-")
		rangeStart, _ := strconv.Atoi(s2[0])
		rangeEnd, _ := strconv.Atoi(s2[1])
		for productID := rangeStart; productID <= rangeEnd; productID++ {
			text := strconv.Itoa(productID)
			if maxRepeats == 2 && len(text)%2 == 1 {
				continue
			}
			for segmentLength := len(text) / 2; segmentLength >= 1; segmentLength-- {
				if isTextARepeatingPattern(text, segmentLength) {
					sum += productID
					break
				}
				if maxRepeats == 2 {
					break
				}
			}
		}
	}
	return sum
}

func isTextARepeatingPattern(text string, segmentLength int) bool {
	if len(text)%segmentLength != 0 {
		return false
	}
	firstSegment := text[:segmentLength]
	for i := segmentLength; i < len(text); i += segmentLength {
		newTestSegment := text[i : i+segmentLength]
		if firstSegment != newTestSegment {
			return false
		}
	}
	return true
}
