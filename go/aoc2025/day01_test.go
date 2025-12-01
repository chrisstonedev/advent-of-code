package aoc2025

import (
	"testing"

	"github.com/stretchr/testify/assert"

	"aoc/utils"
)

const date = "2025_01"

func TestDay01Part1(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 54, Part1(input))
}

func TestDay01Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 10496, Part1(input))
}

func TestDay01Part2(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 54, Part2(input))
}

func TestDay01Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 10496, Part2(input))
}
