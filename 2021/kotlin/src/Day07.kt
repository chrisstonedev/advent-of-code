import kotlin.math.abs

fun main() {
    fun calculateLeastAmountOfFuelSpend(input: List<String>, sumFunction: (it: Int, i: Int) -> Int): Int {
        val horizontalPositions = input.first().split(',').map { it.toInt() }.sorted()
        var smallestFuelSum = Int.MAX_VALUE
        for (i in horizontalPositions.first()..horizontalPositions.last()) {
            val currentSum = horizontalPositions.sumOf { sumFunction(it, i) }
            if (currentSum < smallestFuelSum)
                smallestFuelSum = currentSum
        }
        return smallestFuelSum
    }

    fun part1(input: List<String>): Int {
        fun sumFunction(it: Int, i: Int) = abs(it - i)
        return calculateLeastAmountOfFuelSpend(input, ::sumFunction)
    }

    fun part2(input: List<String>): Int {
        fun sumFunction(it: Int, i: Int) = (1..abs(it - i)).sum()
        return calculateLeastAmountOfFuelSpend(input, ::sumFunction)
    }

    val testInput = readInput("Day07_test")
    val input = readInput("Day07")

    check(part1(testInput) == 37)
    println(part1(input))

    check(part2(testInput) == 168)
    println(part2(input))
}
