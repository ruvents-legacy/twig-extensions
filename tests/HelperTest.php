<?php

namespace Ruvents\TwigExtensions;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testIterableToArray()
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
        $iterator = new \ArrayIterator($array);

        $this->assertSame($array, Helper::iterableToArray($array));
        $this->assertSame($array, Helper::iterableToArray($iterator));
    }
}
