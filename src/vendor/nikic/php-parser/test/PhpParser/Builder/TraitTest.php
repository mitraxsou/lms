<?php

namespace PhpParser\Builder;

use PhpParser\Comment;
<<<<<<< HEAD
use PhpParser\Node\Name;
=======
>>>>>>> release/v2
use PhpParser\Node\Stmt;

class TraitTest extends \PHPUnit_Framework_TestCase
{
    protected function createTraitBuilder($class) {
        return new Trait_($class);
    }

    public function testStmtAddition() {
        $method1 = new Stmt\ClassMethod('test1');
        $method2 = new Stmt\ClassMethod('test2');
        $method3 = new Stmt\ClassMethod('test3');
        $prop = new Stmt\Property(Stmt\Class_::MODIFIER_PUBLIC, array(
            new Stmt\PropertyProperty('test')
        ));
<<<<<<< HEAD
        $use = new Stmt\TraitUse([new Name('OtherTrait')]);
        $trait = $this->createTraitBuilder('TestTrait')
            ->setDocComment('/** Nice trait */')
            ->addStmt($method1)
            ->addStmts([$method2, $method3])
            ->addStmt($prop)
            ->addStmt($use)
            ->getNode();
        $this->assertEquals(new Stmt\Trait_('TestTrait', [
            'stmts' => [$use, $prop, $method1, $method2, $method3]
        ], [
            'comments' => [
                new Comment\Doc('/** Nice trait */')
            ]
        ]), $trait);
=======
        $trait = $this->createTraitBuilder('TestTrait')
            ->setDocComment('/** Nice trait */')
            ->addStmt($method1)
            ->addStmts(array($method2, $method3))
            ->addStmt($prop)
            ->getNode();
        $this->assertEquals(new Stmt\Trait_('TestTrait', array(
            'stmts' => array($prop, $method1, $method2, $method3)
        ), array(
            'comments' => array(
                new Comment\Doc('/** Nice trait */')
            )
        )), $trait);
>>>>>>> release/v2
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Unexpected node of type "Stmt_Echo"
     */
    public function testInvalidStmtError() {
        $this->createTraitBuilder('Test')
            ->addStmt(new Stmt\Echo_(array()))
        ;
    }
}
