<?php

declare(strict_types=1);

function isSafe(array $levels): bool {
    $number = count($levels);

    if ($number < 2) {
        return false;
    }

    $differences = [];

    for ($i = 1; $i < $number; $i++) {
        $difference = $levels[$i] - $levels[$i - 1];
        $differences[] = $difference;
        $absDiff = abs($difference);

        if ($absDiff < 1 || $absDiff > 3) {
            return false;
        }
    }

    $allIncreasing = all(array_map(fn(int $v): bool => $v > 0, $differences));
    $allDecreasing = all(array_map(fn(int $v): bool => $v < 0, $differences));

    return $allIncreasing || $allDecreasing;
}

function isSafeWithProblemDampener(array $levels): bool
{
    $number = count($levels);

    for ($i = 0; $i < $number; $i++) {
        $reduced = array_merge(
            array_slice($levels, 0, $i),
            array_slice($levels, $i + 1),
        );

        if (isSafe($reduced)) {
            return true;
        }
    }

    return false;
}

function all(array $values): bool
{
    foreach ($values as $value) {
        if (! $value) {
            return false;
        }
    }

    return true;
}

$input = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$reports = array_map(fn(string $line): array => array_map(
    fn(string $v): int => (int) $v,
    explode(' ', $line)
), $input);

$safeCount = 0;
$part2SafeCount = 0;

foreach ($reports as $report) {
    if (isSafe($report)) {
        $safeCount++;
        $part2SafeCount++;
    } elseif (isSafeWithProblemDampener($report)) {
        $part2SafeCount++;
    }
}

echo "Part 1 count: {$safeCount}" . PHP_EOL;
echo "Part 2 count: {$part2SafeCount}" . PHP_EOL;