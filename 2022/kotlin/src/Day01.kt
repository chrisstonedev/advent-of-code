fun main() {
    fun parseInputData(input: String): List<List<Int>> {
        return input.split("\n\n").map { elf -> elf.lines().map { it.toInt() } }
    }

    fun List<List<Int>>.topNElves(n: Int): Int = map { it.sum() }.sortedDescending().take(n).sum()

    fun List<List<Int>>.topNElvesOptimized(n: Int): Int {
        fun findTopN(n: Int, element: List<Int>): List<Int> {
            if (element.size == n) return element
            val x = element.random()
            val small = element.filter { it < x }
            val equal = element.filter { it == x }
            val big = element.filter { it > x }
            if (big.size >= n) return findTopN(n, big)
            if (equal.size + big.size >= n) return (equal + big).takeLast(n)
            return findTopN(n - equal.size - big.size, small) + equal + big
        }
        return findTopN(n, this.map { it.sum() }).sum()
    }

    fun part1(input: String): Int = parseInputData(input).topNElves(1)

    fun part2(input: String): Int = parseInputData(input).topNElves(3)

    val testInput = readInputAsText("Day01_test")
    checkValue(part1(testInput), 24000)
    val input = readInputAsText("Day01")
    println(part1(input))

    checkValue(part2(testInput), 45000)
    println(part2(input))
}
