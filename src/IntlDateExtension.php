<?php

namespace Ruvents\TwigExtensions;

/**
 * This class provides localizeddate filter from https://github.com/twigphp/Twig-extensions
 * which uses native php timezones settings instead of the intl ones
 */
class IntlDateExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('localizeddate', function (
                \Twig_Environment $env,
                $date,
                $dateFormat = 'medium',
                $timeFormat = 'medium',
                $locale = null,
                $timezone = null,
                $format = null,
                $calendar = 'gregorian'
            ) {
                $date = twig_date_converter($env, $date, $timezone);

                $formatValues = array(
                    'none' => \IntlDateFormatter::NONE,
                    'short' => \IntlDateFormatter::SHORT,
                    'medium' => \IntlDateFormatter::MEDIUM,
                    'long' => \IntlDateFormatter::LONG,
                    'full' => \IntlDateFormatter::FULL,
                );

                $formatter = \IntlDateFormatter::create(
                    $locale,
                    $formatValues[$dateFormat],
                    $formatValues[$timeFormat],
                    $date->getTimezone(),
                    'gregorian' === $calendar ? \IntlDateFormatter::GREGORIAN : \IntlDateFormatter::TRADITIONAL,
                    $format
                );

                $timestamp = $date->getTimestamp();

                $formatter->getTimeZone()->getOffset($timestamp * 1000, true, $raw, $dst);
                $timestamp += $date->getOffset() - ($raw + $dst) / 1000;

                return $formatter->format($timestamp);
            }, ['needs_environment' => true]),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'intl';
    }
}
