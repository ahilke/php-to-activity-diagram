<?php declare(strict_types=1);

$input = random_int(0, 111);
$output = null;

if ($input % 3 === 0) {
    $output = 'Fizz';
}
if ($input % 5 === 0) {
    $output .= 'Buzz';
}
$output = $output ?? $input;

echo $output;
