<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Twig\Error\RuntimeError;
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
            new TwigFilter('sort', function ($traversable, $flags = null, $preserveKeys = true) {
                $array = $this->toArray($traversable);

                if ($preserveKeys) {
                    asort($array, $flags);
                } else {
                    sort($array, $flags);
                }

                return $array;
            }),
            new TwigFilter('ksort', function ($traversable, $flags = null) {
                $array = $this->toArray($traversable);

                ksort($array, $flags);

                return $array;
            }),
            new TwigFilter('natsort', function ($traversable) {
                $array = $this->toArray($traversable);

                natsort($array);

                return $array;
            }),
            new TwigFilter('sort_by', $sortBy = function ($array, $path, $preserveKeys = true) {
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

    /**
     * @param array|\Traversable $traversable
     *
     * @return array
     * @throws RuntimeError
     */
    private function toArray($traversable)
    {
        if (is_array($traversable)) {
            return $traversable;
        } elseif ($traversable instanceof \Traversable) {
            return iterator_to_array($traversable);
        }

        throw new RuntimeError(sprintf(
            'Sorted variable must be an array or an instance of Traversable, got "%s".',
            gettype($traversable)
        ));
    }
}
