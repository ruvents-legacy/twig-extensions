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
            new TwigFilter('intl_country', function ($country, string $locale = null) {
                if (is_string($country)) {
                    return Intl::getRegionBundle()->getCountryName($country, $locale);
                }

                return array_map(function ($country) use ($locale) {
                    return Intl::getRegionBundle()->getCountryName($country, $locale);
                }, Helper::iterableToArray($country));
            }),
            new TwigFilter('intl_currency', function ($currency, string $locale = null) {
                if (is_string($currency)) {
                    return Intl::getCurrencyBundle()->getCurrencyName($currency, $locale);
                }

                return array_map(function ($currency) use ($locale) {
                    return Intl::getCurrencyBundle()->getCurrencyName($currency, $locale);
                }, Helper::iterableToArray($currency));
            }),
            new TwigFilter('intl_currency_symbol', function ($currency, string $locale = null) {
                if (is_string($currency)) {
                    return Intl::getCurrencyBundle()->getCurrencySymbol($currency, $locale);
                }

                return array_map(function ($currency) use ($locale) {
                    return Intl::getCurrencyBundle()->getCurrencySymbol($currency, $locale);
                }, Helper::iterableToArray($currency));
            }),
            new TwigFilter('intl_language', function ($language, string $region = null, string $locale = null) {
                if (is_string($language)) {
                    return Intl::getLanguageBundle()->getLanguageName($language, $region, $locale);
                }

                return array_map(function ($language) use ($region, $locale) {
                    return Intl::getLanguageBundle()->getLanguageName($language, $region, $locale);
                }, Helper::iterableToArray($language));
            }),
            new TwigFilter('intl_locale', function ($locale, string $displayLocale = null) {
                if (is_string($locale)) {
                    return Intl::getLocaleBundle()->getLocaleName($locale, $displayLocale);
                }

                return array_map(function ($locale) use ($displayLocale) {
                    return Intl::getLocaleBundle()->getLocaleName($locale, $displayLocale);
                }, Helper::iterableToArray($locale));
            }),
            new TwigFilter('intl_script', function ($script, string $language = null, string $locale = null) {
                if (is_string($script)) {
                    return Intl::getLanguageBundle()->getScriptName($script, $language, $locale);
                }

                return array_map(function ($script) use ($language, $locale) {
                    return Intl::getLanguageBundle()->getScriptName($script, $language, $locale);
                }, Helper::iterableToArray($script));
            }),
        ];
    }
}
