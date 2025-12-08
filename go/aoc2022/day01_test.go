package aoc2022

import (
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/chrisstonedev/advent-of-code/go/utils"
)

const date = "2022_01"

func TestDay01Part1(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 24000, Part1(input))
}

func TestDay01Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 69281, Part1(input))
}

func TestDay01Part2(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 45000, Part2(input))
}

func TestDay01Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 201524, Part2(input))
}
