package aoc2025

import (
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const day02 = "2025_02"

func TestDay02Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "test")
	require.Equal(t, 3, Day01Part1(input))
}

func TestDay02Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "input")
	require.Equal(t, 1147, Day01Part1(input))
}

func TestDay02Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "test")
	require.Equal(t, 6, Day01Part2(input))
}

func TestDay02Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "input")
	require.Equal(t, 6789, Day01Part2(input))
}

func TestDay02InSmallerParts(t *testing.T) {
	tests := []struct {
		name string
	}{
		{"Sample table test"},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Fail(t, "No test implemented yet")
		})
	}
}
