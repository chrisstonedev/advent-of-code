package main

import (
	"fmt"
	"github.com/stretchr/testify/assert"
	"os"
	"testing"
)

func readFileIntoString(inputType string) string {
	fileName := fmt.Sprintf("../data/%s01.txt", inputType)
	data, _ := os.ReadFile(fileName)
	input := string(data)
	return input
}

func TestDay01Part1Sample(t *testing.T) {
	input := readFileIntoString("test")
	assert.Equal(t, 514579, part1(input))
}

func TestDay01Part1(t *testing.T) {
	input := readFileIntoString("input")
	assert.Equal(t, 918339, part1(input))
}

func TestDay01Part2Sample(t *testing.T) {
	input := readFileIntoString("test")
	assert.Equal(t, 241861950, part2(input))
}

func TestDay01Part2(t *testing.T) {
	input := readFileIntoString("input")
	assert.Equal(t, 23869440, part2(input))
}
