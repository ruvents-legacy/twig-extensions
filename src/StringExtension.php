<?php

namespace Ruvents\TwigExtensions;

class StringExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('cleartags', function ($string) {
                return preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $string);
            }),
            new \Twig_SimpleFilter('respace', function ($string) {
                return preg_replace("/[\s\p{Z}]+/ui", ' ', $string);
            }),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.string';
    }
}
