fun main() {
    fun part1(input: List<Int>): Int {
        return input.windowed(2).count { (a, b) -> a < b }
    }

    fun part2(input: List<Int>): Int {
        return input.windowed(3).windowed(2).count { (a, b) ->
            a.sum() < b.sum()
        }
    }

    val testInput = readInputAsInts("Day01_test")
    val input = readInputAsInts("Day01")

    check(part1(testInput) == 7)
    println(part1(input))

    check(part2(testInput) == 5)
    println(part2(input))
}