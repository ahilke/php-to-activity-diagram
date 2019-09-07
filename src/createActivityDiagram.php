<?php declare(strict_types=1);

use App\StatementVisitor;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$input = file_get_contents(__DIR__ . '/../test/data/FizzBuzz.php');
$output = "@startuml\nstart\n";

$parserFactory = new ParserFactory();
$parser = $parserFactory->create(ParserFactory::ONLY_PHP7);
try {
    $ast = $parser->parse($input);
} catch (Error $error) {
    echo "Parse error: {$error->getMessage()}\n";
    return;
}

$traverser = new NodeTraverser;
$visitor = new StatementVisitor();
$traverser->addVisitor($visitor);
$traverser->traverse($ast);

$output .= $visitor->getResult();
$output .= "end\n@enduml";

$outFile = fopen(__DIR__ . '/../out.puml', 'wb');
fwrite($outFile, $output);
fclose($outFile);
