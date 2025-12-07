package aoc2025

import (
	"fmt"
	"slices"
	"sort"
	"strconv"
	"strings"
)

type FreshRange struct {
	Start int
	End   int
}

func Day05Part1(input string) int {
	allStrings := strings.Split(input, "\n\n")
	freshRanges := getFreshRanges(strings.Split(allStrings[0], "\n"))
	ingredientIDs := strings.Split(allStrings[1], "\n")
	value := 0
	for _, ingredientID := range ingredientIDs {
		ingredient, err := strconv.Atoi(ingredientID)
		if err != nil {
			panic("c")
		}
		for _, freshRange := range freshRanges {
			if ingredient >= freshRange.Start && ingredient <= freshRange.End {
				value++
				break
			}
		}
	}
	return value
}

//func Day05Part2(input string) int {
//	allStrings := strings.Split(input, "\n\n")
//	freshRangesText := strings.Split(allStrings[0], "\n")
//	var freshRanges []FreshRange
//	for _, myRange := range freshRangesText {
//		rangeVals := strings.Split(myRange, "-")
//		start, err := strconv.Atoi(rangeVals[0])
//		if err != nil {
//			panic("a")
//		}
//		end, err := strconv.Atoi(rangeVals[1])
//		if err != nil {
//			panic("b")
//		}
//		freshRanges = append(freshRanges, FreshRange{Start: start, End: end})
//	}
//	sort.Slice(freshRanges, func(i, j int) bool {
//		return freshRanges[i].End > freshRanges[j].End
//	})
//	lastDigit := freshRanges[0].End
//	sort.Slice(freshRanges, func(i, j int) bool {
//		return freshRanges[i].Start < freshRanges[j].Start
//	})
//	firstDigit := freshRanges[0].Start
//	maximumPossibleAnswer := lastDigit - firstDigit + 1
//	fmt.Printf("from %d to %d...\n", firstDigit, lastDigit)
//	for i := firstDigit + 1; i < lastDigit; i++ {
//		fmt.Printf("now checking %d...\n", i)
//		found := false
//		for _, freshRange := range freshRanges {
//			if i >= freshRange.Start && i <= freshRange.End {
//				found = true
//				i = freshRange.End
//				break
//			}
//		}
//		if !found {
//			maximumPossibleAnswer--
//		}
//	}
//	return maximumPossibleAnswer
//}

func Day05Part2(input string) int {
	allStrings := strings.Split(input, "\n\n")
	freshRanges := getFreshRanges(strings.Split(allStrings[0], "\n"))
	consolidatedRanges := consolidateRanges(freshRanges)
	sort.Slice(consolidatedRanges, func(i, j int) bool {
		return consolidatedRanges[i].Start < consolidatedRanges[j].Start
	})
	sort.Slice(consolidatedRanges, func(i, j int) bool {
		if consolidatedRanges[i].End != consolidatedRanges[j].End {
			return consolidatedRanges[i].End < consolidatedRanges[j].End
		}
		return consolidatedRanges[i].Start < consolidatedRanges[j].Start
	})
	fmt.Println(consolidatedRanges)
	value := 0
	for _, freshRange := range consolidatedRanges {
		value += freshRange.End - freshRange.Start + 1
	}
	return value
}

func getFreshRanges(allRanges []string) []FreshRange {
	var freshRanges []FreshRange
	for _, myRange := range allRanges {
		rangeVals := strings.Split(myRange, "-")
		start, err := strconv.Atoi(rangeVals[0])
		if err != nil {
			panic("a")
		}
		end, err := strconv.Atoi(rangeVals[1])
		if err != nil {
			panic("b")
		}
		freshRanges = append(freshRanges, FreshRange{Start: start, End: end})
	}
	return freshRanges
}

//func consolidateRanges(ranges []FreshRange) []FreshRange {
//	for {
//		newRanges := consolidateRanges2(ranges)
//		if len(newRanges) == len(ranges) {
//			return newRanges
//		}
//		ranges = newRanges
//	}
//}

func consolidateRanges(ranges []FreshRange) []FreshRange {
	for {
		sort.Slice(ranges, func(i, j int) bool {
			if ranges[i].End != ranges[j].End {
				return ranges[i].End < ranges[j].End
			}
			return ranges[i].Start < ranges[j].Start
		})
		newRanges := consolidateRanges2(ranges)
		if len(newRanges) == len(ranges) {
			return newRanges
		}
		ranges = newRanges
	}
}

func consolidateRanges2(ranges []FreshRange) []FreshRange {
	fmt.Printf("NEW CONSOLIDATION IN PROGRESS on a %d-element slice\n", len(ranges))
	var newRanges []FreshRange
	var skipIndexes []int
	for i, myRange := range ranges {
		if slices.Contains(skipIndexes, i) {
			fmt.Printf("Already consolidated %d earlier\n", i)
			continue
		}
		for j := i + 1; j < len(ranges); j++ {
			//if slices.Contains(skipIndexes, j) {
			//	fmt.Printf("Alreatdy consolidated %d earlier\n", j)
			//	continue
			//}
			if ranges[j].Start <= myRange.End && ranges[j].End >= myRange.End {
				//if ranges[i].Start == 52998694266417 || ranges[j].Start == 52998694266417 {
				//	fmt.Println(52998694266417)
				//}
				//fmt.Printf("The ranges of %d-%d and %d-%d will consolidate to become %d-%d\n", myRange.Start, myRange.End, ranges[j].Start, ranges[j].End, myRange.Start, ranges[j].End)
				fmt.Printf("Ranges at index %d and %d will be consolidated\n", i, j)
				skipIndexes = append(skipIndexes, i, j)
				newStart := min(myRange.Start, ranges[j].Start)
				newRanges = append(newRanges, FreshRange{newStart, ranges[j].End})
				break
			}
		}
		if slices.Contains(skipIndexes, i) {
			fmt.Printf("Just consolidated %d so skipping adding existing\n", i)
			continue
		}
		fmt.Printf("Range at index %d remaining intact\n", i)
		newRanges = append(newRanges, myRange)
	}
	return newRanges
}
