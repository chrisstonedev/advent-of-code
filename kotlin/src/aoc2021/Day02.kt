package aoc2021

import readInput

fun main() {
    data class Operation(val direction: String, val amount: Int)

    fun getSumOfValues(operations: List<Operation>, direction: String): Int {
        return operations.filter { it.direction == direction }.sumOf { it.amount }
    }

    fun part1(input: List<String>): Int {
        val operations = input.map {
            val split = it.split(' ')
            Operation(split[0], split[1].toInt())
        }
        val horizontalPosition = getSumOfValues(operations, "forward")
        val down = getSumOfValues(operations, "down")
        val up = getSumOfValues(operations, "up")
        val depth = down - up
        return horizontalPosition * depth
    }

    fun part2(input: List<String>): Int {
        val operations = input.map {
            val split = it.split(' ')
            Operation(split[0], split[1].toInt())
        }
        var horizontalPosition = 0
        var depth = 0
        var aim = 0
        for ((direction, amount) in operations) {
            when (direction) {
                "forward" -> {
                    horizontalPosition += amount
                    depth += aim * amount
                }
                "down" -> aim += amount
                "up" -> aim -= amount
            }
        }
        return horizontalPosition * depth
    }

    val testInput = readInput("2021_02_test")
    val input = readInput("2021_02_input")

    check(part1(testInput) == 150)
    println(part1(input))

    check(part2(testInput) == 900)
    println(part2(input))
}
