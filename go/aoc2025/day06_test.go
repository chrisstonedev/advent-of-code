package aoc2025

import (
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"github.com/chrisstonedev/advent-of-code/go/utils"
)

const day06 = "2025_06"

func TestDay06Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day06, "test")
	require.Equal(t, 4277556, Day06Part1(input))
}

func TestDay06Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day06, "input")
	require.Equal(t, 4951502530386, Day06Part1(input))
}

func TestDay06Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day06, "test")
	require.Equal(t, 3263827, Day06Part2(input))
}

func TestDay06Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day06, "input")
	require.Equal(t, 8486156119946, Day06Part2(input))
}

func TestDay06InstructionsTest(t *testing.T) {
	input := strings.Split(utils.ReadFileIntoString(day06, "test"), "\n")
	operators := input[len(input)-1]
	require.Equal(t, []Instruction{
		{"*", 0, 4},
		{"+", 4, 8},
		{"*", 8, 12},
		{"+", 12, -1},
	}, getInstructions(operators))
}

func TestDay06AddSpaces(t *testing.T) {
	input := []string{
		"123",
		"1234",
		"12345",
	}
	expected := []string{
		"123  ",
		"1234 ",
		"12345",
	}
	require.Equal(t, expected, addSpacesToNumberRows(input))
}
