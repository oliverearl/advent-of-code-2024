<?php

declare(strict_types=1);

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, trim($input));

$leftList = [];
$rightList = [];

foreach ($lines as $line) {
    if (trim($line) !== '') {
        [$left, $right] = preg_split('/\s+/', $line);

        $leftList[] = (int) $left;
        $rightList[] = (int) $right;
    }
}

sort($leftList);
sort($rightList);

// Part 1:
$totalDistance = 0;
$leftListCount = count($leftList);

for ($i = 0; $i < $leftListCount; $i++) {
    $totalDistance += abs($leftList[$i] - $rightList[$i]);
}

// Part 2:
$rightOccurrencesCount = array_count_values($rightList);
$similarityScore = 0;

foreach ($leftList as $value) {
    if (isset($rightOccurrencesCount[$value])) {
        $similarityScore += ($value * $rightOccurrencesCount[$value]);
    }
}

echo "Total Distance: {$totalDistance}" . PHP_EOL;
echo "Similarity Score: {$similarityScore}" . PHP_EOL;