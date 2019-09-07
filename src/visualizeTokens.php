<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\ColorPrinter;

$input = file_get_contents(__DIR__ . '/../test/data/FizzBuzz.php');
$printer = new ColorPrinter();

$tokens = token_get_all($input);
foreach ($tokens as $token) {
    if (is_array($token)) {
        $tokenName = token_name($token[0]);
        $printer->printWithAlternatingBackground("{$token[1]}($tokenName)");
    } else {
        $printer->printWithAlternatingBackground($token);
    }
}
