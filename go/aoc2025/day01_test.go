package aoc2025

import (
	"fmt"
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const date = "2025_01"

func TestDay01Part1(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	require.Equal(t, 3, Part1(input))
}

func TestDay01Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	require.Equal(t, 1147, Part1(input))
}

func TestDay01Part2(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	require.Equal(t, 6, Part2(input))
}

func TestDay01Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	require.Equal(t, 6789, Part2(input))
}

func TestPart2InSmallerParts(t *testing.T) {
	tests := []struct {
		input    []string
		source   string
		expected int
	}{
		{[]string{"L68"}, "test", 1},
		{[]string{"L68", "L30"}, "test", 1},
		{[]string{"L68", "L30", "R48"}, "test", 2},
		{[]string{"L68", "L30", "R48", "L5"}, "test", 2},
		{[]string{"L68", "L30", "R48", "L5", "R60"}, "test", 3},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55"}, "test", 4},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1"}, "test", 4},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99"}, "test", 5},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14"}, "test", 5},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14", "L82"}, "test", 6},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14", "L82", "R550"}, "fake (R)", 11},
		{[]string{"L68", "L30", "R48", "L5", "R60", "L55", "L1", "L99", "R14", "L82", "L550"}, "fake (L)", 12},
		{[]string{"R1000"}, "sample", 10},
		{[]string{"R56", "L106"}, "sample", 3},
	}
	for _, tt := range tests {
		t.Run(fmt.Sprintf("Trying with only %d lines of %s input", len(tt.input), tt.source), func(t *testing.T) {
			require.Equal(t, tt.expected, Part2(strings.Join(tt.input, "\n")))
		})
	}
}
