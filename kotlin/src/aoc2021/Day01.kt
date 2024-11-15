package aoc2021

import readInputAsInts

fun main() {
    fun part1(input: List<Int>): Int {
        return input.windowed(2).count { (a, b) -> a < b }
    }

    fun part2(input: List<Int>): Int {
        return input.windowed(3).windowed(2).count { (a, b) -> a.sum() < b.sum() }
    }

    val testInput = readInputAsInts("2021_01_test")
    val input = readInputAsInts("2021_01_input")

    check(part1(testInput) == 7)
    println(part1(input))

    check(part2(testInput) == 5)
    println(part2(input))
}