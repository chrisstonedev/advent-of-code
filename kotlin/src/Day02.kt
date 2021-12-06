fun main() {
    fun getSumOfValues(input: List<String>, filter: String): Int {
        return input.filter { x -> x.contains(filter) }.sumOf { x -> x.substring(filter.length + 1).toInt() }
    }

    fun part1(input: List<String>): Int {
        val horizontalPosition = getSumOfValues(input, "forward")
        val down = getSumOfValues(input, "down")
        val up = getSumOfValues(input, "up")
        val depth = down - up
        return horizontalPosition * depth
    }

    fun part2(input: List<String>): Int {
        val horizontalPosition = getSumOfValues(input, "forward")
        var depth = 0;
        var aim = 0;
        input.forEach{
            val parts = it.split(' ')
            when (parts[0]) {
                "forward" -> depth += aim * parts[1].toInt()
                "down" -> aim += parts[1].toInt()
                "up" -> aim -= parts[1].toInt()
            }
        }
        return horizontalPosition * depth
    }

    val testInput = readInput("Day02_test")
    val input = readInput("Day02")

    println(part1(testInput))
    check(part1(testInput) == 150)
    println(part1(input))

    println(part2(testInput))
    check(part2(testInput) == 900)
    println(part2(input))
}
