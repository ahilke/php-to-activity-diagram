<?php declare(strict_types=1);

namespace App;

use PhpParser\Node;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\If_;
use PhpParser\NodeVisitorAbstract;
use PhpParser\PrettyPrinter\Standard;

final class StatementVisitor extends NodeVisitorAbstract
{
    private $result = '';
    private $printer;

    public function __construct() {
        $this->printer = new Standard();
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof If_) {
            $condition = $this->printer->prettyPrintExpr($node->cond);
            $this->result .= "if($condition)\n";
        }
    }

    public function leaveNode(Node $node): void {

        if ($node instanceof Expression || $node instanceof Echo_) {
            $expression = $this->printer->prettyPrint([$node]);
            $this->result .= ":$expression;\n";
        } else if ($node instanceof If_) {
            $this->result .= "endif\n";
        }
    }

    public function getResult(): string {
        return $this->result;
    }
}