import java.io.File
import java.math.BigInteger
import java.security.MessageDigest

/**
 * Reads lines from the given input txt file.
 */
fun readInputAsLines(name: String) = getFileData(name).readLines()

/**
 * Reads text from the given input txt file.
 */
fun readInputAsText(name: String) = getFileData(name).readText()

fun readInput(name: String) = File("../../aoc-data", "$name.txt").readLines()

fun readInputAsInts(name: String) = readInput(name).map { it.toInt() }

private fun getFileData(name: String) = File("../../aoc-data", "$name.txt")

fun checkValue(actual: Int, expected: Int) {
    check(actual == expected) { "Expected: ${expected}, Actual: $actual" }
}

/**
 * Converts string to md5 hash.
 */
fun String.md5() = BigInteger(
    1, MessageDigest.getInstance("MD5").digest(toByteArray())
).toString(16).padStart(32, '0')
