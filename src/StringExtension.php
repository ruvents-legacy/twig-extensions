<?php

namespace Ruvents\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StringExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('clear_tags', $clearTags = function ($string) {
                return preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $string);
            }),
            new TwigFilter('respace', function ($string) {
                return preg_replace("/[\s\p{Z}]+/ui", ' ', $string);
            }),
        ];
    }
}
