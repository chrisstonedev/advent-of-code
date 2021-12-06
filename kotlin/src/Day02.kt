fun main() {
    data class Operation(val direction: String, val amount: Int)

    fun getSumOfValues(operations: List<Operation>, direction: String): Int {
        return operations.filter { x -> x.direction == direction }.sumOf { x -> x.amount }
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

    val testInput = readInput("Day02_test")
    val input = readInput("Day02")

    check(part1(testInput) == 150)
    println(part1(input))

    check(part2(testInput) == 900)
    println(part2(input))
}
