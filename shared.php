<?php

declare(strict_types=1);

function dd(mixed ... $vars): never
{
    foreach ($vars as $var) {
        echo PHP_EOL;
        var_dump($var);
        echo PHP_EOL;
    }

    exit;
}

function load_file(string $filepath = 'input.txt'): false|array
{
    return file($filepath, FILE_SKIP_EMPTY_LINES);
}
