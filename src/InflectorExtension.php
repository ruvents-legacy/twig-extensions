<?php

namespace Ruvents\TwigExtensions;

use Doctrine\Common\Inflector\Inflector;

/**
 * Class InflectorExtension
 */
class InflectorExtension extends \Twig_Extension
{
    /**
     * @throws \RuntimeException
     */
    public function __construct()
    {
        if (!class_exists('Doctrine\Common\Inflector\Inflector')) {
            throw new \RuntimeException('Intall Doctrine Inflector library to use InflectorExtension.');
        }
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.inflector';
    }
}
