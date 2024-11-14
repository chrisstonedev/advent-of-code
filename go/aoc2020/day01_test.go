package aoc2020

import (
	"aoc/utils"
	"github.com/stretchr/testify/assert"
	"testing"
)

const date = "2020_01"

func TestDay01Part1(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 514579, Part1(input))
}

func TestDay01Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 918339, Part1(input))
}

func TestDay01Part2(t *testing.T) {
	input := utils.ReadFileIntoString(date, "test")
	assert.Equal(t, 241861950, Part2(input))
}

func TestDay01Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(date, "input")
	assert.Equal(t, 23869440, Part2(input))
}
