package aoc2025

import (
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const day02 = "2025_02"

func TestDay02Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "test")
	require.Equal(t, 1227775554, Day02Part1(input))
}

func TestDay02Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "input")
	require.Equal(t, 13919717792, Day02Part1(input))
}

func TestDay02Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "test")
	require.Equal(t, 4174379265, Day02Part2(input))
}

func TestDay02Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day02, "input")
	require.Equal(t, 14582313461, Day02Part2(input))
}

func TestDay02InSmallerParts(t *testing.T) {
	tests := []struct {
		name     string
		input    string
		expected int
	}{
		{"sample1", "11-22", 33},
		{"sample2", "95-115", 99},
		{"sample3", "998-1012", 1010},
		{"sample4", "1188511880-1188511890", 1188511885},
		{"sample5", "222220-222224", 222222},
		{"sample6", "1698522-1698528", 0},
		{"sample7", "446443-446449", 446446},
		{"sample8", "38593856-38593862", 38593859},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, Day02Part1(tt.input))
		})
	}
}

func TestDay02Part2InSmallerParts(t *testing.T) {
	tests := []struct {
		name     string
		input    string
		expected int
	}{
		{"sample1", "11-22", 33},
		{"sample2", "95-115", 210},
		{"sample3", "998-1012", 2009},
		{"sample4", "1188511880-1188511890", 1188511885},
		{"sample5", "222220-222224", 222222},
		{"sample6", "1698522-1698528", 0},
		{"sample7", "446443-446449", 446446},
		{"sample8", "38593856-38593862", 38593859},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, Day02Part2(tt.input))
		})
	}
}
