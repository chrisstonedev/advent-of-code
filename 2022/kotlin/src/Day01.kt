fun main() {
    fun parseInputData(input: String): List<List<Int>> =
        input.split("\n\n").map { elf -> elf.lines().map { it.toInt() } }

    fun List<List<Int>>.topNElves(n: Int): Int = map { it.sum() }.sortedDescending().take(n).sum()

    fun part1(input: String): Int = parseInputData(input).topNElves(1)

    fun part2(input: String): Int = parseInputData(input).topNElves(3)

    val testInput = readInputAsText("Day01_test")
    checkValue(part1(testInput), 24000)
    val input = readInputAsText("Day01")
    println(part1(input))

    checkValue(part2(testInput), 45000)
    println(part2(input))
}
