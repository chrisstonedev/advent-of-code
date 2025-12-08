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
	allNumbers := shortestDistance3DV2(allLines)
	allNumbers = allNumbers[:iterations]
	gigi := doAThing(allNumbers)
	return gigi[0] * gigi[1] * gigi[2]
}

func Day08Part2(input string) int {
	allLines := strings.Split(input, "\n")
	allNumbers := shortestDistance3DV2(allLines)
	for i := 10; ; i++ {
		fmt.Printf("iteration %d\n", i)
		testNumbers := allNumbers[:i]
		gigi := doAThing(testNumbers)
		if len(gigi) == 1 && gigi[0] == len(allLines) {
			finalExtensionCable := testNumbers[len(testNumbers)-1]
			finalJunctionBoxIndexes := strings.Split(finalExtensionCable, "-")
			finalJunctionIndex1, _ := strconv.Atoi(finalJunctionBoxIndexes[0])
			finalJunctionIndex2, _ := strconv.Atoi(finalJunctionBoxIndexes[1])
			finalCoords1 := strings.Split(allLines[finalJunctionIndex1], ",")
			finalCoords2 := strings.Split(allLines[finalJunctionIndex2], ",")
			finalX1, _ := strconv.Atoi(finalCoords1[0])
			finalX2, _ := strconv.Atoi(finalCoords2[0])
			return finalX1 * finalX2
		}
	}
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

func shortestDistance3DV2(allLines []string) []string {
	var niftyStuff []string
	for i := 0; i < len(allLines)-1; i++ {
		for j := i + 1; j < len(allLines); j++ {
			niftyStuff = append(niftyStuff, fmt.Sprintf("%d-%d", i, j))
		}
	}
	sort.Slice(niftyStuff, func(i, j int) bool {
		distanceI := calculateDistance(niftyStuff[i], allLines)
		distanceJ := calculateDistance(niftyStuff[j], allLines)
		return distanceI < distanceJ
	})
	return niftyStuff
}

func calculateDistance(s string, allLines []string) float64 {
	a := strings.Split(s, "-")
	a1, _ := strconv.Atoi(a[0])
	a2, _ := strconv.Atoi(a[1])
	lineBBB1 := allLines[a1]
	lineBBB2 := allLines[a2]
	line1 := strings.Split(lineBBB1, ",")
	x1, _ := strconv.ParseFloat(line1[0], 64)
	y1, _ := strconv.ParseFloat(line1[1], 64)
	z1, _ := strconv.ParseFloat(line1[2], 64)
	line2 := strings.Split(lineBBB2, ",")
	x2, _ := strconv.ParseFloat(line2[0], 64)
	y2, _ := strconv.ParseFloat(line2[1], 64)
	z2, _ := strconv.ParseFloat(line2[2], 64)
	distance := math.Sqrt(math.Pow(x1-x2, 2) + math.Pow(y1-y2, 2) + math.Pow(z1-z2, 2))
	return distance
}

func doAThing(helpMe []string) []int {
	var circuits [][]int
	for _, thingThingThing := range helpMe {
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
