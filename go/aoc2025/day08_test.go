package aoc2025

import (
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"github.com/chrisstonedev/advent-of-code/go/utils"
)

const day08 = "2025_08"

func TestShortestDistanceIn3DSpace(t *testing.T) {
	tests := []struct {
		name             string
		alreadyConnected []string
		expectedPairs    []string
		expectedNumbers  string
	}{
		{
			"initial state",
			nil,
			[]string{"162,817,812", "425,690,689"},
			"0-19",
		},
		{
			"state after first connection",
			[]string{"0-19"},
			[]string{"162,817,812", "431,825,988"},
			"0-7",
		},
		{
			"state after second connection",
			[]string{"0-19", "0-7"},
			[]string{"906,360,560", "805,96,715"},
			"2-13",
		},
		{
			"state after third connection",
			[]string{"0-19", "0-7", "2-13"},
			[]string{"431,825,988", "425,690,689"},
			"7-19",
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			input := utils.ReadFileIntoString(day08, "test")
			allLines := strings.Split(input, "\n")
			pairs, numbers := shortestDistance3D(allLines, tt.alreadyConnected)
			require.Equal(t, tt.expectedPairs, pairs)
			require.Equal(t, tt.expectedNumbers, numbers)
		})
	}
}

func TestNewThing(t *testing.T) {
	tests := []struct {
		name     string
		input    []string
		expected []int
	}{
		{
			"initial step",
			[]string{"0-19"},
			[]int{2},
		},
		{
			"second step",
			[]string{"0-19", "0-7"},
			[]int{3},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13"},
			[]int{3, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19"},
			[]int{3, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18"},
			[]int{3, 2, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18", "9-12"},
			[]int{3, 2, 2, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18", "9-12", "11-16"},
			[]int{3, 2, 2, 2, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18", "9-12", "11-16", "2-8"},
			[]int{3, 3, 2, 2, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18", "9-12", "11-16", "2-8", "14-19"},
			[]int{4, 3, 2, 2, 2},
		},
		{
			"final test input",
			[]string{"0-19", "0-7", "2-13", "7-19", "17-18", "9-12", "11-16", "2-8", "14-19", "2-18"},
			[]int{5, 4, 2, 2},
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, doAThing(tt.input))
		})
	}
}

func TestDay08Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day08, "test")
	require.Equal(t, 40, Day08Part1(input, 10))
}

// takes 14 minutes!
func TestDay08Part1Input(t *testing.T) {
	t.Skip("Takes 14 minutes!")
	input := utils.ReadFileIntoString(day08, "input")
	require.Equal(t, 50568, Day08Part1(input, 1000))
}

func TestDay08Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day08, "test")
	require.Equal(t, 25272, Day08Part2(input))
}

func TestDay08Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day08, "input")
	require.Equal(t, 25272, Day08Part2(input))
}
