<?php

namespace Ruvents\TwigExtensions;

/**
 * This class provides a copy of the localizeddate filter from https://github.com/twigphp/Twig-extensions
 * and adds a possibility to fix incorrect ICU timezones by passing a from-to array
 */
class IntlDateExtension extends \Twig_Extension
{
    /**
     * @var string[]
     */
    private $timezones;

    /**
     * @param string[] $timezones Timezones fix matrix [from => to]
     *                            ['Europe/Moscow' => 'Etc/GMT-3']
     *
     * @throws \RuntimeException
     */
    public function __construct(array $timezones = [])
    {
        $this->timezones = $timezones;
    }

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
                $timezoneName = $date->getTimezone()->getName();

                if (isset($this->timezones[$timezoneName])) {
                    $microTimestamp = $timestamp * 1000;
                    $formatter->getTimeZone()->getOffset($microTimestamp, true, $raw, $dst);
                    $microTimestamp -= $raw;
                    \IntlTimeZone::createTimeZone($this->timezones[$timezoneName])
                        ->getOffset($microTimestamp, true, $raw, $dst);
                    $microTimestamp += $raw;
                    $timestamp = $microTimestamp / 1000;
                }

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
