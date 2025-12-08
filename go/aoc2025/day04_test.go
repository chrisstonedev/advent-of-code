package aoc2025

import (
	"testing"

	"github.com/stretchr/testify/require"

	"github.com/chrisstonedev/advent-of-code/go/utils"
)

const day04 = "2025_04"

func TestDay04Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day04, "test")
	require.Equal(t, 13, Day04Part1(input))
}

func TestDay04Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day04, "input")
	require.Equal(t, 1547, Day04Part1(input))
}

func TestDay04Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day04, "test")
	require.Equal(t, 43, Day04Part2(input))
}

func TestDay04Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day04, "input")
	require.Equal(t, 8948, Day04Part2(input))
}
