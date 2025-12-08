package aoc2025

import (
	"fmt"
	"math"
	"slices"
	"sort"
	"strconv"
	"strings"
)

func Day08Part1(input string, iterations int) int {
	allLines := strings.Split(input, "\n")
	var allNumbers []string
	for i := 0; i < iterations; i++ {
		fmt.Printf("iteration %d\n", i)
		_, numbers := shortestDistance3D(allLines, allNumbers)
		allNumbers = append(allNumbers, numbers)
	}
	gigi := doAThing(allNumbers)
	return gigi[0] * gigi[1] * gigi[2]
}

func Day08Part2(input string) int {
	value := strings.Count(input, "^") - 1
	return value
}

func shortestDistance3D(allLines []string, connected []string) ([]string, string) {
	shortestDistance := math.MaxFloat64
	var pairs []string
	var numbers string
	for i := 0; i < len(allLines)-1; i++ {
		for j := i + 1; j < len(allLines); j++ {
			if slices.Contains(connected, fmt.Sprintf("%d-%d", i, j)) {
				continue
			}
			line1 := strings.Split(allLines[i], ",")
			x1, _ := strconv.ParseFloat(line1[0], 64)
			y1, _ := strconv.ParseFloat(line1[1], 64)
			z1, _ := strconv.ParseFloat(line1[2], 64)
			line2 := strings.Split(allLines[j], ",")
			x2, _ := strconv.ParseFloat(line2[0], 64)
			y2, _ := strconv.ParseFloat(line2[1], 64)
			z2, _ := strconv.ParseFloat(line2[2], 64)
			distance := math.Sqrt(math.Pow(x1-x2, 2) + math.Pow(y1-y2, 2) + math.Pow(z1-z2, 2))
			if distance < shortestDistance {
				shortestDistance = distance
				numbers = fmt.Sprintf("%d-%d", i, j)
				pairs = []string{allLines[i], allLines[j]}
			}
		}
	}
	return pairs, numbers
}

func doAThing(helpMe []string) []int {
	var circuits [][]int
	for helpHeeHee, thingThingThing := range helpMe {
		fmt.Printf("sort %d\n", helpHeeHee)
		values := strings.Split(thingThingThing, "-")
		thing1, _ := strconv.Atoi(values[0])
		thing2, _ := strconv.Atoi(values[1])
		circuit1 := slices.IndexFunc(circuits, func(e []int) bool {
			return slices.Contains(e, thing1)
		})
		circuit2 := slices.IndexFunc(circuits, func(e []int) bool {
			return slices.Contains(e, thing2)
		})
		if circuit1 >= 0 && circuit1 == circuit2 {
			continue
		}
		if circuit1 == circuit2 {
			circuits = append(circuits, []int{thing1, thing2})
		} else if circuit2 == -1 {
			circuits[circuit1] = append(circuits[circuit1], thing2)
		} else if circuit1 == -1 {
			circuits[circuit2] = append(circuits[circuit2], thing1)
		} else {
			circuits[circuit1] = slices.Concat(circuits[circuit1], circuits[circuit2])
			circuits = append(circuits[:circuit2], circuits[circuit2+1:]...)
		}
	}
	var value []int
	for _, otherThing := range circuits {
		value = append(value, len(otherThing))
	}
	sort.Sort(sort.Reverse(sort.IntSlice(value)))
	return value
}
