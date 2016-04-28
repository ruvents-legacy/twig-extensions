<?php

namespace Ruvents\TwigExtensions;

/**
 * Class ClassExtension
 */
class ClassExtension extends \Twig_Extension
{
    /**
     * @inheritdoc
     */
    public function getTests()
    {
        return [
            new \Twig_SimpleTest('instanceof', function ($value, $class) {
                return $value instanceof $class;
            }),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ruvents_class_twig_extension';
    }
}
