package utils

import (
	"fmt"
	"os"
	"strings"
)

func ReadFileIntoString(fileNameDate string, inputType string) string {
	return ReadFileIntoStringWithDepth(fileNameDate, inputType, 2)
}

func ReadFileIntoStringWithDepth(fileNameDate string, inputType string, depth int) string {
	exitDirectory := strings.Repeat("../", depth+1)
	fileName := fmt.Sprintf("%saoc-data/%s_%s.txt", exitDirectory, fileNameDate, inputType)
	data, err := os.ReadFile(fileName)
	if err != nil {
		panic(err)
	}
	return string(data)
}
