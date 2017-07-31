<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SortExtension extends AbstractExtension
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('sort', function (iterable $iterable, $flags = null, $preserveKeys = true) {
                $array = Helper::iterableToArray($iterable);

                if ($preserveKeys) {
                    asort($array, $flags);
                } else {
                    sort($array, $flags);
                }

                return $array;
            }),
            new TwigFilter('ksort', function (iterable $iterable, $flags = null) {
                $array = Helper::iterableToArray($iterable);

                ksort($array, $flags);

                return $array;
            }),
            new TwigFilter('natsort', function (iterable $iterable) {
                $array = Helper::iterableToArray($iterable);

                natsort($array);

                return $array;
            }),
            new TwigFilter('sort_by', $sortBy = function (iterable $iterable, $path, $preserveKeys = true) {
                $array = Helper::iterableToArray($iterable);
                $function = $preserveKeys ? 'uasort' : 'usort';

                $function($array, function ($a, $b) use ($path) {
                    $aValue = $this->propertyAccessor->getValue($a, $path);
                    $bValue = $this->propertyAccessor->getValue($b, $path);

                    if ($aValue == $bValue) {
                        return 0;
                    }

                    return $aValue > $bValue ? 1 : -1;
                });

                return $array;
            }),
        ];
    }
}
