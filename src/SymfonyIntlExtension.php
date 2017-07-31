<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\Intl\Intl;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SymfonyIntlExtension extends AbstractExtension
{
    public function __construct()
    {
        if (!class_exists(Intl::class)) {
            throw new \RuntimeException('The symfony/intl package is required to use SymfonyIntlExtension.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('intl_country', function ($name, $locale = null) {
                if (is_string($name)) {
                    return Intl::getRegionBundle()->getCountryName($name, $locale);
                }

                return array_map(function ($name) use ($locale) {
                    return Intl::getRegionBundle()->getCountryName($name, $locale);
                }, Helper::iterableToArray($name));
            }),
        ];
    }
}
