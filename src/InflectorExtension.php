<?php

namespace Ruvents\TwigExtensions;

use Doctrine\Common\Inflector\Inflector;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class InflectorExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('underscorize', function ($string) {
                return Inflector::tableize($string);
            }),
            new TwigFilter('classify', function ($string) {
                return Inflector::classify($string);
            }),
            new TwigFilter('camelize', function ($string) {
                return Inflector::camelize($string);
            }),
            new TwigFilter('ucwords', function ($string, $delimiters = " \n\t\r\0\x0B-") {
                return Inflector::ucwords($string, $delimiters);
            }),
        ];
    }
}
