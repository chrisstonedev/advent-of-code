fun main() {
    fun getCalorieSumPerElf(input: String): List<Int> {
        val data = input.split("\n\n").map { elf ->
            elf.lines().sumOf { it.toInt() }
        }
        return data
    }

    fun getSumOfCaloriesFromTopNElves(input: String, topNElves: Int): Int {
        val data = getCalorieSumPerElf(input)
        return data.sortedDescending().take(topNElves).sum()
    }

    fun part1(input: String): Int {
        return getSumOfCaloriesFromTopNElves(input, 1)
    }

    fun part2(input: String): Int {
        return getSumOfCaloriesFromTopNElves(input, 3)
    }

    val testInput = readInputAsText("Day01_test")
    checkValue(part1(testInput), 24000)
    val input = readInputAsText("Day01")
    println(part1(input))

    checkValue(part2(testInput), 45000)
    println(part2(input))
}
