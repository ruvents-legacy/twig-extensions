<?php

namespace Ruvents\TwigExtensions;

use Doctrine\Common\Inflector\Inflector;

class InflectorExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('underscorize', function ($string) {
                return Inflector::tableize($string);
            }),
            new \Twig_SimpleFilter('classify', function ($string) {
                return Inflector::classify($string);
            }),
            new \Twig_SimpleFilter('camelize', function ($string) {
                return Inflector::camelize($string);
            }),
            new \Twig_SimpleFilter('ucwords', function ($string, $delimiters = " \n\t\r\0\x0B-") {
                return Inflector::ucwords($string, $delimiters);
            }),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.inflector';
    }
}
