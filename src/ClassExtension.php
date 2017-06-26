<?php

namespace Ruvents\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class ClassExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getTests()
    {
        return [
            new TwigTest('instanceof', function ($value, $className) {
                return $value instanceof $className;
            }),
        ];
    }
}
