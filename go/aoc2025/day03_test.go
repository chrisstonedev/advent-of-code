package aoc2025

import (
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const day03 = "2025_03"

func TestDay03Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day03, "test")
	require.Equal(t, 357, Day03Part1(input))
}

func TestDay03Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day03, "input")
	require.Equal(t, 17301, Day03Part1(input))
}

func TestDay03Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day03, "test")
	require.Equal(t, 3121910778619, Day03Part2(input))
}

func TestDay03Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day03, "input")
	require.Equal(t, 172162399742349, Day03Part2(input))
}

func TestDay03Part2InSmallerParts(t *testing.T) {
	tests := []struct {
		name     string
		input    string
		expected int
	}{
		{"sample1", "987654321111", 987654321111},
		{"sample1", "9876543211111", 987654321111},
		{"sample1", "98765432111111", 987654321111},
		{"sample1", "987654321111111", 987654321111},
		{"sample2", "811111111119", 811111111119},
		{"sample2", "8111111111119", 811111111119},
		{"sample2", "81111111111119", 811111111119},
		{"sample2", "811111111111119", 811111111119},
		{"sample3", "234234234234278", 434234234278},
		{"sample4", "818181911112111", 888911112111},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, Day03Part2(tt.input))
		})
	}
}
