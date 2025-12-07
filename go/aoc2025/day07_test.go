package aoc2025

import (
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const day07 = "2025_07"

func TestDay07Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day07, "test")
	require.Equal(t, 21, Day07Part1(input))
}

func TestDay07Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day07, "input")
	require.Equal(t, 1622, Day07Part1(input))
}

func TestDay07Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day07, "test")
	require.Equal(t, 40, Day07Part2(input))
}

func TestDay07Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day07, "input")
	require.Equal(t, 10357305916520, Day07Part2(input))
}

func TestPart2InSmallerSteps(t *testing.T) {
	tests := []struct {
		name     string
		input    []string
		expected int
	}{
		{
			"sample1",
			[]string{
				".......S.......",
				"...............",
				".......^.......",
				"...............",
			},
			2,
		},
		{
			"sample1",
			[]string{
				".......S.......",
				"...............",
				".......^.......",
				"...............",
				"......^.^......",
				"...............",
			},
			4,
		},
		{
			"sample1",
			[]string{
				".......S.......",
				"...............",
				".......^.......",
				"...............",
				"......^.^......",
				"...............",
				".....^.^.^.....",
				"...............",
			},
			8,
		},
		{
			"sample1",
			[]string{
				".......S.......",
				"...............",
				".......^.......",
				"...............",
				"......^.^......",
				"...............",
				".....^.^.^.....",
				"...............",
				"....^.^...^....",
				"...............",
				"...^.^...^.^...",
				"...............",
				"..^...^.....^..",
				"...............",
				".^.^.^.^.^...^.",
				"...............",
			},
			40,
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, Day07Part2(strings.Join(tt.input, "\n")))
		})
	}
}
