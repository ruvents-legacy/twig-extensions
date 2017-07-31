<?php

namespace Ruvents\TwigExtensions;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeExtension extends AbstractExtension
{
    const SINCE = 'since';
    const TILL = 'till';

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('to_seconds',
                function (
                    Environment $env,
                    \DateInterval $interval,
                    $reference = 'now',
                    string $type = 'since'
                ) {
                    if (self::SINCE !== $type && self::TILL !== $type) {
                        throw new \UnexpectedValueException(sprintf('Type "%s" is not supported.', $type));
                    }

                    $reference = clone twig_date_converter($env, $reference);
                    $timestamp = $reference->getTimestamp();

                    // since
                    if (self::SINCE === $type) {
                        $reference->add($interval);

                        return $reference->getTimestamp() - $timestamp;
                    }

                    // till
                    $reference->sub($interval);

                    return $timestamp - $reference->getTimestamp();
                },
                ['needs_environment' => true]
            ),
        ];
    }
}
