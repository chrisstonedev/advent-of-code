package aoc2025

import (
	"image"
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"github.com/chrisstonedev/advent-of-code/go/utils"
)

const day09 = "2025_09"

func TestDay09Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day09, "test")
	require.Equal(t, 50, Day09Part1(input))
}

func TestWhatPairHasBiggestArea(t *testing.T) {
	input := strings.Split(utils.ReadFileIntoString(day09, "test"), "\n")
	area, pair := pairWithBiggestArea(input)
	require.Equal(t, 50, area)
	require.Equal(t, []string{"11,1", "2,5"}, pair)
}

func TestWhatPairsHaveBiggestArea(t *testing.T) {
	input := strings.Split(utils.ReadFileIntoString(day09, "test"), "\n")
	pairs := pairsWithBiggestArea(input)
	require.Equal(t, SomeKindOfType{
		Area: 50,
		X1:   11,
		Y1:   1,
		X2:   2,
		Y2:   5,
	}, pairs[0])
}

func TestDay09Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day09, "input")
	require.Equal(t, 4746238001, Day09Part1(input))
}

func TestDay09Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day09, "test")
	require.Equal(t, 24, Day09Part2(input))
}

// 3034335888 is too high
// 28184614 is too low (and it took 2 hr 19 min to get that)
func TestDay09Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day09, "input")
	require.Equal(t, 36045012, Day09Part2(input))
}

func TestGetPerimeter(t *testing.T) {
	input := strings.Split(utils.ReadFileIntoString(day09, "test"), "\n")
	perimeter := getPerimeter(input)
	require.Equal(t, [][]int{
		{7, 1},
		{8, 1},
		{9, 1},
		{10, 1},
		{11, 1},
		{11, 2},
		{11, 3},
		{11, 4},
		{11, 5},
		{11, 6},
		{11, 7},
		{10, 7},
		{9, 7},
		{9, 6},
		{9, 5},
		{8, 5},
		{7, 5},
		{6, 5},
		{5, 5},
		{4, 5},
		{3, 5},
		{2, 5},
		{2, 4},
		{2, 3},
		{3, 3},
		{4, 3},
		{5, 3},
		{6, 3},
		{7, 3},
		{7, 2},
	}, perimeter)
}

func TestIsInside(t *testing.T) {
	tests := []struct {
		name     string
		input    image.Point
		expected bool
	}{
		{"Outside", image.Point{X: 4, Y: 6}, false},
		{"Inside", image.Point{X: 4, Y: 3}, true},
		{"Inside, even when crossing boundary", image.Point{X: 2, Y: 5}, true},
		{"Outside, even when crossing boundary", image.Point{X: 2, Y: 1}, false},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			//[]image.Point{
			//	{3, 1},
			//	{5, 1},
			//	{5, 5},
			//	{3, 5},
			//	{3, 7},
			//	{1, 7},
			//	{1, 3},
			//	{3, 3},
			//}
			perimeter := getPerimeter([]string{"3,1", "6,1", "6,5", "3,5", "3,7", "1,7", "1,3", "3,3"})
			require.Equal(t, tt.expected, isPointInsideArea(perimeter, tt.input, 6))
		})
	}
}
