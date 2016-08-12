<?php

namespace Ruvents\TwigExtensions;

class ComparatorsAbstractContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testHasGet()
    {
        $comparators = $this->getMockForAbstractClass(
            'Ruvents\TwigExtensions\ComparatorsAbstractContainer'
        );

        $callable = function ($a, $b) {
            return $a > $b;
        };

        $comparators
            ->expects($this->any())
            ->method('all')
            ->will($this->returnValue(['callable' => $callable]));

        $this->assertTrue($comparators->has('callable'));
        $this->assertEquals($comparators->get('callable'), $callable);
    }
}
