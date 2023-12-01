import kotlin.math.abs

data class Move(val dx: Int, val dy: Int)

enum class Direction(val move: Move) {
    R(Move(1, 0)),
    L(Move(-1, 0)),
    U(Move(0, 1)),
    D(Move(0, -1)),
}

operator fun Pos.plus(move: Move): Pos = copy(x + move.dx, y + move.dy)
operator fun Pos.minus(other: Pos): Move = Move(this.x - other.x, this.y - other.y)

val Move.distance: Int get() = maxOf(abs(dx), abs(dy))

fun tailToHeadAttraction(head: Pos, tail: Pos): Move {
    val tailToHead = head - tail
    return if (tailToHead.distance > 1) {
        Move(tailToHead.dx.coerceIn(-1, 1), tailToHead.dy.coerceIn(-1, 1))
    } else {
        Move(0, 0)
    }
}

data class Pos(val x: Int, val y: Int) {
    override fun toString() = "(x:$x, y:$y)"
}

fun Pos.adjacentHV(): List<Pos> = listOf(
    Pos(x - 1, y),
    Pos(x + 1, y),
    Pos(x, y - 1),
    Pos(x, y + 1),
)

fun main() {
    fun part1(input: List<String>): Int {
        val mapped = input.map { line -> line.split(" ").let { (d, n) -> Direction.valueOf(d) to n.toInt() } }
        var head = Pos(0, 0)
        var tail = head
        val tailVisited = mutableSetOf(tail)

        for ((d, n) in mapped) {
            repeat(n) {
                head += d.move
                tail += tailToHeadAttraction(head, tail)
                tailVisited += tail
            }
        }
        return tailVisited.size
    }

    fun part2(input: List<String>): Int {
        return 0
    }

    val testInput = readInputAsLines("test09")
    checkValue(part1(testInput), 13)
    val input = readInputAsLines("input09")
    println(part1(input))

    checkValue(part2(testInput), 1)
    println(part2(input))
}
