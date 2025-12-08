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
			finalJunctionIndex1, finalJunctionIndex2, _ := getJunctions(finalExtensionCable)
			finalX1, _, _, _ := getNumericCoordinates(allLines[finalJunctionIndex1])
			finalX2, _, _, _ := getNumericCoordinates(allLines[finalJunctionIndex2])
			return int(finalX1 * finalX2)
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
			x1, y1, z1, _ := getNumericCoordinates(allLines[i])
			x2, y2, z2, _ := getNumericCoordinates(allLines[j])
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

func getNumericCoordinates(line string) (float64, float64, float64, error) {
	linePieces := strings.Split(line, ",")
	x, err := strconv.ParseFloat(linePieces[0], 64)
	if err != nil {
		return 0, 0, 0, fmt.Errorf("aoc2025.getNumericCoordinates: failed to parse first numeric coordinate (%s) from %s, %w", linePieces[0], line, err)
	}
	y, err := strconv.ParseFloat(linePieces[1], 64)
	if err != nil {
		return 0, 0, 0, fmt.Errorf("aoc2025.getNumericCoordinates: failed to parse second numeric coordinate (%s) from %s, %w", linePieces[1], line, err)
	}
	z, err := strconv.ParseFloat(linePieces[2], 64)
	if err != nil {
		return 0, 0, 0, fmt.Errorf("aoc2025.getNumericCoordinates: failed to parse third numeric coordinate (%s) from %s, %w", linePieces[2], line, err)
	}
	return x, y, z, nil
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
	a1, a2, _ := getJunctions(s)
	x1, y1, z1, _ := getNumericCoordinates(allLines[a1])
	x2, y2, z2, _ := getNumericCoordinates(allLines[a2])
	distance := math.Sqrt(math.Pow(x1-x2, 2) + math.Pow(y1-y2, 2) + math.Pow(z1-z2, 2))
	return distance
}

func getJunctions(s string) (int, int, error) {
	a := strings.Split(s, "-")
	a1, err := strconv.Atoi(a[0])
	if err != nil {
		return 0, 0, fmt.Errorf("aoc2025.getJunctions: failed to parse first index (%s) from %s, %w", a[0], s, err)
	}
	a2, err := strconv.Atoi(a[1])
	if err != nil {
		return 0, 0, fmt.Errorf("aoc2025.getJunctions: failed to parse second index (%s) from %s, %w", a[1], s, err)
	}
	return a1, a2, nil
}

func doAThing(helpMe []string) []int {
	var circuits [][]int
	for _, thingThingThing := range helpMe {
		thing1, thing2, _ := getJunctions(thingThingThing)
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
