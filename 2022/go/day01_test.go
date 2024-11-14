package main

import (
	"github.com/stretchr/testify/assert"
	"os"
	"testing"
)

func TestDay01Part1Sample(t *testing.T) {
	data, _ := os.ReadFile("../data/test01.txt")
	input := string(data)
	assert.Equal(t, 24000, part1(input))
}

func TestDay01Part1(t *testing.T) {
	data, _ := os.ReadFile("../data/input01.txt")
	input := string(data)
	assert.Equal(t, 69281, part1(input))
}

func TestDay01Part2Sample(t *testing.T) {
	data, _ := os.ReadFile("../data/test01.txt")
	input := string(data)
	assert.Equal(t, 45000, part2(input))
}

func TestDay01Part2(t *testing.T) {
	data, _ := os.ReadFile("../data/input01.txt")
	input := string(data)
	assert.Equal(t, 201524, part2(input))
}
