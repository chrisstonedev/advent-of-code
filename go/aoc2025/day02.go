package aoc2025

import (
	"fmt"
	"regexp"
	"strconv"
	"strings"
)

func Day02Part1(input string) int {
	splits := strings.Split(input, ",")
	invalid := 0
	for _, split := range splits {
		s2 := strings.Split(split, "-")
		num1, _ := strconv.Atoi(s2[0])
		num2, _ := strconv.Atoi(s2[1])
		for i := num1; i <= num2; i++ {
			text := strconv.Itoa(i)
			if len(text)%2 == 0 && text[:len(text)/2] == text[len(text)/2:] {
				invalid += i
			}
		}
	}
	return invalid
}

func Day02Part2(input string) int {
	splits := strings.Split(input, ",")
	invalid := 0
	for _, split := range splits {
		s2 := strings.Split(split, "-")
		num1, _ := strconv.Atoi(s2[0])
		num2, _ := strconv.Atoi(s2[1])
		for i := num1; i <= num2; i++ {
			text := strconv.Itoa(i)
			for j := len(text) / 2; j >= 1; j-- {
				segment := text[:j]
				r := regexp.MustCompile(fmt.Sprintf(`^(%s)+$`, segment))
				if r.MatchString(text) {
					invalid += i
					break
				}
			}
		}
	}
	return invalid
}
