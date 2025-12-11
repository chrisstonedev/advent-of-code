package aoc2025

import (
	"fmt"
	"image"
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
	cache map[string]bool
)

func Day09Part2(input string) int {
	lines := strings.Split(input, "\n")
	pairs := pairsWithBiggestArea(lines)
	fmt.Println("got all pairs")
	perimeter := getPerimeter(lines)
	fmt.Println("got perimeter")
	maxXOfTotalArea := 0
	for _, perPoint := range perimeter {
		if perPoint.X > maxXOfTotalArea {
			maxXOfTotalArea = perPoint.X
		}
	}
	fmt.Println("got maxXOfTotalArea")
	cache = make(map[string]bool)
	for ix := 21299; ix < len(pairs); ix++ {
		if isInside(pairs[ix], perimeter, maxXOfTotalArea) {
			return pairs[ix].Area
		} else {
			fmt.Printf("pair at ix %d is not inside\n", ix)
		}
	}

	return 0
}

func isInside(pair SomeKindOfType, perimeter []image.Point, maxXOfTotalArea int) bool {
	minX := min(pair.X1, pair.X2)
	maxX := max(pair.X1, pair.X2)
	minY := min(pair.Y1, pair.Y2)
	maxY := max(pair.Y1, pair.Y2)
	for x := minX; x <= maxX; x++ {
		for y := minY; y <= maxY; y++ {
			if x > minX && x < maxX && y > minY && y < maxY {
				continue
			}
			mapKey := fmt.Sprintf("%d,%d", x, y)
			if val, ok := cache[mapKey]; ok {
				if val {
					continue
				} else {
					return false
				}
			}
			isInsideYes := isPointInsideArea(perimeter, image.Point{X: x, Y: y}, maxXOfTotalArea)
			cache[mapKey] = isInsideYes
			if !isInsideYes {
				return false
			}
		}
	}
	return true
}

func isPointInsideArea(perimeter []image.Point, point image.Point, maxX int) bool {
	if slices.IndexFunc(perimeter, func(e image.Point) bool {
		return e.X == point.X && e.Y == point.Y
	}) >= 0 {
		return true
	}
	edges := 0
	lastOneWasAlsoInPerimeter := false
	for i := point.X + 1; i <= maxX; i++ {
		thisTimeItIsInPerimeter := slices.Contains(perimeter, image.Point{X: i, Y: point.Y})
		if !lastOneWasAlsoInPerimeter && thisTimeItIsInPerimeter {
			edges++
		}
		lastOneWasAlsoInPerimeter = thisTimeItIsInPerimeter
	}
	return edges%2 == 1
}

func getPerimeter(lines []string) []image.Point {
	pointsThatMakeUpThePerimeter := []image.Point{lineToI(lines[0])}
	for i := 1; i <= len(lines); i++ {
		index := i % len(lines)
		lastPoint := pointsThatMakeUpThePerimeter[len(pointsThatMakeUpThePerimeter)-1]
		newPoint := lineToI(lines[index])
		if lastPoint.X == newPoint.X {
			if lastPoint.Y < newPoint.Y {
				for j := lastPoint.Y + 1; j < newPoint.Y; j++ {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, image.Point{X: newPoint.X, Y: j})
				}
			} else {
				for j := lastPoint.Y - 1; j > newPoint.Y; j-- {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, image.Point{X: newPoint.X, Y: j})
				}
			}
		} else {
			if lastPoint.X < newPoint.X {
				for j := lastPoint.X + 1; j < newPoint.X; j++ {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, image.Point{X: j, Y: newPoint.Y})
				}
			} else {
				for j := lastPoint.X - 1; j > newPoint.X; j-- {
					pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, image.Point{X: j, Y: newPoint.Y})
				}
			}
		}
		if index != 0 {
			pointsThatMakeUpThePerimeter = append(pointsThatMakeUpThePerimeter, newPoint)
		}
	}
	return pointsThatMakeUpThePerimeter
}

func lineToI(s string) image.Point {
	point := strings.Split(s, ",")
	x, _ := strconv.Atoi(point[0])
	y, _ := strconv.Atoi(point[1])
	return image.Point{X: x, Y: y}
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
