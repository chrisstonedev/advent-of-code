fun main() {
    fun part1(input: List<Int>): Int {
        return input.windowed(2).count { (a, b) -> a < b }
    }

    fun part2(input: List<Int>): Int {
        return input.windowed(3).windowed(2).count { (a, b) ->
            a.sum() < b.sum()
        }
    }

    val sampleInput = readInputAsInts("Day01_sample")
    val input = readInputAsInts("Day01")

    println(part1(sampleInput))
    check(part1(sampleInput) == 7)
    println(part1(input))

    println(part2(sampleInput))
    check(part2(sampleInput) == 5)
    println(part2(input))
}