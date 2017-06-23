<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class SortByExtension extends \Twig_Extension
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @throws \RuntimeException
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        if (!class_exists('Symfony\Component\PropertyAccess\PropertyAccess')) {
            throw new \RuntimeException('Intall Symfony PropertyAccess Component to use SortByExtension.');
        }

        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sort_by', $sortBy = function ($array, $path, $preserveKeys = true) {
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
            new \Twig_SimpleFilter('sortBy', $sortBy, ['deprecated' => true, 'alternative' => 'sort_by']),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.sort_by';
    }
}
