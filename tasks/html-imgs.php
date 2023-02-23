<?php declare(strict_types=1);

[, $filename] = $argv;

$handle = fopen($filename, 'rwb');
$rewrite = '';

while ($row = fgets($handle)) {
    if (preg_match('/^!\[(.*)\]\((.*)\)/', $row, $matches)) {
        [, $alt, $src] = $matches;
        $row = "<p align=\"center\"><img alt=\"$alt\" src=\"$src\"></p>\n";
    }

    $rewrite .= $row;
}

file_put_contents($filename, $rewrite);