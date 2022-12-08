package main

import (
	"github.com/stretchr/testify/assert"
	"os"
	"testing"
)

func TestDay01Part1(t *testing.T) {
	data, _ := os.ReadFile("../data/test/Day01.txt")
	input := string(data)
	assert.Equal(t, 1, part1(input))
}

func TestDay01Part2(t *testing.T) {
	data, _ := os.ReadFile("../data/test/Day01.txt")
	input := string(data)
	assert.Equal(t, 2, part2(input))
}
