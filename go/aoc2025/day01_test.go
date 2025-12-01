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

// it's not 281
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

func TestDay01Part2NextGen(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	require.Equal(t, 6, Part2NextGen(input))
}

func TestDay01Part2NextGenInput(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	require.Equal(t, 6789, Part2NextGen(input))
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
		{[]string{"L50", "R6", "L15", "L18", "R24", "R28", "L29", "L41", "L13", "R49", "R18", "R36", "L28", "L10", "R16", "R1", "L47", "R4", "R45", "R45", "L49", "R13", "L19", "R24", "R34", "R13", "L42", "L35", "L14", "R38", "R2", "R31", "L4", "R37", "L40", "L19", "L42", "R32", "L50", "R23", "L31", "R43", "L46", "R36", "R17", "L29", "L25", "R23", "L28", "L80", "R50", "R51", "R98", "R58", "R92", "L57", "R98", "R95", "L69", "L61", "L39", "L21", "L53", "R21", "R53", "L88", "L35", "R7", "L84", "L16", "L84", "R36", "L36", "R90", "R98", "L88", "L39", "R39", "L44", "L94", "R33", "L95", "R82", "R95", "R54", "R32", "R37", "R43", "L43", "L62", "L48", "L15", "L63", "R88", "R94", "R6", "L54", "R86", "L29", "R13", "R84", "L60", "L50", "R81", "L174", "L10", "L436", "R56", "R47", "L677", "R14"}, "input", 64},
		{[]string{"L50", "R6", "L15", "L18", "R24", "R28", "L29", "L41", "L13", "R49", "R18", "R36", "L28", "L10", "R16", "R1", "L47", "R4", "R45", "R45", "L49", "R13", "L19", "R24", "R34", "R13", "L42", "L35", "L14", "R38", "R2", "R31", "L4", "R37", "L40", "L19", "L42", "R32", "L50", "R23", "L31", "R43", "L46", "R36", "R17", "L29", "L25", "R23", "L28", "L80", "R50", "R51", "R98", "R58", "R92", "L57", "R98", "R95", "L69", "L61", "L39", "L21", "L53", "R21", "R53", "L88", "L35", "R7", "L84", "L16", "L84", "R36", "L36", "R90", "R98", "L88", "L39", "R39", "L44", "L94", "R33", "L95", "R82", "R95", "R54", "R32", "R37", "R43", "L43", "L62", "L48", "L15", "L63", "R88", "R94", "R6", "L54", "R86", "L29", "R13", "R84", "L60", "L50", "R81", "L174", "L10", "L436", "R56", "R47", "L677", "R14", "L391"}, "input", 68},
	}
	for _, tt := range tests {
		t.Run(fmt.Sprintf("Trying with only %d lines of %s input", len(tt.input), tt.source), func(t *testing.T) {
			require.Equal(t, tt.expected, Part2(strings.Join(tt.input, "\n")))
		})
	}
}
