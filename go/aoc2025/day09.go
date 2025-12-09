package aoc2025

import (
	"fmt"
	"slices"
	"sort"
	"strconv"
	"strings"
)

func Day09Part1(input string) int {
	lines := strings.Split(input, "\n")
	area, _ := pairWithBiggestArea(lines)
	return area
}

var (
	something9 map[string]bool
)

func Day09Part2(input string) int {
	lines := strings.Split(input, "\n")
	pairs := pairsWithBiggestArea(lines)
	fmt.Println("got all pairs")
	perimeter := getPerimeter(lines)
	fmt.Println("got perimeter")
	something9 = make(map[string]bool)
	for ix := 21299; ix < len(pairs); ix++ {
		if isInside(pairs[ix], perimeter) {
			return pairs[ix].Area
		}

		fmt.Printf("pair at ix %d is not inside\n", ix)
	}
	return 0
}

func isInside(pair SomeKindOfType, perimeter [][]int) bool {
	for x := min(pair.X1, pair.X2) + 1; x < max(pair.X1, pair.X2); x++ {
		for y := min(pair.Y1, pair.Y2) + 1; y < max(pair.Y1, pair.Y2); y++ {
			mapKey := fmt.Sprintf("%d,%d", x, y)
			if val, ok := something9[mapKey]; ok {
				if val {
					continue
				} else {
					return false
				}
			}
			if slices.IndexFunc(perimeter, func(e []int) bool {
				return e[0] == x && e[1] == y
			}) >= 0 {
				something9[mapKey] = true
				continue
			}
			edges := 0
			for _, point := range perimeter {
				if point[0] == x && point[1] > y {
					edges++
				}
			}
			if edges%2 == 0 {
				something9[mapKey] = false
				return false
			} else {
				something9[mapKey] = true
			}
		}
	}
	return true
}

func getPerimeter(lines []string) [][]int {
	pointsThatMakeUpThePerimeter := [][]int{lineToI(lines[0])}
	for i := 1; i <= len(lines); i++ {
		index := i % len(lines)
		lastPoint := pointsThatMakeUpThePerimeter[len(pointsThatMakeUpThePerimeter)-1]
		newPoint := lineToI(lines[index])
		if lastPoint[0] == newPoint[0] {
			if lastPoint[1] < newPoint[1] {
				for j := lastPoint[1] + 1; j < newPoint[1]; j++ {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, []int{newPoint[0], j})
				}
			} else {
				for j := lastPoint[1] - 1; j > newPoint[1]; j-- {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, []int{newPoint[0], j})
				}
			}
		} else {
			if lastPoint[0] < newPoint[0] {
				for j := lastPoint[0] + 1; j < newPoint[0]; j++ {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, []int{j, newPoint[1]})
				}
			} else {
				for j := lastPoint[0] - 1; j > newPoint[0]; j-- {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, []int{j, newPoint[1]})
				}
			}
		}
		if index != 0 {
			pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, newPoint)
		}
	}
	return pointsThatMakeUpThePerimeter
}

func lineToI(s string) []int {
	point := strings.Split(s, ",")
	x, _ := strconv.Atoi(point[0])
	y, _ := strconv.Atoi(point[1])
	return []int{x, y}
}

func pairWithBiggestArea(input []string) (int, []string) {
	area := 0
	var pair []string
	for i := 0; i < len(input)-1; i++ {
		for j := i + 1; j < len(input); j++ {
			point1 := strings.Split(input[i], ",")
			point2 := strings.Split(input[j], ",")
			x1, _ := strconv.Atoi(point1[0])
			y1, _ := strconv.Atoi(point1[1])
			x2, _ := strconv.Atoi(point2[0])
			y2, _ := strconv.Atoi(point2[1])
			xDiff := max(x1, x2) - min(x1, x2) + 1
			yDiff := max(y1, y2) - min(y1, y2) + 1
			newArea := xDiff * yDiff
			if newArea > area {
				area = newArea
				pair = []string{input[i], input[j]}
			}
		}
	}
	return area, pair
}

type SomeKindOfType struct {
	Area int
	X1   int
	Y1   int
	X2   int
	Y2   int
}

func pairsWithBiggestArea(input []string) []SomeKindOfType {
	var pairs []SomeKindOfType
	for i := 0; i < len(input)-1; i++ {
		for j := i + 1; j < len(input); j++ {
			point1 := strings.Split(input[i], ",")
			point2 := strings.Split(input[j], ",")
			x1, _ := strconv.Atoi(point1[0])
			y1, _ := strconv.Atoi(point1[1])
			x2, _ := strconv.Atoi(point2[0])
			y2, _ := strconv.Atoi(point2[1])
			xDiff := max(x1, x2) - min(x1, x2) + 1
			yDiff := max(y1, y2) - min(y1, y2) + 1
			area := xDiff * yDiff
			pairs = append(pairs, SomeKindOfType{
				Area: area,
				X1:   x1,
				Y1:   y1,
				X2:   x2,
				Y2:   y2,
			})
		}
	}
	sort.Slice(pairs, func(i, j int) bool {
		return pairs[i].Area > pairs[j].Area
	})
	return pairs
}
