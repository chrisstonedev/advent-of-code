<?php

declare(strict_types=1);

namespace aoc;

require '../vendor/autoload.php';

function ReadAllLines(string $filename): array
{
    $filepath = dirname(__FILE__) . '/../../data/' . $filename . '.txt';
    return file($filepath, FILE_IGNORE_NEW_LINES);
}

$completedDays = [
    2021 => [1,],
    2022 => [1,2, 3,4,5,7,8,9,10], //6
    2023 => [1,3,7,8], // 3,4,5,6,7,8,9,10,11,12,13,14], //4
];

?>
<html lang="en">
<body>
<?php foreach ($completedDays as $year => $days): ?>
    <h2><?= $year ?></h2>
    <ul>
        <?php foreach ($days as $day): ?>
            <li>Day <?= $day ?>
                <ul>
                    <li>Part 1: <?= /** @noinspection PhpUndefinedMethodInspection */
                        sprintf('\aoc\aoc%d\Day%02d', $year, $day)::executePartOne(ReadAllLines(sprintf('%d_%02d_input', $year, $day))) ?>
                    </li>
                    <li>Part 2: <?= /** @noinspection PhpUndefinedMethodInspection */
                        sprintf('\aoc\aoc%d\Day%02d', $year, $day)::executePartTwo(ReadAllLines(sprintf('%d_%02d_input', $year, $day))) ?>
                    </li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>
</body>
</html>
